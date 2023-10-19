<?php
    session_start();
    //session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Las siete y media php</title>
</head>
<body>
    <main>
        <div class="p20px">
            <h1 class="titulo">LAS SIETE Y MEDIA</h1>

<?php
    if(!isset($_SESSION["baraja"]) && !isset($_SESSION["mano"])) {
        echo '
            <h2 class="subtitulo">En php</h2>
        </div>
        <div class="flexcenter">
            <div>
                <a href="controlador.php?accion=comenzarPartida"><button>Jugar</button></a>
            </div>
        </div>
        ';
    } else {
        echo '
                <h2 class="subtituloencurso">Partida en curso</h2>
            </div>
            
            <div class="flexcenter">
                <a href="controlador.php?accion=comenzarPartida"><button>Reiniciar</button></a>
                <a href="controlador.php?accion=salir"><button>abandonar</button></a>
            </div>
        ';

        if(!isset($_SESSION["win"]) && !isset($_SESSION["lose"]) ) {
            echo '
            <div class="flex">
                <div>
                    <a href="controlador.php?accion=sacarCarta"><img src="./img/cartas/dorso-rojo.svg" alt="Sacar carta" class="carta"></a>
                </div>
            ';

            
        } else {
            echo '
            <div class="flex">
                <div>
                    <img src="./img/cartas/dorso-rojo.svg" alt="Sacar carta" class="carta">
                </div>
            ';

            if(isset($_SESSION["win"])) {
                echo '
                <div class="winlose victoria">
                    <h3 class="margin0">¡Victoria!</h3>
                ';
            } elseif(isset($_SESSION["lose"])) {
                echo '
                <div class="winlose derrota">
                    <h3 class="margin0">Derrota</h3>
                ';
            }

            echo '
                </div>
            ';
        }


        foreach($_SESSION["mano"] as $carta) {
            echo '
            <div>
                <img src="'.$carta["card"].'" alt="carta" class="carta">
            </div>
        ';
        }


        echo '
        </div>
        ';


        
    }

?>
    </main>
</body>
</html>