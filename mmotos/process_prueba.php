<?php
require_once 'includes/db.php';
if ($_POST) {
    $stmt = $pdo->prepare("INSERT INTO pruebas (nombre_cliente, email, telefono, producto_id, fecha_prueba, hora_prueba, mensaje) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$_POST['nombre_cliente'], $_POST['email'], $_POST['telefono'], $_POST['producto_id'], $_POST['fecha_prueba'], $_POST['hora_prueba'], $_POST['mensaje'] ?? '']);
}
header("Location: catalogo.php?prueba=ok");
exit;
?>