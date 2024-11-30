<?php
include 'conexion.php';

// Obtener los datos enviados por el formulario
$id = $_POST['id'];
$estado = $_POST['estado'];
$comentarios = $_POST['comentarios'];

// Validar que el ID y el estado no estén vacíos
if (!empty($id) && !empty($estado)) {
    // Actualizar el estado de la solicitud
    $sql = "UPDATE solicitudes SET estado = ?, comentarios = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $estado, $comentarios, $id);

    if ($stmt->execute()) {
        // Redirigir de vuelta a la página de solicitudes
        header("Location: gestionar_solicitudes.php?success=1");
    } else {
        echo "Error al actualizar la solicitud: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error: ID o estado inválido.";
}

$conn->close();
?>
