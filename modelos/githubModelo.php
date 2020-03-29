<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class githubModelo extends mainModel{

        protected function enviar_comentario_modelo($datos){

            $sql = mainModel::conectar()->prepare(
            "INSERT INTO feedback(Username,Message,Date)
            VALUES(:Usuario, :Comentario, :Fecha)");

            $sql->bindParam(":Usuario", $datos['Usuario']);
            $sql->bindParam(":Comentario", $datos['Comentario']);
            $sql->bindParam(":Fecha", $datos['Fecha']);
            $sql->execute();

            return $sql;
        }
    }
