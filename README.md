# BienesRaices

![image](https://github.com/Jpenagos32/BienesRaices/assets/111212922/d1b0a1ce-aa32-499f-919d-cd22273fbbc8)

## Bienvenido/a a mi proyecto de Bienes Raices

Si quieres correr el proyecto dentro de tu máquina local debes seguir lo siguientes pasos

Entry point: `/public/index.php`.

## Para poder correr el proyecto:

### Tener un servidor local

Se debe contar con un servidor local como apache, se debe tener instalado php y MySQL (tambien se pueden remplazar por el uso del paquete XAMPP)

## Tener una base de datos MySQL

se debe crear una Base de datos MySQL llamada `bienesraices_crud`

una forma de crear rapidamente la base de datos es importar o correr el script que se encuentra en `ScriptsSQL/bienesraices_crud.sql`, esto creará la base de datos, creará las tablas e insertará los datos dentro de la base de datos

### Instalar dependencias

- Una vez clonado el repositorio, se debe entrar en la carpeta del mismo y es necesario instalar las dependencias usando el comando:
`npm install`

- Tambien será necesario instalar las dependencias de composer: `composer install`.

### Una vez instaladas las dependencias

- Se debe correr el comando
`gulp` también en la terminal, de esta forma nos aseguramos que carguen correctamente los estilos de la página

- Tambien es necesario servir el proyecto, ingresando a la carpeta `public` desde la terminal y ejecutar el comando `php -S localhost:3000` (el puerto 3000 puede ser reemplazado por cualquier otro puerto disponible).

### Una vez en la pagina

Para poder ver el dashboard de admin al presionar el boton iniciar sesion debe usar las siguientes credenciales:

**Nota**: antes de usar las credenciales se debe ir a /usuario.php para que se carguen los datos en la tabla de usuarios

Email: correo@correo.com

Password: 123456

### Dependencias

- `intervention image` version 2:

  - Es para el procesamiento de imagenes.
  - Leer la [Documentacion](https://image.intervention.io/v3) (requiere `PHP 8.1` o superior)

- `PHPMailer`:
  - Dependencia utilizada para poder enviar emails desde php
  - Enlace a [Packagist](https://packagist.org/packages/phpmailer/phpmailer).
  - Para poder funcionar requiere un servidor o proveedor como [Mailtrap](https://mailtrap.io/)

- `vlucas/phpdotenv`: 
  - Libreria para poder usar variables de entorno dentro de php
  - [Repositorio con documentacion](https://github.com/vlucas/phpdotenv)

### Variables de entorno

En la raiz de proyecto debe haber un archivo `.env` donde se incluyan las variables de entorno que serán tomadas de [Mailtrap](https://mailtrap.io/)

Dentro de mailtrap para obetener las variables de entorno se debe ir al inbox seleccionar el inbox que tengamos y en la sección de integraciones seleccionar `PHP` y `laravel 9+` eso nos dará las variables de entorno.

Las variables de entorno deben tener la siguiente estructura

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=YOUROWNUSERNAME
MAIL_PASSWORD=YOUROWNPASSWORD
```