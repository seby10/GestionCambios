<?php
include 'conexion.php';

// Obtener ID de la solicitud a través del parámetro GET
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Obtener detalles de la solicitud seleccionada
$sql = "SELECT id, estado, comentarios, programador FROM solicitudes WHERE id = $id";
$result = $conn->query($sql);
$solicitud = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Actualizar Solicitud</title>
    <link rel="icon" href="img/logo-uta-png.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script>

        function confirmAction() {
            const estado = document.getElementById('estado').value;
            if (estado === 'Pendiente') {
                alert("El cambio seguirá en estado 'Pendiente' y no se realizará ninguna actualización.");
                return false;  
            } else if (estado === 'Aprobado') {
                return confirm("¿Está seguro de aprobar este cambio?");
            }
            return confirm("¿Está seguro de rechazar este cambio?");
        }

        window.onload = function() {
            const estado = "<?php echo $solicitud['estado']; ?>";
            if (estado === 'Aprobado' || estado === 'Rechazado') {
                document.getElementById('estado').disabled = true;
                document.getElementById('comentarios').disabled = true;
                document.getElementById('programador').disabled = true;
                document.querySelector('button[type="submit"]').disabled = true; 
            }
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestión de Cambios</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="gestionar_solicitudes.php">Solicitudes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Actualizar Solicitud - ID: <?php echo $solicitud['id']; ?></h2>

        <form action="actualizar_solicitud.php" method="POST" class="d-flex flex-column" onsubmit="return confirmAction()">

            <!-- Campo oculto con el ID de la solicitud -->
            <input type="hidden" name="id" value="<?php echo $solicitud['id']; ?>">

            <!-- Campo de selección para Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado de la Solicitud</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="Pendiente" <?php echo ($solicitud['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                    <option value="Aprobado" <?php echo ($solicitud['estado'] == 'Aprobado') ? 'selected' : ''; ?>>Aprobado</option>
                    <option value="Rechazado" <?php echo ($solicitud['estado'] == 'Rechazado') ? 'selected' : ''; ?>>Rechazado</option>
                </select>
            </div>

            <!-- Campo de texto para Comentarios -->
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios</label>
                <input type="text" name="comentarios" id="comentarios" placeholder="Comentarios" class="form-control" value="<?php echo htmlspecialchars($solicitud['comentarios']); ?>">
            </div>

            <!-- Campo de selección para Programador -->
            <div class="mb-3">
                <label for="programador" class="form-label">Seleccionar Programador</label>
                <select name="programador" id="programador" class="form-select" required>
                    <option value="Sebastián" <?php echo ($solicitud['programador'] == 'Sebastián Constante') ? 'selected' : ''; ?>>Sebastián Constante</option>
                    <option value="Jhanina" <?php echo ($solicitud['programador'] == 'Jhanina Conterón') ? 'selected' : ''; ?>>Jhanina Conterón</option>
                    <option value="Daylé" <?php echo ($solicitud['programador'] == 'Daylé García') ? 'selected' : ''; ?>>Daylé García</option>
                    <option value="Pablo" <?php echo ($solicitud['programador'] == 'Pablo Montero') ? 'selected' : ''; ?>>Pablo Montero</option>
                </select>
            </div>

            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

        <a href="gestionar_solicitudes.php" class="btn btn-secondary mt-3">Volver a Solicitudes</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
