<?php

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class clienteModelo extends mainModel{

        protected function agreagar_cliente_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO
            cliente(ClienteNombre, ClienteApellido, ClienteTelefono, ClienteOcupacion, ClienteDireccion, CuentaCodigo)
            VALUES(:Nombre, :Apellido, :Telefono, :Ocupacion, :Direccion, :Codigo)");

            $sql->bindParam(":Nombre", $datos['Nombre']);
            $sql->bindParam(":Apellido", $datos['Apellido']);
            $sql->bindParam(":Telefono", $datos['Telefono']);
            $sql->bindParam(":Ocupacion", $datos['Ocupacion']);
            $sql->bindParam(":Direccion", $datos['Direccion']);
            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->execute();

            return $sql;
        }

        protected function eliminar_cliente_modelo($codigo){

            $query = mainModel::conectar()->prepare("DELETE FROM cliente WHERE CuentaCodigo = :Codigo");
            $query->bindParam(":Codigo", $codigo);
            $query->execute();

            return $query;
        }

        protected function datos_cliente_modelo($tipo, $codigo){

            if($tipo == "Unico"){
                $query = mainModel::conectar()->prepare("SELECT * FROM cliente WHERE CuentaCodigo = :Codigo");
                $query->bindParam(":Codigo", $codigo);
            }elseif($tipo == "Conteo"){
                $query = mainModel::conectar()->prepare("SELECT id FROM cliente");
            }

            $query->execute();

            return $query;
        }

        protected function actualizar_cliente_modelo($datos){

            $query = mainModel::conectar()->prepare("UPDATE cliente
            SET ClienteNombre = :Nombre, ClienteApellido = :Apellido, ClienteTelefono = :Telefono, ClienteDireccion = :Direccion
            WHERE CuentaCodigo = :Codigo");

            $query->bindParam(":Nombre", $datos['Nombre']);
            $query->bindParam(":Apellido", $datos['Apellido']);
            $query->bindParam(":Telefono", $datos['Telefono']);
            $query->bindParam(":Direccion", $datos['Direccion']);
            $query->bindParam(":Codigo", $datos['Codigo']);

            $query->execute();

            return $query;
        }
    }