<?php

session_start(['name' => 'SBP']);

if($peticionAjax){
    require_once "../modelos/githubModelo.php";
}else{
    require_once "./modelos/githubModelo.php";
}

class githubControlador extends githubModelo{

    public function enviar_comentario_controlador(){

        if(isset($_POST['comentario-packapps'])){
            $comentario = "About PackApps: " . mainModel::limpiar_cadena($_POST['comentario-packapps']);
        }else if(isset($_POST['comentario-bookverse'])){
            $comentario = "About Bookverse: " . mainModel::limpiar_cadena($_POST['comentario-bookverse']);
        }

        $fecha = date("M") . " " . date("d") . ", " . date("Y"). " - " . date("H:i");
        $usuario = $_SESSION['nombre_sbp'] . " " . $_SESSION['apellido_sbp'];

         $data = [
            "Usuario" => $usuario,
            "Comentario" => $comentario,
            "Fecha" => $fecha
        ];

        $guardarComentario = githubModelo::enviar_comentario_modelo($data);

        if($guardarComentario->rowCount() == 1){

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "¡Comentario enviado!",
                "Texto" => "El comentario ha sido enviado exitosamente.",
                "Tipo" => "success"
            ];

            self::enviar_correo("Feedback",$comentario, $usuario);

        }else{

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos podido enviar el comentario, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }

        return mainModel::sweet_alert($alerta);
    }
}