<main class="contenedor seccion">
  <h1>Actualizar Vendedor</h1>
  <a href="../" class="boton boton-verde">Volver</a>

  <?php foreach ($errores as $error) { ?>

    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php } ?>

  <!-- el enctype es para poder subir archivos debe ponerse como está debajo de esta linea -->
  <form action="" class="formulario" method="POST" action='/admin/vendedores/actualizar.php'>
    <?php include __DIR__ . '/formulario.php'?>
    <input type="submit" value="Guardar Cambios" class="boton boton-verde">
  </form>

</main>