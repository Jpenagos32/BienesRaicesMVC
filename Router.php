<?php

namespace MVC;

class Router {

  public $rutasGET = [];
  public $rutasPOST = [];

  public function get($url, $fn) {
    $this->rutasGET[$url] = $fn;
  }

  public function post($url, $fn) {
    $this->rutasPOST[$url] = $fn;
  }

  public function comprobarRutas() {
    $urlActual = $_SERVER['PATH_INFO'] ?? '/';
    $metodo  = $_SERVER['REQUEST_METHOD'];

    if ($metodo === 'GET') {
      $fn = $this->rutasGET[$urlActual] ?? null;
    } else {
      $fn = $this->rutasPOST[$urlActual] ?? null;
    }

    if ($fn) {
      // ? el segundo parametro ($this) está haciendo que la funcion que se pasa ($fn) tenga acceso a todos los 
      // ? métodos y propiedades de esta clase
      call_user_func($fn, $this);
      //como funciona-> https://www.php.net/manual/es/function.call-user-func.php 
    } else {
      echo "Pagina no encontrada";
    }
  }

  // Muestra una vista
  public function render($view, $datos = []) {
    //? Lo que venga en datos se pasará como variable a las vistas gracias a este foreach
    foreach ($datos as $key => $value) {
      //? lo que hace es crear una variable con el nombre que se encuentre en la key
      //? por ejemplo viene una key llamada mensaje, esto lo que hará es crear una variable llamada mensaje
      //? 'mensaje' = $mensaje
      $$key = $value;
    }

    // ? inicia el almacenamiento en memoria a partir de la linea de ob_start
    ob_start();
    include __DIR__ . "/views/$view.php";

    // limpiamos la memoria
    $contenido = ob_get_clean();

    include __DIR__ . "/views/layout.php";
  }
}
