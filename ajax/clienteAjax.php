<?php

    $peticionAjax = true;

    require_once "../core/configGeneral.php";

    if(isset($_POST['nombre-reg']) || isset($_POST['codigo-del']) || isset($_POST['cuenta-up'])){
        
        require_once "../controladores/clienteControlador.php";

        $insClient = new clienteControlador();

        if(isset($_POST['nombre-reg']) && isset($_POST['apellido-reg'])){
            echo $insClient->agregar_cliente_controlador();
        }

        if(isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])){
            echo $insClient->eliminar_cliente_controlador();
        }

        if(isset($_POST['cuenta-up']) && isset($_POST['nombre-up'])){
            echo $insClient->actualizar_cliente_controlador();
        }

    }else{
        session_start(['name' => 'SBP']);
        session_destroy();

        echo '<script> window.location.href="'.SERVERURL.'login/" </script>';
    }