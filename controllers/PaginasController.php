<?php

namespace Controllers;

use Dotenv;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

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
      $respuestas = $_POST['contacto'];

      // Crear una instancia de PHPMailer
      $mail = new PHPMailer();

      $dotenv = Dotenv\Dotenv::createImmutable('../');
      $dotenv->load();

      // Configurar SMTP
      $mail->isSMTP();
      $mail->Host = $_ENV['MAIL_HOST'];
      $mail->SMTPAuth  = true;
      $mail->Username = $_ENV['MAIL_USERNAME'];
      $mail->Password = $_ENV['MAIL_PASSWORD'];
      $mail->SMTPSecure = 'tls';
      $mail->Port = $_ENV['MAIL_PORT'];

      // Configurar el contenido del email
      $mail->setFrom('admin@bienesraices.com');
      $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
      $mail->Subject = 'Tienes un nuevo mensaje';

      // Habilitar HTML
      $mail->isHTML(true);
      $mail->CharSet = 'UTF-8';

      // Definir el contenido
      $contenido = '<html>';
      $contenido .= '<p>Tienes un nuevo mensaje</p>';
      $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
      $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
      $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
      $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
      $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
      $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
      $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
      $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . '</p>';
      $contenido .= '<p>Hora de Contacto: ' . $respuestas['hora'] . '</p>';
      $contenido .= '</html>';

      $mail->Body = $contenido;
      $mail->AltBody = 'Esto es texto alternativo sin HTML';

      // Enviar el email
      if ($mail->send()) {
        echo "mensaje enviado correctamente";
      } else {
        echo "El mensaje no se pudo enviar...";
      }
    }

    $router->render('paginas/contacto', []);
  }
}
