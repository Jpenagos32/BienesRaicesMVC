<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

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

  public static function crear(Router $router) {
    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
    }

    $router->render('propiedades/crear', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores
    ]);
  }

  public static function actualizar() {
    echo 'Actualizar Propiedad';
  }
}
