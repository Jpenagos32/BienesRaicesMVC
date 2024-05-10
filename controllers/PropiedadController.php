<?php

namespace Controllers;

use MVC\Router;

class PropiedadController {

  //? con el parametro de esta funcion lo que hacemos es mantener viva la referencia a la instancia de Router
  //? que ya fue creada en index.php
  public static function index(Router $router) {
    $router->render('propiedades/admin', []);
  }

  public static function crear() {
    echo 'crear Propiedad';
  }

  public static function actualizar() {
    echo 'Actualizar Propiedad';
  }
}
