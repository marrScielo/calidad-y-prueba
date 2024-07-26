document.getElementById("menu-icon").addEventListener("click", function () {
  var navLinks = document.getElementById("nav-links");
  navLinks.classList.toggle("active");
});

$(".js-input").keyup(function () {
  if ($(this).val()) {
    $(this).addClass("not-empty");
  } else {
    $(this).removeClass("not-empty");
  }
});
