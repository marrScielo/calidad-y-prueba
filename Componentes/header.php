<style>
.nav-links {
    list-style: none; 
    padding: 0; 
    margin: 0; 
    display: flex; 
}

.nav-item {
    position: relative; 
    overflow: hidden;
}
.nav-item:last-child {
    margin-right: 0;
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


.header-menu-icon{
    width: 40px;
    height: 40px;
    cursor: pointer;
    color: var(--text-color);
}
.modal_header_options{
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
}

.modal_header_options {
    transform: translateX(-100%); 
    transition: opacity 0.3s ease, transform 0.3s ease; 
    visibility: hidden; 
    opacity: 0; 
}

.modal_header_options.active {
    opacity: 1; 
    transform: translateX(0); 
    visibility: visible; 
}

.modal_header_options.closing {
    opacity: 0; 
    transform: translateX(-100%);
}

.modal_header_logo__image{
    height: 55px;
    object-fit: fill;
}
.close_modal_header_options{
    width: 30px;
    height: 30px;
    color: black;
    font-weight: bold;
    cursor: pointer;
}
.modal_header_options__container{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;

}
.modal_header_principal_container{
    background-color: white;
    width: 70%;
    height: 100%;
    max-width: 450px;
    @media (min-width: 425px) {
        width: 80%;
    }
}
.header_menu_options{
    color: white;
    width: 100%;
    padding: 0 20px;
    a{
        display: flex;
        color: white;
        text-decoration: none;
        text-align: center;
        font-size: 1rem;
        width: 100%;
        padding: 15px 0;
        background-color: #9986d9;
        border-radius: 10px;
        transition: background-color 0.3s ease;
        justify-content: center;
        &:hover{
            background-color: var(--text-color);
        }
        span{
            text-align: center;
        }
        margin-top: 20px;
        @media (min-width: 425px) {
            font-size: 1.2rem;
        }
    }

}


@media (max-width: 768px) {
    .header-bar{
        display: none;
    }
    .header-menu-icon {
        display: flex; 
    }
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
                <img src="https://ik.imagekit.io/m5f5k3axy/logo.gif?updatedAt=1733936878099" class="main-header-logo__image" alt="">
                <!-- <video autoplay loop muted>
                    <source src="img/logo.webm" alt="Contigo Voy" class="main-header-logo__image ">
                </video> -->
            </a>
        </div>
        <div class="header-menu-icon" id="menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
        <div class="modal_header_options">
            <div class="modal_header_principal_container">
                <div class="modal_header_options__container">
                    <img src="img/logo.gif" alt="Contigo Voy" class="modal_header_logo__image">
                    <div class="close_modal_header_options">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>

                    </div>
                </div>
                <hr>
                <div>
                    <ul class="">
                        <?php foreach ($navItems as $idx => $navItem): ?>
                            <li class="header_menu_options">
                                <a href="<?php echo $navItem['link']; ?>" class="">
                                    <span><?php echo $navItem['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>

        </div>
        <div class="header-bar">
            <ul class="nav-links" id="nav-links">
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
    const hamburger = document.querySelector('.header-menu-icon');
    const modal= document.querySelector('.modal_header_options');
    const closeModal= document.querySelector('.close_modal_header_options');
    hamburger.addEventListener('click', () => {
        modal.classList.remove('closing'); 
        modal.classList.toggle('active');
    });
    const cerrarModal=()=>{
        if (modal.classList.contains('active')) {
        modal.classList.add('closing'); // Añade clase de cierre
        setTimeout(() => {
            modal.classList.remove('active', 'closing'); 
        }, 300); 
    } else {
        modal.classList.remove('closing'); 
        modal.classList.add('active'); 
    }
    }
    closeModal.addEventListener('click', () => {
        cerrarModal();
        
         }
    );
    window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        modal.classList.remove('active');
    }
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            cerrarModal()
        }
    });
});
</script>

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

