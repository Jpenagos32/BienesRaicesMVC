<main class="contenedor seccion">
  <h1>Contacto</h1>
  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp" />
    <source srcset="build/img/destacada3.jpeg" type="image/jpeg" />
    <img src="build/img/destacada3.jpg" alt="imagen de contacto" />
  </picture>

  <h2>Llene el formulario de contacto</h2>
  <form action="/contacto" class="formulario" method="post">
    <fieldset>
      <legend>Información Personal</legend>

      <label for="nombre">Nombre</label>
      <input type="text" name="contacto[nombre]" id="nombre" placeholder="Tu Nombre" />

      <label for="email">E-mail</label>
      <input type="email" name="contacto[email]" id="email" placeholder="Tu Email" />

      <label for="telefono">Teléfono</label>
      <input type="tel" name="contacto[telefono]" id="telefono" placeholder="Tu Telefono" />

      <label for="mensaje">Mensaje:</label>
      <textarea name="contacto[mensaje]" id="mensaje" cols="30" rows="10"></textarea>
    </fieldset>

    <fieldset>
      <legend>Información sobre la Propiedad</legend>
      <label for="opciones">Vende o Compra:</label>
      <select name="contacto[tipo]" id="opciones">
        <option value="" disabled selected>-seleccione-</option>
        <option value="Compra">Compra</option>
        <option value="Vende">Vende</option>
      </select>

      <label for="presupuesto">Precio o Presupuesto</label>
      <input type="number" name="contacto[precio]" id="presupuesto" placeholder="Tu precio o presupuesto" />
    </fieldset>

    <fieldset>
      <legend>Información Sobre La Propiedad</legend>
      <p>Como desea ser contactado</p>

      <div class="forma-contacto">
        <label for="contactar-telefono">Teléfono</label>
        <input type="radio" name="contacto[contacto]" id="contactar-telefono" value="telefono" />

        <label for="contactar-email">E-Mail</label>
        <input type="radio" name="contacto[contacto]" id="contactar-email" value="email" />
      </div>

      <p>Si eligio teléfono elija la fecha y la hora</p>

      <label for="fecha">Fecha</label>
      <input type="date" name="contacto[fecha]" id="fecha" />

      <label for="hora">Hora</label>
      <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00" />
    </fieldset>

    <input type="submit" id="Enviar" value="Enviar" class="boton-verde" />
  </form>
</main>