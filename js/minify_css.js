const fs = require('fs')
const path = require('path')
const CleanCSS = require('clean-css')

const cssDirectory = path.join(__dirname, '/../css')
let minifiedCSS = ''

fs.readdir(cssDirectory, (err, files) => {
    if (err) {
        return console.error('No se pudo leer el directorio: ', err)
    }

    files.forEach((file) => {
        if (path.extname(file) === '.css') {
            const cssContent = fs.readFileSync(
                path.join(cssDirectory, file),
                'utf8'
            )
            minifiedCSS += new CleanCSS().minify(cssContent).styles
        }
    })

    if (minifiedCSS) {
        fs.writeFileSync(path.join(cssDirectory, 'styles.min.css'), minifiedCSS)
        console.log('Minificación completada. Archivo generado: styles.min.css')
    } else {
        console.log('No se encontraron archivos CSS para minificar.')
    }
})
