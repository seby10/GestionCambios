<?php
include 'conexion.php';

// Obtener los datos del formulario
$nombre_solicitante = $_POST['nombre_solicitante'];
$area_departamento = $_POST['area_departamento'];
$titulo_cambio = $_POST['titulo_cambio'];
$descripcion_detallada = $_POST['descripcion_detallada'];
$impacto_tiempo = $_POST['impacto_tiempo'];
$impacto_costo = $_POST['impacto_costo'];
$impacto_calidad = $_POST['impacto_calidad'];
$nivel_urgencia = $_POST['nivel_urgencia'];
$fecha_deseada = $_POST['fecha_deseada'];
$fecha_solicitud = date('Y-m-d');

// Insertar datos en la tabla
$sql = "INSERT INTO solicitudes (
    nombre_solicitante,
    area_departamento,
    titulo_cambio,
    descripcion_detallada,
    impacto_tiempo,
    impacto_costo,
    impacto_calidad,
    nivel_urgencia,
    fecha_deseada,
    fecha_solicitud,
    estado
) VALUES (
    '$nombre_solicitante',
    '$area_departamento',
    '$titulo_cambio',
    '$descripcion_detallada',
    '$impacto_tiempo',
    '$impacto_costo',
    '$impacto_calidad',
    '$nivel_urgencia',
    '$fecha_deseada',
    '$fecha_solicitud',
    'Pendiente'
)";

if ($conn->query($sql) === true) {
    header("Location: gestionar_solicitudes.php?success=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
