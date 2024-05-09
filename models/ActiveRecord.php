<?php

namespace Model;

class ActiveRecord {
  // Base de datos
  protected static $db;
  protected static $columnasDB = [];

  protected static $tabla = '';

  // Errores
  protected static $errores = [];



  // Definir la conexion a la BD
  public static function setDB($database) {
    self::$db = $database;
  }



  public function guardar() {
    if (!is_null($this->id)) {
      // Actualizar
      $this->actualizar();
    } else {
      // Creando un nuevo registro
      $this->crear();
    }
  }

  public function crear() {

    // Sanitizar la entrada de datos  
    $atributos = $this->sanitizarAtributos();

    // Insertar en la base de datos
    $query = "INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";

    $resultado = self::$db->query($query);

    // Mensaje de exito o error
    if ($resultado) {
      // Redireccionar al usuario
      header('Location: /bienesraices/admin?resultado=1');
    }
  }

  public function actualizar() {
    // Sanitizar la entrada de datos  
    $atributos = $this->sanitizarAtributos();

    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "$key='$value'";
    }
    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1";

    $resultado = self::$db->query($query);

    if ($resultado) {
      // Redireccionar al usuario
      header('Location: /bienesraices/admin?resultado=2');
    }
  }

  // Eliminar un registro
  public function eliminar() {
    $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen();
      header('location: /bienesraices/admin?resultado=3');
    }
  }

  // Identificar y unir los atributos de la BD
  public function atributos() {
    $atributos = [];
    foreach (static::$columnasDB as $columna) {

      if ($columna === 'id')
        continue;

      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarAtributos() {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }

    return $sanitizado;
  }

  // Subida de archivos
  public function setImagen($imagen) {
    // Elimina la imagen previa
    if (!is_null($this->id)) {
      $this->borrarImagen();
    }

    // Asignar al atributo de imagen el nombre de la imagen
    if ($imagen) {
      $this->imagen = $imagen;
    }
  }

  // eliminar el archivo
  public function borrarImagen() {
    // Comprobar si existe el archivo
    $exiteArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

    if ($exiteArchivo) {
      unlink(CARPETA_IMAGENES . $this->imagen);
    }
  }

  // Validacion
  public static function getErrores() {
    return static::$errores;
  }

  public function validar() {
    static::$errores = [];

    return static::$errores;
  }

  // Lista todos los registros
  public static function all() {
    // ? Static es otro modificador de acceso, permite heredar el metodo donde se encuentre y buscar el atributo dentro de la clase donde es llamado
    $query = "SELECT * FROM " . static::$tabla;

    $resultado = self::consultarSql($query);

    return $resultado;
  }

  // Obtiene determinado número de registros
  public static function get($cantidad) {
    // ? Static es otro modificador de acceso, permite heredar el metodo donde se encuentre y buscar el atributo dentro de la clase donde es llamado
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

    $resultado = self::consultarSql($query);

    return $resultado;
  }

  // busca un registro por su ID
  public static function find($id) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";

    $resultado = self::consultarSql($query);

    return array_shift($resultado);
  }


  public static function consultarSql($query) {
    // Consultar la base de datos
    $resultado = self::$db->query($query);

    // iterar los resultados
    $array = [];

    while ($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    // liberar la memoria
    $resultado->free();

    // retornar los resultado
    return $array;
  }

  protected static function crearObjeto($registro) {
    // ? Static hace referencia a la clase en la cual se esta usando el metodo
    $objeto = new static;

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  // sincroniza el objeto en memoria con los cambios realizados por el usuario
  public function sincronizar($args = []) {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}
