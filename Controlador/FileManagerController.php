<?php

class FileManager
{
    private $uploadDir;
    private $maxFileSize;

    public function __construct($uploadDir = "uploads/", $maxFileSize = 8 * 1024 * 1024)
    {
        $this->uploadDir = rtrim($uploadDir, '/') . '/';
        $this->maxFileSize = $maxFileSize;

        // Creamos el directorio de subida si no existe
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * Sube una imagen al servidor dentro de la carpeta 'images/'.
     * @param array $file Datos del archivo (ej. $_FILES['image']).
     * @return string Mensaje de éxito o error.
     */
    public function uploadImage($file)
    {
        $imageDir = $this->uploadDir . "images/";
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }

        // Validar que existe un archivo y no tiene errores
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = basename($file['name']);
            $fileSize = $file['size'];
            $fileType = $file['type'];

            // Comprobar que el archivo es una imagen
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedTypes)) {
                return "Error: Solo se permiten imágenes en formato JPEG, PNG o GIF.";
            }

            // Comprobar el tamaño del archivo
            if ($fileSize > $this->maxFileSize) {
                return "Error: El tamaño de la imagen supera el límite de " . ($this->maxFileSize / 1024 / 1024) . "MB.";
            }

            $uploadFilePath = $imageDir . $fileName;

            // Mover el archivo temporal a la carpeta de destino
            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                return $uploadFilePath;
            } else {
                return "Error al mover el archivo al directorio de subida.";
            }
        } else {
            return "Error en la subida de la imagen.";
        }
    }

    // public function uploadVideo($file) { ... }
    // public function uploadDocument($file) { ... }
}

$fileManager = new FileManager();

?>