<?php
require __DIR__ . '/../sql/conexion.php';

try {
    $stmt = $conn->query("SELECT 1");
    echo "✅ Conexión correcta";
} catch (Exception $e) {
    echo "❌ Error en la conexión: " . $e->getMessage();
}
