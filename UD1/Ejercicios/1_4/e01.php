<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = "Email válido";
    } else {
        $result = "Email NO válido";
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 1 - Validar email</title>
</head>

<body>
    <h2>Ejercicio 1: Validar un email</h2>
    <form method="post">
        <label>Email: <input type="text" name="email"
                value="<?= isset($email) ? $email : '' ?>"></label>
        <button type="submit">Validar</button>
    </form>
    <?php if ($result !== ''): ?>
        <p><strong><?= $result ?></strong></p>
    <?php endif; ?>
</body>

</html>