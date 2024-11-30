const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';    
})

/* Conflicto con la funcion del boton de cambio de tema en info.php

themeToggler.addEventListener('click', () =>{
    document.body.classList.toggle('dark-theme-variables');
    
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

})

*/

const btnajuste = document.querySelector(".ajuste-info");
const btnajuste2 = document.querySelector(".ajuste-info2");
const closea = document.querySelector(".closeaaa");
const navigation = document.querySelector(".navigation");

btnajuste.addEventListener("click", () => {
    navigation.classList.add("active");
});

btnajuste2.addEventListener("click", () => {
    navigation.classList.add("active");
});

closea.addEventListener("click", () => {
    navigation.classList.remove("active");
});



