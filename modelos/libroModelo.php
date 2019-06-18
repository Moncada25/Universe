<?php 

    if($peticionAjax){
        require_once "../core/mainModel.php";
    }else{
        require_once "./core/mainModel.php";
    }

    class libroModelo extends mainModel{

        protected function agregar_libro_modelo($datos){

            $sql = mainModel::conectar()->prepare("INSERT INTO 
            libro(LibroCodigo, LibroTitulo, LibroAutor, LibroPais, LibroYear, LibroEditorial, LibroEdicion, LibroResumen, LibroImagen, LibroPDF, LibroDescarga, CategoriaCodigo) 
            VALUES(:Codigo, :Titulo, :Autor, :Pais, :Year, :Editorial, :Edicion, :Resumen, :Imagen, :PDF, :Descarga, :Categoria)");

            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->bindParam(":Titulo", $datos['Titulo']);
            $sql->bindParam(":Autor", $datos['Autor']);
            $sql->bindParam(":Pais", $datos['Pais']);
            $sql->bindParam(":Year", $datos['Year']);
            $sql->bindParam(":Editorial", $datos['Editorial']);
            $sql->bindParam(":Edicion", $datos['Edicion']);
            $sql->bindParam(":Resumen", $datos['Resumen']);
            $sql->bindParam(":Imagen", $datos['Imagen']);
            $sql->bindParam(":PDF", $datos['PDF']);
            $sql->bindParam(":Descarga", $datos['Descarga']);
            $sql->bindParam(":Categoria", $datos['Categoria']);
            $sql->execute();

            return $sql;
        }

        protected function datos_libro_modelo($tipo, $codigo){

            if($tipo == "Unico"){
                $query = mainModel::conectar()->prepare("SELECT * FROM libro WHERE LibroCodigo = :Codigo");
                $query->bindParam(":Codigo", $codigo);
            }elseif($tipo == "Conteo"){
                $query = mainModel::conectar()->prepare("SELECT id FROM libro");
            }

            $query->execute();

            return $query;

            $query = mainModel::conectar()->prepare("SELECT * FROM libro WHERE LibroCodigo = :Codigo");
            $query->bindParam(":Codigo", $codigo);

            $query->execute();

            return $query;
        }

        protected function actualizar_libro_modelo($datos){

            $consulta = mainModel::conectar()->prepare(
            "UPDATE `libro` 
            SET `LibroTitulo` = :Titulo, `LibroAutor` = :Autor, `LibroPais` = :Pais, `LibroYear` = :Year, `LibroEditorial` = :Editorial, `LibroEdicion` = :Edicion, `LibroResumen` = :Resumen, `LibroDescarga` = :Descarga, `CategoriaCodigo` = :Categoria 
            WHERE `libro`.`LibroCodigo` = :Codigo");
            
            $consulta->bindParam(":Titulo", $datos['Titulo']);
            $consulta->bindParam(":Autor", $datos['Autor']);
            $consulta->bindParam(":Pais", $datos['Pais']);
            $consulta->bindParam(":Year", $datos['Year']);
            $consulta->bindParam(":Editorial", $datos['Editorial']);
            $consulta->bindParam(":Edicion", $datos['Edicion']);
            $consulta->bindParam(":Resumen", $datos['Resumen']);
            $consulta->bindParam(":Descarga", $datos['Descarga']);
            $consulta->bindParam(":Categoria", $datos['Categoria']);
            $consulta->bindParam(":Codigo", $datos['Codigo']);

            $consulta->execute();

            return $consulta;
        }
    }