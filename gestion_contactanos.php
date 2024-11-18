<?php
session_start();
if (isset($_SESSION['logeado'])) {
    require_once 'conexion/conexion.php';

    $db = new conexion;
    $pdo = $db->getPDO();

    // Eliminar registro si se ha solicitado
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM contacto WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: gestion_contactanos.php");
        exit();
    }

    // Búsqueda
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Paginación
    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $records_per_page;

    if ($search) {
        $stmt = $pdo->prepare("SELECT * FROM contacto WHERE nombre LIKE :search OR email LIKE :search OR telefono LIKE :search LIMIT :start, :records_per_page");
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM contacto LIMIT :start, :records_per_page");
    }
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($search) {
        $total_stmt = $pdo->prepare("SELECT COUNT(*) FROM contacto WHERE nombre LIKE :search OR email LIKE :search OR telefono LIKE :search");
        $total_stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $total_stmt->execute();
    } else {
        $total_stmt = $pdo->query("SELECT COUNT(*) FROM contacto");
    }
    $total_rows = $total_stmt->fetchColumn();
    $total_pages = ceil($total_rows / $records_per_page);
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Gestionar Contactenos</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="./Issets/css/gestion_contactanos.css">
    </head>

    <body>
        <?php if ($_SESSION['rol'] == 'administrador'): ?>
            <a class="return_admin" href="usuarios.php">Regresar a admin principal</a>
        <?php endif; ?>


        <div class="container">
            <div class="container-h1-btn">
                <h1>Gestionar envio de contacto</h1>
                <form action="usuarios.php" method="POST">
                    <input type="hidden" name="accion" value="cerrar_sesion">
                    <input type="submit" value="Cerrar sesión" class="salir">
                </form>
            </div>
        </div>

        <!-- Barra de búsqueda -->
        <div class="search-container">
            <form action="gestion_contactanos.php" method="GET">
                <input id="searchContacto" type="text" name="search" class="search-input" placeholder="Buscar por nombre, email o teléfono" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="search-button">Buscar</button>
            </form> 
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tableNomContacto">
                <?php foreach ($contactos as $contacto): ?>
                    <tr>
                        <td><?= htmlspecialchars($contacto['id']) ?></td>
                        <td><?= htmlspecialchars($contacto['nombre']) ?></td>
                        <td><?= htmlspecialchars($contacto['telefono']) ?></td>
                        <td><?= htmlspecialchars($contacto['email']) ?></td>
                        <td><?= htmlspecialchars($contacto['mensaje']) ?></td>
                        <td class="actions-delete">
                            <a href="gestion_contactanos.php?delete=<?= $contacto['id'] ?>" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="gestion_contactanos.php?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" class="<?= ($i == $page) ? 'current-page' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchContacto').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#tableNomContacto tr').filter(function() {
                    // No se filtra la fila del encabezado
                    if ($(this).find('td:eq(1)').length > 0) {
                        $(this).toggle($(this).find('td:eq(1)').text().toLowerCase().indexOf(value) > -1);
                        
                    }
                });
            });
        });
    </script>

    </html>



<?php
} else {
    header("Location: index.php");
}
?>