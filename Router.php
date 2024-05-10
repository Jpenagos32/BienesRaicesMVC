<?php

namespace MVC;

class Router {

  public $rutasGET = [];
  public $rutasPOST = [];

  public function get($url, $fn) {
    $this->rutasGET[$url] = $fn;
  }


  public function comprobarRutas() {
    $urlActual = $_SERVER['PATH_INFO'] ?? '/';
    $metodo  = $_SERVER['REQUEST_METHOD'];

    if ($metodo === 'GET') {
      $fn = $this->rutasGET[$urlActual] ?? null;
    }

    if ($fn) {
      //como funciona-> https://www.php.net/manual/es/function.call-user-func.php 
      // ? el segundo parametro ($this) está haciendo que la funcion que se pasa ($fn) tenga acceso a todos los 
      // ? métodos y propiedades de esta clase
      call_user_func($fn, $this);
    } else {
      echo "Pagina no encontrada";
    }
  }
}
