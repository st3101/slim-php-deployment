<?php

switch($_SERVER['REQUEST_METHOD'])
{  
    case "GET":
        switch (key($_GET)) 
        {
            case 'a':
                include "";
                break;
            case 'b':
                include "";
                break;
            case 'c':
                include "";
                break;    
        }
        break;

    case "POST";
        switch(key($_POST))
        {
            case 'HeladeriaAlta':
                include "HeladeriaAlta.php";
                break;

            case 'HeladoConsultar':
                include "HeladoConsultar.php";
                break;

            case 'AltaVenta':
                include "AltaVenta.php";
                break; 
        }
        break;
}

?>