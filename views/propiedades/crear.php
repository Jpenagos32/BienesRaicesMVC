<main class="contenedor seccion">
  <h1>Crear</h1>

  <?php foreach ($errores as $error) { ?>

    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <form class="formulario" method="post" enctype="multipart/form-data"> <!-- enctype sirve para dejar que tambien se suban imagenes -->
    <?php include __DIR__ . '/formulario.php' ?>
    <input type="submit" value="Crear Propiedad" class="boton boton-verde">
  </form>
</main>