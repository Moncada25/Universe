<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";

if (isset($_POST['tarea']) || isset($_POST['puntos'])) {

    require_once "../controladores/backlogControlador.php";

    $insBacklog = new backlogControlador();

    if (isset($_POST['tarea']) && isset($_POST['puntos']) && isset($_POST['descripcion'])) {
        echo $insBacklog->agregar_tarea_controlador();
    }

} else {
    session_start(['name' => 'SBP']);
    session_destroy();

    echo '<script> window.location.href="' . SERVERURL . 'login/" </script>';
}