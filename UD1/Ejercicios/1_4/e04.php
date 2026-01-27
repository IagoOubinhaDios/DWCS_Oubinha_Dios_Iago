<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urlRaw = $_POST['url'] ?? '';
    $urlSan = filter_var($urlRaw, FILTER_SANITIZE_URL);
    if (filter_var($urlSan, FILTER_VALIDATE_URL)) {
        $result = "URL válida: " . $urlSan;
    } else {
        $result = "URL NO válida. Entrada saneada: " . $urlSan;
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 4 - URL</title>
</head>

<body>
    <h2>Ejercicio 4: Saneamiento y validación de URL</h2>
    <form method="post">
        <label>URL: <input type="text" name="url" size="60"
                value="<?= isset($urlRaw) ? $urlRaw: '' ?>"></label>
        <button type="submit">Comprobar</button>
    </form>
    <?php if ($result !== ''): ?>
        <p><strong><?= $result ?></strong></p>
    <?php endif; ?>
</body>

</html>