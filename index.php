<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Picas y Fijas</title>
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row offset-s6">
            <div class="col m3"></div>
            <div class="col m6 offset-s3">
                <div class="card">
                    <div class="card-image">
                        <img src="images/sample-1.jpg" alt="Juego">
                        <span class="card-title">
                            <h1>Juego de Picas y fijas</h1>
                        </span>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <p>El juego de Picas y Fijas es un desafío de adivinanzas en el que se genera un número secreto de cuatro dígitos por parte del sistema. El objetivo del jugador es descubrir este número oculto. En cada intento, el jugador propone un número de cuatro dígitos, y el sistema le proporciona pistas sobre su aproximación al número secreto, indicando cuántas "picas" y cuántas "fijas" contiene el número ingresado.<br>
                            Una "pica" señala que un dígito del número propuesto está presente en el número secreto, pero en una posición incorrecta. Por otro lado, una "fija" indica que un dígito del número propuesto coincide tanto en valor como en posición con el número secreto.<br></p>
                        </div>
                        <div class="row">
                            <form class="col s12" id="formGame">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Xxxx" id="numberPlayer" name="numberPlayer" min="0" max="9999" type="number" class="validate" required>
                                        <label for="numberPlayer">Ingresa un número de 4 dígitos:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <button class="btn waves-effect waves-light" type="submit">Jugar <i class="material-icons right">send</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="responseGame"></div>
                        <button id='reset' class="btn waves-effect waves-light">Jugar de nuevo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Compiled and minified JavaScript -->
    <script src="js/materialize.min.js"></script>
    <script>
        document.getElementById('numberPlayer').addEventListener('input', function(event) {
            const input = event.target;
            const number = input.value.trim();
            if (number.length > 4) {
                input.value = number.slice(0, 4);
            }
        });
        $(document).ready(function() {
            /** Ocultar Botones y formulario */
            $("#reset").hide();

            /**Reiniciar juego */
            $("#reset").click(function() {
                $("#responseGame").text('');
                $("#reset").hide();
                $("#formGame").show();
                location.reload();
            });
            $("#formGame").submit(function(ev) {
                console.log("iNGRESA");
                ev.preventDefault();
                let number = $("#numberPlayer").val();
                $.ajax({
                    type: 'POST',
                    url: 'game.php',
                    data: {
                        number: number
                    },
                    success: function(response) {
                        $('#responseGame').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>