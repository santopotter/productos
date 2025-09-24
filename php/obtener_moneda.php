<?php
require __DIR__ . '/../sql/conexion.php';

$stmt = $conn->query("SELECT id_moneda, nombre_moneda FROM monedas");
$monedas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($monedas);
