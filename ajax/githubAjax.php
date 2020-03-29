<?php

$peticionAjax = true;

require_once "../core/configGeneral.php";

if (isset($_POST['comentario-packapps']) || isset($_POST['comentario-bookverse'])) {

    require_once "../controladores/githubControlador.php";

    $insGithub = new githubControlador();
    echo $insGithub->enviar_comentario_controlador();

} else {
    session_start(['name' => 'SBP']);
    session_destroy();

    echo '<script> window.location.href="' . SERVERURL . 'login/" </script>';
}