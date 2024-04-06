<?php
session_start();
//Comprobar que desde el formulario se haya recibido un valor númerico.
$numberPlayer = $_POST['number'];

if(!isset($numberPlayer)){
    die('Favor ingresar un valor correcto.');
}
if(!is_numeric($numberPlayer)){
    die('El valor ingresado no es correcto. Ingresar un valor numérico.');
}

function generateNumberRandom(){
    /*Determinar el rango de dígitos para generar el número ha adivinar.
        Con la función shuffle busco que se pueda generar un número único en cada ronda, y al final extraer los primeros 4 números
        generados.
    */
    $numbers = range(0,9);
    shuffle($numbers);
    return implode(array_slice($numbers, 0,4));
}

/** Para determinar que el número ingresado es el correcto o esta cerca de serlo, se usa una función que compare dos arreglos de 4 posiciones cada uno e identificar donde hay coincidencias almacenando estos valores en su respectiva variable. */

function IdentifyPicasFixes($secretNumber, $numberPlayer){
    $Picas = 0;
    $Fixes = 0;
    for ($x=0; $x < 4; $x++) {
        if($secretNumber[$x] == $numberPlayer[$x]){
            $Fixes++;
        }elseif (strpos($numberPlayer, $secretNumber[$x])!== false) {
            $Picas++;
        }
    }
    return [$Picas,$Fixes];
}

/**Teniendo en cuenta que en cada intento dentro del juego el número ha adivinar no se almacena en una base de datos, se emplea la función SESSION para mantener los valores y la cantidad de intentos realizados por el jugador. */
if(!isset($_SESSION['secretNumber'])){
    $_SESSION['secretNumber'] = generateNumberRandom();
    $_SESSION['attempts'] = 0;
}
$secretNumber = $_SESSION['secretNumber'];
$attempts = $_SESSION['attempts'];

list($Picas, $Fixes) = IdentifyPicasFixes($secretNumber, $numberPlayer);

$attempts++;

$_SESSION['attempts'] = $attempts;

$TEMP = $_SESSION['secretNumber'];
if($Fixes==4){
    echo "<h5 class='light-green-text text-accent-4'>¡Felicidades! Has adivinado el número secreto $TEMP en $attempts intentos.</h5><br><br>";

    // Destruir la sesión para resetear los valores
    session_destroy();
    echo "
    <script>$('#reset').show();
    $('#formGame').hide();
    </script>";
}else{
    echo "<h6 class='blue-text text-darken-2'>Picas: $Picas, Fijas: $Fixes. Intentos: $attempts.</h6>";
}
?>