<?php
    session_start();

    if(isset($_GET["accion"])) {

        //accion Comenzar partida
        if(strcmp($_GET["accion"],"comenzarPartida") === 0) {
            //destruimos la sesion
            session_destroy();

            //creamos de nuevo la sesion
            session_start();

            //creamos y vaciamos la baraja y la mano por si existira una partida en curso reiniciarla
            $_SESSION["baraja"] = [];
            $_SESSION["mano"] = [];

            //inicializamos un array con las distintas letras de la baraja
            $letrasBaraja = ["c","d","p","t"];

            //recoremos todos los numeros de las cartas
            for($i = 1; $i <= 13; $i++) {

                //para cada numero recorremos el array letras
                for($j = 0; $j < count($letrasBaraja); $j++) {

                    //si no es i 8,9 o 10 metemos todas las cartas de ese valor en la sesion baraja
                    if($i !== 8 && $i !== 9 && $i !== 10) {
                        if($i <= 7 && $i !== 1) {
                            array_push($_SESSION["baraja"],["card" => "./img/cartas/".$letrasBaraja[$j].$i.".svg", "value"=> $i]);
                        } else {
                            array_push($_SESSION["baraja"],["card" => "./img/cartas/".$letrasBaraja[$j].$i.".svg", "value"=> 0.5]);
                        }
                    }
                }

                
            }

            //barajamos las cartas
            shuffle($_SESSION["baraja"]);

            //volvemos a index.php
            header("Location: ./index.php");
            die();
            
        }

        //accion Salir
        if(strcmp($_GET["accion"],"salir") === 0) {
            //destruimos la sesion
            session_destroy();

            //volvemos a index.php
            header("Location: ./index.php");
            die();

        }
        
        //accion sacar carta
        if(strcmp($_GET["accion"],"sacarCarta") === 0) {
            if(!isset($_SESSION["win"]) && !isset($_SESSION["lose"])) {
                if(count($_SESSION["baraja"]) > 0) {
                    array_push($_SESSION["mano"],array_shift($_SESSION["baraja"])); 
                }

                $puntuacion = 0;

                foreach($_SESSION["mano"] as $carta) {
                    $puntuacion += $carta["value"];
                }

                if($puntuacion === 7.5) {
                    $_SESSION["win"] = true;
                } elseif($puntuacion > 7.5) {
                    $_SESSION["lose"] = true;
                }

                //volvemos a index.php
                header("Location: ./index.php");
                die();
            } else {
                //volvemos a index.php
                header("Location: ./index.php");
                die();
            }
        }
    }
?>

