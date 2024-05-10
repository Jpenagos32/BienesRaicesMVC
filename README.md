# BienesRaices

![image](https://github.com/Jpenagos32/BienesRaices/assets/111212922/d1b0a1ce-aa32-499f-919d-cd22273fbbc8)

## Bienvenido/a a mi proyecto de Bienes Raices

Si quieres correr el proyecto dentro de tu máquina local debes seguir lo siguientes pasos

Entry point: `/public/index.php`.s

## Para poder correr el proyecto:

### Tener un servidor local

Se debe contar con un servidor local como apache, se debe tener instalado php y MySQL (tambien se pueden remplazar por el uso del paquete XAMPP)

## Tener una base de datos MySQL

se debe crear una Base de datos MySQL llamada `bienesraices_crud`

una forma de crear rapidamente la base de datos es importar o correr el script que se encuentra en `bienesraices_crud.sql`, esto creará la base de datos, creará las tablas e insertará los datos dentro de la base de datos

### Instalar dependencias

- Una vez clonado el repositorio, se debe entrar en la carpeta del mismo y es necesario instalar las dependencias usando el comando:
`npm install`

- Tambien será necesario instalar las dependencias de composer: `composer install`.

### Una vez instaladas las dependencias

Se debe correr el comando
`gulp` también en la terminal, de esta forma nos aseguramos que carguen correctamente los estilos de la página

### Una vez en la pagina

Para poder ver el dashboard de admin al presionar el boton iniciar sesion debe usar las siguientes credenciales:

**Nota**: antes de usar las credenciales se debe ir a /usuario.php para que se carguen los datos en la tabla de usuarios

Email: correo@correo.com

Password: 123456

### Dependencias

`intervention image` version 2:

-   Es para el procesamiento de imagenes.
-   Leer la [Documentacion](https://image.intervention.io/v3) (requiere `PHP 8.1` o superior)
