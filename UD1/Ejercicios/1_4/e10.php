<?php
$errors = [];
$data = ['nombre' => '', 'email' => '', 'edad' => '', 'web' => ''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Saneamiento inicial
    $data['nombre'] = trim($_POST['nombre'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['edad'] = trim($_POST['edad'] ?? '');
    $data['web'] = trim($_POST['web'] ?? '');

    // Saneamos con filtros adecuados
    $nombre_san = filter_var($data['nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email_san = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $edad_san = filter_var($data['edad'], FILTER_SANITIZE_NUMBER_INT);
    $web_san = filter_var($data['web'], FILTER_SANITIZE_URL);

    // Validaciones
    // Nombre: no vacío y solo letras y espacios
    $pattern = '/^[A-Za-zÁÉÍÓÚáéíóúÑñÜü\s]+$/u';
    if ($nombre_san === '' || !filter_var($nombre_san, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]])) {
        $errors['nombre'] = 'Nombre inválido. Solo letras y espacios.';
    }

    // Email
    if (!filter_var($email_san, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email inválido.';
    }

    // Edad: entero entre 18 y 120 (por ejemplo)
    $edad_val = filter_var($edad_san, FILTER_VALIDATE_INT, ['options' => ['min_range' => 18, 'max_range' => 120]]);
    if ($edad_val === false) {
        $errors['edad'] = 'Edad inválida. Debe ser entero entre 18 y 120.';
    }

    // Web: opcional (si viene, validar)
    if ($web_san !== '') {
        if (!filter_var($web_san, FILTER_VALIDATE_URL)) {
            $errors['web'] = 'URL inválida.';
        }
    }

    // Resultado
    if (empty($errors)) {
        $success = true;
        // Para mostrar, usamos las variables saneadas/validadas
        $data_out = [
            'nombre' => $nombre_san,
            'email' => $email_san,
            'edad' => $edad_val,
            'web' => $web_san
        ];
    } else {
        $success = false;
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Ejercicio 10 - Formulario completo</title>
</head>

<body>
    <h2>Ejercicio 10: Saneamiento y validación de formulario</h2>
    <form method="post">
        <div>
            <label>Nombre: <input type="text" name="nombre" value="<?= $data['nombre'] ?>"></label>
            <?php if (!empty($errors['nombre'])): ?>
                <div style="color:red"><?= $errors['nombre'] ?></div><?php endif; ?>
        </div>
        <div>
            <label>Email: <input type="text" name="email" value="<?= $data['email'] ?>"></label>
            <?php if (!empty($errors['email'])): ?>
                <div style="color:red"><?= $errors['email'] ?></div><?php endif; ?>
        </div>
        <div>
            <label>Edad: <input type="text" name="edad" value="<?= $data['edad'] ?>"></label>
            <?php if (!empty($errors['edad'])): ?>
                <div style="color:red"><?= $errors['edad'] ?></div><?php endif; ?>
        </div>
        <div>
            <label>Web personal (opcional): <input type="text" name="web" size="60"
                    value="<?= $data['web'] ?>"></label>
            <?php if (!empty($errors['web'])): ?>
                <div style="color:red"><?= $errors['web'] ?></div><?php endif; ?>
        </div>
        <div><button type="submit">Enviar</button></div>
    </form>

    <?php if (isset($success) && $success === true): ?>
        <h3>Datos válidos</h3>
        <ul>
            <li>Nombre: <?= $data_out['nombre'] ?></li>
            <li>Email: <?= $data_out['email'] ?></li>
            <li>Edad: <?= (string) $data_out['edad'] ?></li>
            <li>Web: <?= $data_out['web'] !== '' ? $data_out['web'] : '<em>(no proporcionada)</em>' ?>
            </li>
        </ul>
    <?php elseif (isset($success) && $success === false): ?>
        <h3 style="color:darkred">Se encontraron errores — corrige los campos marcados.</h3>
    <?php endif; ?>
</body>

</html>