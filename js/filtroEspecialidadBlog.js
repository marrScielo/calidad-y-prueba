function toggleDropdownBlog() {
    var filterForm = document.getElementById("filter-form");
    filterForm.classList.toggle("show");
    console.log("prueba");
}

window.onclick = function(event) {
    // Verifica si el clic no fue en el h2 o en el formulario de filtro
    if (!event.target.matches('.container-rosado h2') && !event.target.closest('.filter-form')) {
        var dropdowns = document.getElementsByClassName("filter-form");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}