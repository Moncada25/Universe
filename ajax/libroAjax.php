<?php

    $peticionAjax = true;

    require_once "../core/configGeneral.php";

    if(isset($_POST['codigo-reg']) || isset($_POST['codigo-del']) || isset($_POST['codigo-up'])){
        
        require_once "../controladores/libroControlador.php";

        $insLibro = new libroControlador();

        if(isset($_POST['codigo-reg']) && isset($_POST['titulo-reg']) && isset($_POST['autor-reg'])){
            echo $insLibro->agregar_libro_controlador();
        }

        if(isset($_POST['codigo-up']) && isset($_POST['titulo-up']) && isset($_POST['autor-up'])){
            echo $insLibro->actualizar_libro_controlador();
        }

        // if(isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])){
        //     echo $insClient->eliminar_cliente_controlador();
        // }

    }else{
        session_start(['name' => 'SBP']);
        session_destroy();

        echo '<script> window.location.href="'.SERVERURL.'login/" </script>';
    }