<?php
require __DIR__ . '/../sql/conexion.php';

$id_bodega = intval($_GET['id_bodega'] ?? 0);
$stmt = $conn->prepare("SELECT id_sucursal, nombre_sucursal FROM sucursales WHERE id_bodega=?");
$stmt->execute([$id_bodega]);
$sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($sucursales);
