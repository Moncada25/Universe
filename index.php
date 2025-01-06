<?php

    require_once $SERVERURL . "core/configGeneral.php";
    require_once $SERVERURL . "controladores/vistasControlador.php";

    $plantilla = new vistasControlador();
    $plantilla->obtener_plantilla_controlador();