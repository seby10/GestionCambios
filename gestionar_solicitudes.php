<?php
include 'conexion.php';

// Obtener solicitudes
$sql = "SELECT * FROM solicitudes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestión de Cambios</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Formulario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestionar_solicitudes.php">Solicitudes</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2>Solicitudes Registradas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Solicitud</th>
                <th>Solicitante</th>
                <th>Área</th>
                <th>Título</th>
                <th>Urgencia</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fecha_solicitud']; ?></td>
                        <td><?php echo $row['nombre_solicitante']; ?></td>
                        <td><?php echo $row['area_departamento']; ?></td>
                        <td><?php echo $row['titulo_cambio']; ?></td>
                        <td><?php echo $row['nivel_urgencia']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td>
                            <form action="actualizar_solicitud.php" method="POST" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <select name="estado" class="form-select me-2" required>
                                    <option value="Aprobado">Aprobar</option>
                                    <option value="Rechazado">Rechazar</option>
                                </select>
                                <input type="text" name="comentarios" placeholder="Comentarios" class="form-control me-2">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile;?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">No hay solicitudes registradas.</td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
</div>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    Solicitud actualizada correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
