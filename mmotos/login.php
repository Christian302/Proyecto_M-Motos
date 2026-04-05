<?php
session_start();
require_once 'includes/db.php';
$error = '';

if ($_POST) {
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['rol']     = $user['rol'];
        header("Location: admin/index.php");
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>
<?php require_once 'includes/header.php'; ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black to-red-950">
    <div class="max-w-md w-full bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-10">
        <h2 class="text-4xl font-black text-center mb-8">Acceso Vendedores</h2>
        <?php if($error) echo "<p class='text-red-600 text-center mb-6'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Correo" required class="w-full mb-6 border rounded-2xl p-5">
            <input type="password" name="password" placeholder="Contraseña" required class="w-full mb-8 border rounded-2xl p-5">
            <button type="submit" class="w-full bg-red-600 text-white py-6 rounded-3xl text-xl font-bold">INICIAR SESIÓN</button>
        </form>
        <p class="text-center text-sm mt-8 text-slate-500">Solo para personal autorizado</p>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>