document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    console.log(prefiereDarkMode)
    // console.log(prefiereDarkMode.matches);
    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach( input => input.addEventListener('click', mostrarMetodosContacto));
}
function mostrarMetodosContacto(e) {

    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono'){
        
        contactoDiv.innerHTML = ` 
            <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

                  <p> elija la fecha y la hora para la llamada</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="contacto[fecha]" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>
        `;
    }else{
        
        contactoDiv.innerHTML = `
        
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required> `;
            
    }

}


function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

function soportaWebp() {
    return new Promise(res => {
        const img = new Image();
        img.onload = () => res(img.width > 0 && img.height > 0);
        img.onerror = () => res(false);
        img.src = "data:image/webp;base64,UklGRiIAAABXRUJQVlA4ICAAAAAwAQCdASoIAAgAAkA0JaQAA3AA/vuUAAA=";
    });
}

soportaWebp().then(soporta => {
    document.documentElement.classList.add(soporta ? 'webp' : 'no-webp');
});