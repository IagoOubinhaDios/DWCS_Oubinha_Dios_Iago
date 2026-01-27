<?php
function generarNumeros(int $nivel)
{
    $numeros = [];
    for ($i = 0; $i < $nivel; $i++) {

        $numeros[] = rand(1, 4);
    }

    return $numeros;
}

function comprobarNumeros($in, $goal)
{
    return $in == $goal;
}

// Numeros que introduce el usuario.
$numsIn = $_POST['in_nums'] ?? [];
//Numeros generados
$nums = $_POST['nums'] ?? [];
$nums = is_array($nums) ? $nums : explode("-", $nums);
$nivel = $_POST['nivel'] ?? 0;

$jugando = comprobarNumeros($numsIn, $nums);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simón dice</title>
    <style>
        .hidden {
            display: none;
        }
    </style>

    <script>
        function ocultarNumero() {
            setTimeout(
                function () {
                    document.getElementById('numeros').classList.add('hidden');
                    document.getElementById('formulario').classList.remove('hidden');
                }
                , 3000
            );
        }
    </script>
    <style>
        .container{
            display: flex;
        }

        input{
            width: 50px;
        }

    </style>
</head>

<body onload="ocultarNumero()">
    <h1>Simón dice</h1>
    <!-- Sección de números -->
    <?php if ($jugando): ?>
        <div id="numeros">
            <h2>Memoriza estos números en orden</h2>
            <?php
            $nivel++;
            $nums = generarNumeros($nivel);
            echo implode("-", $nums);
            ?>
        </div>
        <div id="formulario" class="hidden">
            <form action="" method="post">
                <label for="in_nums">Números</label><br>
                <div class="container">
                    <?php
                    for ($i = 0; $i < $nivel; $i++) {
                        echo '<input type="text" name="in_nums[]"><br>';
                    }
                    ?>
                </div>
                <input type="hidden" name="nums" value="<?php echo implode("-", $nums) ?>">
                <input type="hidden" name="nivel" value="<?php echo $nivel; ?>">
                <button type="submit">Comprobar</button>
            </form>
        </div>
    <?php else: ?>
        <div id="resultado">
            <?php
            echo "Has fallado!<br>Los números eran ", implode("-", $nums), " y tu respuesta fue ", implode("-", $numsIn);
            ?>
            <br>
            <a href="">Empezar nuevo juego</a>
        </div>
    <?php endif; ?>

</body>

</html>