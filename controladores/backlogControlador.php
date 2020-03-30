<?php

session_start(['name' => 'SBP']);

if($peticionAjax){
    require_once "../modelos/backlogModelo.php";
}else{
    require_once "./modelos/backlogModelo.php";
}

class backlogControlador extends backlogModelo{

    public function agregar_tarea_controlador(){

        $tarea = mainModel::limpiar_cadena($_POST['tarea']);
        $puntos = mainModel::limpiar_cadena($_POST['puntos']);
        $descricion = mainModel::limpiar_cadena($_POST['descripcion']);
        $estado = mainModel::limpiar_cadena($_POST['estado']);
        $fecha = date("M") . " " . date("d") . ", " . date("Y"). " - " . date("H:i");
        $usuario = $_SESSION['nombre_sbp'] . " " . $_SESSION['apellido_sbp'] . " (" . $_SESSION['usuario_sbp'] . ")";

        $data = [
            "Usuario" => $usuario,
            "Tarea" => $tarea,
            "Puntos" => $puntos,
            "Descripcion" => $descricion,
            "Estado" => $estado,
            "Fecha" => $fecha
        ];

        $guardarTarea = backlogModelo::agregar_tarea_modelo($data);

        if($guardarTarea->rowCount() == 1){

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "¡Tarea agregada!",
                "Texto" => "La tarea ha sido agregada exitosamente al backlog.",
                "Tipo" => "success"
            ];

        }else{

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido agregar la tarea, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
}