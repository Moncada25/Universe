<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class backlogModelo extends mainModel{

        protected function agregar_tarea_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO
            task(UserAssigned, Task, Description, Points, Status, Date, AccountCode)
            VALUES(:Usuario, :Tarea, :Descripcion, :Puntos, :Estado, :Fecha, :Cuenta)");

            $sql->bindParam(":Usuario", $datos['Usuario']);
            $sql->bindParam(":Tarea", $datos['Tarea']);
            $sql->bindParam(":Descripcion", $datos['Descripcion']);
            $sql->bindParam(":Puntos", $datos['Puntos']);
            $sql->bindParam(":Estado", $datos['Estado']);
            $sql->bindParam(":Fecha", $datos['Fecha']);
            $sql->bindParam(":Cuenta", $datos['Cuenta']);
            $sql->execute();

            return $sql;
        }
    }