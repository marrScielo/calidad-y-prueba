<?php
session_start();
if(isset($_SESSION['logeado'])){
require_once 'conexion/conexion.php';

$db = new conexion;
$pdo = $db->conexion();

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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .actions {
            text-align: center;
        }
        .actions a {
            color: #e74c3c;
            text-decoration: none;
        }
        .actions a:hover {
            text-decoration: underline;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .pagination .current-page {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .return_admin {
            background-color: #f45231; /* Green */
            border: none;
            color: white;
            padding: 5px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        /* Estilos para la barra de búsqueda */
        .search-container {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }
        .search-input {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .search-button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <a class="return_admin" href="usuarios.php">Regresar a admin principal</a>

    <h1>Gestionar Contactenos</h1>

    <!-- Barra de búsqueda -->
    <div class="search-container">
        <form action="gestion_contactanos.php" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Buscar por nombre, email o teléfono" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="search-button">Buscar</button>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Mensaje</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
            <tr>
                <td><?= htmlspecialchars($contacto['id']) ?></td>
                <td><?= htmlspecialchars($contacto['nombre']) ?></td>
                <td><?= htmlspecialchars($contacto['telefono']) ?></td>
                <td><?= htmlspecialchars($contacto['email']) ?></td>
                <td><?= htmlspecialchars($contacto['mensaje']) ?></td>
                <td class="actions">
                    <a href="gestion_contactanos.php?delete=<?= $contacto['id'] ?>" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="gestion_contactanos.php?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" class="<?= ($i == $page) ? 'current-page' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
<?php
}else{
    header("Location: index.php");
}
?>
