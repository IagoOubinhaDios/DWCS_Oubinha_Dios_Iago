<?php
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numRaw = $_POST['numero'] ?? '';
    // Sanea: elimina caracteres no numéricos salvo signo, punto y coma de miles (se permite fracción).
    // Aqui vemos otra forma de poner flags en las opciones (sin un array)
    $san = filter_var($numRaw, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC);
    // Normalmente FILTER_SANITIZE_NUMBER_FLOAT deja comas de miles; reemplazamos posibles comas decimales por punto si el usuario usó coma
    // Primero quitamos separadores de miles (coma o espacio) si hay también punto decimal
    $san = str_replace(' ', '', $san);
    // Si hay tanto ',' como '.' asumimos que ',' es miles -> quitar comas
    if (strpos($san, ',') !== false && strpos($san, '.') !== false) {
        $san = str_replace(',', '', $san);
    } else {
        // Si solo tiene coma, convertir coma decimal a punto
        if (strpos($san, ',') !== false && strpos($san, '.') === false) {
            $san = str_replace(',', '.', $san);
        }
    }
    // Validamos como float
    if ($san !== '' && filter_var($san, FILTER_VALIDATE_FLOAT) !== false) {
        $result = "Número válido (float): " . $san;
    } else {
        $result = "No es un número decimal válido. Entrada saneada: " . $san;
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 6 - Float</title>
</head>

<body>
    <h2>Ejercicio 6: Saneamiento y validación de número decimal</h2>
    <form method="post">
        <label>Número decimal: <input type="text" name="numero"
                value="<?= isset($numRaw) ? $numRaw: '' ?>"></label>
        <button type="submit">Comprobar</button>
    </form>
    <?php if ($result !== ''): ?>
        <p><strong><?= $result ?></strong></p>
    <?php endif; ?>
</body>

</html>