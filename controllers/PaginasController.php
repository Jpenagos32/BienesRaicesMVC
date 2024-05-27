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
   * @param Router $router Instancia del enrutador
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
   * @param Router $router Instancia del enrutador
   **/
  public static function nosotros(Router $router) {
    $router->render('paginas/nosotros');
  }

  /**
   * Función encargada de renderizar Propiedades
   * @access public
   * @static
   * @param Router $router Instancia del enrutador
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
   * @param Router $router Instancia del enrutador
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
   * @param Router $router Instancia del enrutador
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
   * @param Router $router Instancia del enrutador
   * 
   **/
  public static function entrada(Router $router) {
    $router->render('paginas/entrada');
  }

  /**
   * Función encargada de manejar los metodos a usar en el contacto
   * 
   * Esta función tambien se encarga de manejar la petición de tipo post
   * en la cual se realiza el envio del email
   *
   * @author Julian Penagos <jpenagosdev@gmail.com>
   * @access public
   * @static
   * @param Router $router instacia del enrutador
   * 
   **/
  public static function contacto(Router $router) {

    $mensaje = null;


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


      // Enviar de forma condicional algunos campos de email o telefono

      if ($respuestas['contacto'] === 'telefono') {
        $contenido .= '<p>Eligio ser contactado por Telefono</p>';
        $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
        $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha'] . '</p>';
        $contenido .= '<p>Hora de Contacto: ' . $respuestas['hora'] . '</p>';
      } else {
        // Es mail, entonces agregamos el campo de email
        $contenido .= '<p>Eligio ser contactado por email</p>';
        $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
      }

      $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
      $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
      $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';
      $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
      $contenido .= '</html>';

      $mail->Body = $contenido;
      $mail->AltBody = 'Esto es texto alternativo sin HTML';

      // Enviar el email
      if ($mail->send()) {
        $mensaje =  "mensaje enviado correctamente";
      } else {
        $mensaje =  "El mensaje no se pudo enviar...";
      }
    }

    $router->render('paginas/contacto', [
      'mensaje' => $mensaje
    ]);
  }
}
