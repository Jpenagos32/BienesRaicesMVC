<main class="contenedor seccion">
  <h1>Actualizar Propiedad</h1>

  <?php foreach ($errores as $error) { ?>

    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <a href="/admin" class="boton boton-verde">Volver</a>

  <form class="formulario" method="post" enctype="multipart/form-data"> <!-- enctype sirve para dejar que tambien se suban imagenes -->
    <?php include __DIR__ . '/formulario.php' ?>
    <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
  </form>
</main>