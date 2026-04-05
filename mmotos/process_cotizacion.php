<?php
require_once 'includes/db.php';
if ($_POST) {
    $stmt = $pdo->prepare("INSERT INTO cotizaciones (nombre_cliente, email, telefono, producto_id, mensaje) VALUES (?,?,?,?,?)");
    $stmt->execute([$_POST['nombre_cliente'], $_POST['email'], $_POST['telefono'], $_POST['producto_id'], $_POST['mensaje'] ?? '']);
}
header("Location: catalogo.php?cotizacion=ok");
exit;
?>