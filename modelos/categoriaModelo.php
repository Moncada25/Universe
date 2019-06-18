<?php 

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class categoriaModelo extends mainModel{

        protected function agregar_categoria_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO 
            categoria(CategoriaCodigo, CategoriaNombre) 
            VALUES(:Codigo, :Nombre)");

            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->bindParam(":Nombre", $datos['Nombre']);
            $sql->execute();

            return $sql;
        }

        protected function eliminar_categoria_modelo($codigo){

            $query = mainModel::conectar()->prepare("DELETE FROM categoria WHERE CategoriaCodigo = :Codigo");
        
            $query->bindParam(":Codigo", $codigo);
            $query->execute();

            return $query;
        }

        protected function datos_categoria_modelo(){

            $query = mainModel::conectar()->prepare("SELECT * FROM categoria");
            $query->execute();

            return $query;
        }
    }