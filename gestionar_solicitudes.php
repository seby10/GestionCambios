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
    <link rel="icon" href="img/logo-uta-png.png" type="image/x-icon">
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
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
            Solicitud actualizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
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
                                <!-- Formulario para actualizar solicitud -->
                                <form action="actualizar_solicitud.php" method="POST" class="d-flex">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                    <!-- Campo de selección para Estado -->
                                    <select name="estado" class="form-select me-2" required>
                                        <option value="Aprobado">Aprobar</option>
                                        <option value="Rechazado">Rechazar</option>
                                    </select>

                                    <input type="text" name="comentarios" placeholder="Comentarios" class="form-control me-2" value="<?php echo htmlspecialchars($row['comentarios']); ?>">

                                    <select name="programador" id="programador" class="form-select me-2" required>
                                        <option value="Sebastián Constante" <?php echo ($row['programador'] == 'Sebastián Constante') ? 'selected' : ''; ?>>Sebastián Constante</option>
                                        <option value="Jhanina Conterón" <?php echo ($row['programador'] == 'Jhanina Conterón') ? 'selected' : ''; ?>>Jhanina Conterón</option>
                                        <option value="Daylé García" <?php echo ($row['programador'] == 'Daylé García') ? 'selected' : ''; ?>>Daylé García</option>
                                        <option value="Pablo Montero" <?php echo ($row['programador'] == 'Pablo Montero') ? 'selected' : ''; ?>>Pablo Montero</option>
                                    </select>

                                    <!-- Botón para enviar el formulario -->
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No hay solicitudes registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>