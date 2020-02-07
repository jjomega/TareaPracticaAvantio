<?php

   //Cargamos la configuración, el controlador y el modelo.
   require_once __DIR__.'/../app/Config.php';
   require_once __DIR__.'/../app/ModelFeed.php';
   require_once __DIR__.'/../app/ControllerFeed.php';


   /*
   Array asociativo que nos servirá para enrutar y asociar
   cada vista con el controlador, y su función correspondiente.
   */
    $mapa=[
        'inicio' => ['controller' =>'ControllerFeed', 'action' =>'inicio']
    ];


    //Comprobación de la ruta
    if(isset($_GET['ctl'])){
        if(isset($mapa[$_GET['ctl']])){
            $ruta=$_GET['ctl'];
        }
        else{
            header('Status: 404 Not Found');
            echo "<html><body>Error 404: No existe la ruta {$_GET['ctl']}.</body></html>";
            exit;
        }

    }
    else {
        //Ruta por defecto
        $ruta='inicio';
    }

    $controlador=$mapa[$ruta];

    if(method_exists($controlador['controller'], $controlador['action'])){
        call_user_func([new $controlador['controller'], $controlador['action']]);
    }
    else {
        header('Status: 404 Not Found');
        echo "<html><body>Error 404: Jorge, el controlador {$controlador['controller']}->{$controlador['action']} no existe. Revisalo.</body></html>";
    }
   

?>
