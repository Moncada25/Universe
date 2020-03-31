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

        protected function actualizar_tarea_modelo($datos){

            $sql = mainModel::conectar()->prepare("UPDATE `task`
            SET `Task` = :Tarea, `Points` = :Puntos, `Description` = :Descripcion, `Status` = :Estado
            WHERE `task`.`ID` = :Codigo");

            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->bindParam(":Tarea", $datos['Tarea']);
            $sql->bindParam(":Descripcion", $datos['Descripcion']);
            $sql->bindParam(":Puntos", $datos['Puntos']);
            $sql->bindParam(":Estado", $datos['Estado']);
            $sql->execute();

            return $sql;
        }

        protected function datos_tarea_modelo($codigo){

            $query = mainModel::conectar()->prepare("SELECT * FROM task WHERE ID = :Codigo");
            $query->bindParam(":Codigo", $codigo);

            $query->execute();

            return $query;
        }
    }