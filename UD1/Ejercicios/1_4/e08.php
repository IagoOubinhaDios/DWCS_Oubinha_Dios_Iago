<?php
$clean = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $clean = filter_var($texto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 8 - FULL_SPECIAL_CHARS</title>
</head>

<body>
    <h2>Ejercicio 8: FILTER_SANITIZE_FULL_SPECIAL_CHARS</h2>
    <form method="post">
        <label>Texto (HTML, scripts, etiquetas):</label><br>
        <textarea name="texto" rows="8" cols="70"><?= isset($texto) ? $texto : '' ?></textarea><br>
        <button type="submit">Limpiar</button>
    </form>

    <?php if ($clean !== ''): ?>
        <h3>Resultado:</h3>
        <div style="white-space: pre-wrap; border:1px solid #ccc; padding:8px;"><?= $clean ?></div>
    <?php endif; ?>
</body>

</html>