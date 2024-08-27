<header id="main-header">
    <!-- main-header-navigation -->
    <nav class="main-header-navigation">
        <div class="main-header-navigation__container u-container logo1">
            <a href="https://contigo-voy.com/" class="main-header-logo">
                <img src="img/logo.gif" alt="Contigo Voy" class="main-header-logo__image ">
            </a>
        </div>
        <div class="header-menu-icon" id="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header-bar">
            <ul class="nav-links" id="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="Blog.php">Blog</a></li>
                <li><a href="psicologos.php">Reservar Cita</a></li>
                <li><a href="Contactanos.php">Contáctanos</a></li>
                <li class="">
                    <a href="./login.php">Iniciar Sesión </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script>
// script.js
window.addEventListener('scroll', function() {
    const header = document.getElementById('main-header');
    if (window.scrollY > 50) { // Puedes ajustar el valor a tu gusto
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Obtiene la URL actual
const currentLocation = window.location.pathname;
const fileName = currentLocation.substring(currentLocation.lastIndexOf('/') + 1);

// Obtiene todos los elementos <a> dentro de la navegación
const navLinks = document.querySelectorAll('.nav-links a');

if (fileName === '') {
    navLinks[0].classList.add('active');
}

// Recorre todos los enlaces y compara su href con la URL actual
navLinks.forEach(link => {
    if (link.href.includes(fileName) && fileName !== '') {
        link.classList.add('active');
    }
});
</script>