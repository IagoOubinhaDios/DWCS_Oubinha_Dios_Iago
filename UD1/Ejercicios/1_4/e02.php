<?php
$clean = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $clean = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 2 - Sanitizar texto</title>
</head>

<body>
    <h2>Ejercicio 2: Saneamiento con FILTER_SANITIZE_SPECIAL_CHARS</h2>
    <form method="post">
        <label>Texto (con HTML):</label><br>
        <textarea name="texto" rows="6" cols="60"><?= isset($texto) ? $texto : '' ?></textarea><br>
        <button type="submit">Sanear</button>
    </form>

    <?php if ($clean !== ''): ?>
        <h3>Texto limpio:</h3>
        <div style="white-space: pre-wrap; border:1px solid #ccc; padding:8px;"><?= $clean ?></div>
    <?php endif; ?>
</body>

</html>