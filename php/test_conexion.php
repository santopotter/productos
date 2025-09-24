<?php
require __DIR__ . '/../sql/conexion.php';

try {
    $stmt = $conn->query("SELECT 1");
    echo " Conexión OK";
} catch (Exception $e) {
    echo " Error en conexión: " . $e->getMessage();
}
