document.getElementById("menu-icon").addEventListener("click", function () {
  var navLinks = document.getElementById("nav-links");
  navLinks.classList.toggle("active");
});

// COMENTADO PORQUE GENERA ERROR EN LA CONSOLA
// TODO: Revisar si se necesita

// $(".js-input").keyup(function () {
//   if ($(this).val()) {
//     $(this).addClass("not-empty");
//   } else {
//     $(this).removeClass("not-empty");
//   }
// });
