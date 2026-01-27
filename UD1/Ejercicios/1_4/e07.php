<?php
// ejercicio7.php
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    // Permitimos letras (incluyendo acentos y ñ) y espacios. Usamos modificador u para UTF-8.
    $pattern = '/^[A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]+$/u';
    if ($nombre !== '' && filter_var($nombre, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]])) {
        $msg = "Nombre válido: " . $nombre;
    } else {
        $msg = "Nombre NO válido. Solo letras y espacios permitidos.";
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 7 - Validar nombre</title>
</head>

<body>
    <h2>Ejercicio 7: Validar nombre con FILTER_VALIDATE_REGEXP</h2>
    <form method="post">
        <label>Nombre: <input type="text" name="nombre"
                value="<?= isset($nombre) ? $nombre : '' ?>"></label>
        <button type="submit">Validar</button>
    </form>
    <?php if ($msg !== ''): ?>
        <p><strong><?= $msg ?></strong></p>
    <?php endif; ?>
</body>

</html>