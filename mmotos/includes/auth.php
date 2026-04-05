<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
$user_id = $_SESSION['user_id'];
$rol = $_SESSION['rol'];
?>