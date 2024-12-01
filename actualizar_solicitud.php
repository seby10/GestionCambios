<?php
include 'conexion.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por el formulario
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $comentarios = $_POST['comentarios'];
    $programador = $_POST['programador'];

    // Validar que el ID y el estado no estén vacíos
    if (!empty($id) && !empty($estado)) {
        // Actualizar el estado de la solicitud
        $sql = "UPDATE solicitudes SET estado = ?, comentarios = ?, programador = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $estado, $comentarios, $programador, $id);

        if ($stmt->execute()) {
            // Redirigir de vuelta a la página de solicitudes con éxito
            header("Location: gestionar_solicitudes.php?success=1");
            exit; // Asegúrate de que no haya más código después de header()
        } else {
            echo "Error al actualizar la solicitud: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error: ID o estado inválido.";
    }
}

$conn->close();
