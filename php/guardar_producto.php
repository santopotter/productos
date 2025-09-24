<?php
require __DIR__ . '/../sql/conexion.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(["message" => "Método no permitido"]);
    exit;
}

$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$descripcion = $_POST["descripcion"];
$materiales = $_POST["materiales"] ?? [];
if (!is_array($materiales)) {
    $materiales = [$materiales];
}
$materiales = implode(",", $materiales);
$id_bodega = $_POST["bodega"];
$id_sucursal = $_POST["sucursal"];
$id_moneda = $_POST["moneda"];

$stmt = $conn->prepare("SELECT * FROM productos WHERE codigo=?");
$stmt->execute([$codigo]);
if ($stmt->rowCount() > 0) {
    header('Content-Type: application/json');
    echo json_encode(["message"=>"El código del producto ya está registrado."]);
    exit;
}

$sql = "INSERT INTO productos (codigo,nombre,precio,descripcion,materiales,id_bodega,id_sucursal,id_moneda) 
        VALUES (?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$codigo,$nombre,$precio,$descripcion,$materiales,$id_bodega,$id_sucursal,$id_moneda]);

header('Content-Type: application/json');
echo json_encode(["message"=>"Producto registrado con éxito."]);
