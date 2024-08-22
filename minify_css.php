<?php

function minify_css($css)
{
    // Eliminar comentarios
    $css = preg_replace('!/\*.*?\*/!s', '', $css);
    // Eliminar espacios en blanco, nuevas líneas, etc.
    $css = preg_replace('/\s+/', ' ', $css);
    $css = preg_replace('/\s*([{}|:;,])\s*/', '$1', $css);
    return trim($css);
}

$css_directory = __DIR__ . '/css';
$minified_css = '';

if (is_dir($css_directory)) {
    $css_files = glob($css_directory . '/*.css');

    foreach ($css_files as $css_file) {
        $css_content = file_get_contents($css_file);
        $minified_css .= minify_css($css_content);
    }

    if (!empty($minified_css)) {
        file_put_contents($css_directory . '/styles.min.css', $minified_css);
        echo "Minificación completada. Archivo generado: styles.min.css";
    } else {
        echo "No se encontraron archivos CSS para minificar.";
    }
} else {
    echo "Directorio CSS no encontrado.";
}
?>