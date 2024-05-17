<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;

/**
 * Controla el renderizado de paginas estáticas
 * @author Julian Penagos <jpenagosdev@gmail.com>
 */
class PaginasController {

  /**
   * Funcion encargada de renderizar el index
   *
   * @access public
   * @static
   * @return void
   * @param Router $router instacia de router
   **/
  public static function index(Router $router): void {
    $inicio = true;
    $propiedades = Propiedad::get(3);

    $router->render('paginas/index', [
      'propiedades' => $propiedades,
      'inicio' => $inicio
    ]);
  }

  /**
   * Funcion encargada de renderizar nosotros
   * 
   * @access public
   * @static
   * @param Router $router instacia de router
   **/
  public static function nosotros(Router $router) {
    $router->render('paginas/nosotros');
  }

  /**
   * Función encargada de renderizar Propiedades
   * @access public
   * @static
   * @param Router $router instacia de router
   * 
   **/
  public static function propiedades(Router $router) {
    $propiedades = Propiedad::all();

    $router->render('paginas/propiedades', [
      'propiedades' => $propiedades
    ]);
  }

  /**
   * FUncion encargada de renderizar propiedad
   *
   * @access public
   * @author Julian Penagos <jpenagosdev@gmail.com> 
   * @static
   * @param Router $router instacia de router
   * 
   */
  public static function propiedad(Router $router) {
    $id = validarORedireccionar('/propiedades');

    // buscar la propiedad por su id
    $propiedad = Propiedad::find($id);

    $router->render('paginas/propiedad', [
      'propiedad' => $propiedad
    ]);
  }

  /**
   * Funcion encargada de renderizar el blog
   *
   * @author Julian Penagos <jpenagosdev@gmail.com>
   * @access public
   * @static
   * @param Router $router instacia de router
   * 
   **/
  public static function blog(Router $router) {
    $router->render('paginas/blog');
  }

  /**
   * Funcion encargada de renderizar la entrada de blog
   *
   * @author Julian Penagos <jpenagosdev@gmail.com>
   * @access public
   * @static
   * @param Router $router instacia de router
   * 
   **/
  public static function entrada(Router $router) {
    $router->render('paginas/entrada');
  }

  /**
   * Función encargada de renderizar contacto
   *
   * @author Julian Penagos <jpenagosdev@gmail.com>
   * @access public
   * @static
   * @param Router $router instacia de router
   * 
   **/
  public static function contacto(Router $router) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      debuguear($_POST);
    }

    $router->render('paginas/contacto', []);
  }
}