<!-- Componentes/psicologo_card.php -->

<div class='psicologo-container'>
    <p style='text-align: center; font-weight: bold;'><?= $psicologo["NombrePsicologo"] ?></p>
    <p><strong>Contacto: +51</strong> <?= $psicologo["celular"] ?><br>
    <strong>Email:</strong> <?= $psicologo["email"] ?></p>
    <?php
    // Extraer el ID del video de YouTube de la URL
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $psicologo["video"], $matches);
    $video_id = $matches[1];
    ?>
    <iframe width='100%' height='200' src='https://www.youtube.com/embed/<?= $video_id ?>' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
    <a href='https://api.whatsapp.com/send?phone=51<?= $psicologo["celular"] ?>' target='_blank'><button style='background-color: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;'>Contactar por WhatsApp</button></a>
</div>
