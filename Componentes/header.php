<style>
.nav-links {
    list-style: none; 
    padding: 0; 
    margin: 0; 
    display: flex; 
}

.nav-item {
    position: relative; 
    margin-right: 2rem; 
    overflow: hidden;
}

.nav-link {
    text-decoration: none; 
    color: #6c757d; 
    padding: 0.5rem 1rem; 
    position: relative; 
    z-index: 1; 
    transition: color 0.3s ease; 
}

.hover-bg {
    content: ''; 
    position: absolute; 
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #524388; 
    border-radius: 5px; 
    transform: scale(0); 
    transition: transform 0.3s ease; 
    z-index: -1;
}

.nav-item:hover .hover-bg {
    transform: scale(1); 
}

.nav-item:hover .nav-link {
    color: #ffffff; 
}

</style>
<?php
$navItems = [
    ['name' => 'Inicio', 'link' => 'index.php'],
    ['name' => 'Blog', 'link' => 'Blog.php'],
    ['name' => 'Reservar Cita', 'link' => 'psicologos.php'],
    ['name' => 'Contáctanos', 'link' => 'Contactanos.php'],
    ['name' => 'Iniciar Sesión', 'link' => './login.php'],
];
?>
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
            <ul class="nav-links">
                <?php foreach ($navItems as $idx => $navItem): ?>
                    <li class="nav-item">
                        <a href="<?php echo $navItem['link']; ?>" class="nav-link">
                            <span><?php echo $navItem['name']; ?></span>
                            <div class="hover-bg"></div>
                        </a>
                    </li>
                <?php endforeach; ?>
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

