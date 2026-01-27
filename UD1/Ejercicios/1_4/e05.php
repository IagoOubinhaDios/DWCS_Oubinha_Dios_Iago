<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ipRaw = trim($_POST['ip'] ?? '');
    // Validamos IP (IPv4 o IPv6) y además rechazamos rangos privados y reservados
    $valid = filter_var($ipRaw, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    if ($valid !== false) {
        $msg = "IP válida (pública): $valid";
    } else {
        // Revisar si es IP válida pero privada/reservada para dar mensaje más claro
        if (filter_var($ipRaw, FILTER_VALIDATE_IP) !== false) {
            $msg = "La IP es válida sintácticamente pero es PRIVADA o RESERVADA (no permitida).";
        } else {
            $msg = "IP NO válida.";
        }
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 5 - Validar IP</title>
</head>

<body>
    <h2>Ejercicio 5: Validar IP (IPv4/IPv6) y excluir privada/reservada</h2>
    <form method="post">
        <label>Dirección IP: <input type="text" name="ip"
                value="<?= isset($ipRaw) ? $ipRaw : '' ?>"></label>
        <button type="submit">Validar</button>
    </form>
    <?php if ($msg !== ''): ?>
        <p><strong><?= $msg ?></strong></p>
    <?php endif; ?>
</body>

</html>