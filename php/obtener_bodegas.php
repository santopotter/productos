<?php
require __DIR__ . '/../sql/conexion.php';

$stmt = $conn->query("SELECT id_bodega, nombre_bodega FROM bodegas");
$bodegas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($bodegas);
