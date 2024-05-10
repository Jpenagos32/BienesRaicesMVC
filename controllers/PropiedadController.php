<?php

namespace Controllers;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class PropiedadController {

  //? con el parametro de esta funcion lo que hacemos es mantener viva la referencia a la instancia de Router
  //? que ya fue creada en index.php
  public static function index(Router $router) {

    $propiedades = Propiedad::all();
    // ? el ?? indica que si no existe un valor, le asigna el otro
    $resultado = $_GET['resultado'] ?? null; // Muestra el mensaje condicional

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'resultado' => $resultado
    ]);
  }

  public static function crear(Router $router) {
    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();
    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Crea una nueva instancia
      $propiedad = new Propiedad($_POST['propiedad']);

      // ? Subida de archivos


      // Generar un nombre unico
      $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

      // Setear la imagen
      // Realiza un resize a la imagen con intervention
      if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->resize(800, 600)->crop(800, 600);
        $propiedad->setImagen($nombreImagen);
      }


      // Validar
      $errores = $propiedad->validar();

      // Revisar que el arreglo de errores esté vacio
      if (empty($errores)) {

        // Crear la carpeta para subir imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
          mkdir(CARPETA_IMAGENES);
        }

        // Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guarda en la base de datos
        $propiedad->guardar();
      }
    }

    $router->render('propiedades/crear', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }

  public static function actualizar(Router $router) {
    $id = validarORedireccionar('/admin');

    $propiedad = Propiedad::find($id);
    $errores = Propiedad::getErrores();
    $vendedores = Vendedor::all();

    $router->render('/propiedades/actualizar', [
      'propiedad' => $propiedad,
      'errores' => $errores,
      'vendedores' => $vendedores
    ]);
  }
}
