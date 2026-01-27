<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $val = $_POST['valor'] ?? '';
    // Usamos FILTER_VALIDATE_BOOLEAN con la bandera FILTER_NULL_ON_FAILURE para detectar valores inválidos
    $flags = ['flags' => FILTER_NULL_ON_FAILURE];
    $bool = filter_var($val, FILTER_VALIDATE_BOOLEAN, $flags);
    if ($bool === null) {
        $result = "Valor NO reconocido como booleano válido.";
    } else {
        $result = "Valor booleano resultante: " . ($bool ? 'true' : 'false');
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 9 - Booleanos</title>
</head>

<body>
    <h2>Ejercicio 9: Validar booleanos</h2>
    <form method="post">
        <label>Introduce: "true","false",1,0,"yes","no": <input type="text" name="valor"
                value="<?= isset($val) ? $val : '' ?>"></label>
        <button type="submit">Validar</button>
    </form>
    <?php if ($result !== ''): ?>
        <p><strong><?= $result ?></strong></p>
    <?php endif; ?>
</body>

</html>