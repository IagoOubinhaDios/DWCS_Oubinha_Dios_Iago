<?php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edadRaw = $_POST['edad'] ?? '';
    $edad = filter_var($edadRaw, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 18, 'max_range' => 65]
    ]);
    if ($edad !== false) {
        $msg = "Edad válida: $edad";
    } else {
        $msg = "Edad NO válida. Debe ser un entero entre 18 y 65.";
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 3 - Validar edad</title>
</head>

<body>
    <h2>Ejercicio 3: Validar edad (18-65)</h2>
    <form method="post">
        <label>Edad: <input type="text" name="edad" value="<?= isset($edadRaw) ? $edadRaw : '' ?>"></label>
        <button type="submit">Validar</button>
    </form>
    <?php if ($msg !== ''): ?>
        <p><strong><?= $msg ?></strong></p>
    <?php endif; ?>
</body>

</html>