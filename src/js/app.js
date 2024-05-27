document.addEventListener('DOMContentLoaded', () => {
	eventListeners();
	darkMode();
});

const darkMode = () => {
	// ? Leer las preferencias del usuario en cuanto al color de fondo
	const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
	// console.log(prefiereDarkMode.matches);
	if (prefiereDarkMode.matches) {
		document.body.classList.add('dark-mode');
	} else {
		document.body.classList.remove('dark-mode');
	}

	prefiereDarkMode.addEventListener('change', () => {
		if (prefiereDarkMode.matches) {
			document.body.classList.add('dark-mode');
		} else {
			document.body.classList.remove('dark-mode');
		}
	});

	const botonDarkMode = document.querySelector('.dark-mode-boton');

	botonDarkMode.addEventListener('click', () => {
		document.body.classList.toggle('dark-mode');
	});
};

const eventListeners = () => {
	const mobileMenu = document.querySelector('.mobile-menu');
	mobileMenu.addEventListener('click', navegacionResponsive);

	// Muestra campos condicionales
	const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]')

	metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))

};

const navegacionResponsive = () => {
	const navegacion = document.querySelector('.navegacion');

	// ? Agregar la clase mostrar cuando hacemos click en el icono del menú de hamburguesa
	navegacion.classList.toggle('mostrar');
};

function mostrarMetodosContacto(event) {
	const contactoDiv = document.querySelector('#contacto')
	if (event.target.value === 'telefono') {
		contactoDiv.innerHTML = `
			<label for="telefono">Número de Teléfono</label>
			<input type="tel" name="contacto[telefono]" id="telefono" placeholder="Tu Telefono" />

			<p>Elija la fecha y la hora Para la llamada</p>

      <label for="fecha">Fecha</label>
      <input type="date" name="contacto[fecha]" id="fecha" />

      <label for="hora">Hora</label>
      <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00" />
		`
	} else {
		contactoDiv.innerHTML = ` 
			<label for="email">E-mail</label>
			<input type="email" name="contacto[email]" id="email" placeholder="Tu Email" />
		`
	}
}