console.log('main.js ofertas');

const $textDescription = document.getElementById('description');
const $htmlDescription = document.getElementById('description-html');

$textDescription.addEventListener('input', function () {
    console.log('input');
    console.log(this.value);
    $htmlDescription.innerHTML = convertTextToHTML(this.value);
});

function convertTextToHTML(text) {
    return text.replace(/\n/g, '<br>');
}
