<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;

class PropiedadController {

  //? con el parametro de esta funcion lo que hacemos es mantener viva la referencia a la instancia de Router
  //? que ya fue creada en index.php
  public static function index(Router $router) {

    $propiedades = Propiedad::all();
    $resultado = null;

    $router->render('propiedades/admin', [
      'propiedades' => $propiedades,
      'resultado' => $resultado
    ]);
  }

  public static function crear() {
    echo 'crear Propiedad';
  }

  public static function actualizar() {
    echo 'Actualizar Propiedad';
  }
}
