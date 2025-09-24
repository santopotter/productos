<?php
try {
    $conn = new PDO("pgsql:host=localhost;port=5432;dbname=productos_bd;user=postgres;password=root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    header('Content-Type: application/json');
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
    exit;
}
