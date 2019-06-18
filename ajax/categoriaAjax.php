<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";

if (isset($_POST['codigo-cat']) || isset($_POST['codigo-del'])) {

    require_once "../controladores/categoriaControlador.php";

    $insCateg = new categoriaControlador();

    if (isset($_POST['codigo-cat']) && isset($_POST['nombre-cat'])) {
        echo $insCateg->agregar_categoria_controlador();
    }
    
    if(isset($_POST['codigo-del']) && isset($_POST['privilegio-admin'])){
        echo $insCateg->eliminar_categoria_controlador();
    }

} else {
    session_start(['name' => 'SBP']);
    session_destroy();

    echo '<script> window.location.href="' . SERVERURL . 'login/" </script>';
}
