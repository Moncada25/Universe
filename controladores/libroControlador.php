<?php

    if($peticionAjax){
        require_once "../modelos/libroModelo.php";
    }else{
        require_once "./modelos/libroModelo.php";
    }

    class libroControlador extends libroModelo{

        public function agregar_libro_controlador(){

            $codigo = mainModel::limpiar_cadena($_POST['codigo-reg']);
            $titulo = mainModel::limpiar_cadena($_POST['titulo-reg']);
            $autor = mainModel::limpiar_cadena($_POST['autor-reg']);
            $pais = mainModel::limpiar_cadena($_POST['pais-reg']);
            $year = mainModel::limpiar_cadena($_POST['year-reg']);
            $editorial = mainModel::limpiar_cadena($_POST['editorial-reg']);
            $edicion = mainModel::limpiar_cadena($_POST['edicion-reg']);
            $categoria = mainModel::limpiar_cadena($_POST['categoria-reg']);
            $resumen = mainModel::limpiar_cadena($_POST['resumen-reg']);
            $descarga = mainModel::limpiar_cadena($_POST['optionsPDF']);

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT LibroCodigo FROM libro WHERE LibroCodigo = '$codigo' ");

            if($consulta1->rowCount() >= 1){

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El código del libro introducido ya está registrado en el sistema, por favor intente nuevamente.",
                    "Tipo" => "error"
                ];

            }else{

                $folderPDF = "../files/books/";
                $folderIMG = "../files/images/";
                //datos de la imagen
                $nombre_imagen = $_FILES['imagen-reg']['name'];
                $tamano_imagen = $_FILES['imagen-reg']['size'];

                 //datos del PDF
                 $nombre_pdf = $_FILES['pdf-reg']['name'];
                 $tamano_pdf = $_FILES['pdf-reg']['size'];

                if((substr($nombre_imagen,-4) == "jpeg" || substr($nombre_imagen,-3) == "jpg" || substr($nombre_imagen,-3) == "png") && $tamano_imagen < 5000000){

                    if(substr($nombre_pdf,-3) == "pdf" && $tamano_pdf < 5000000){

                        $dataL = [
                            "Codigo" => $codigo,
                            "Titulo" => $titulo,
                            "Autor" => $autor,
                            "Pais" => $pais,
                            "Year" => $year,
                            "Editorial" => $editorial,
                            "Edicion" => $edicion,
                            "Resumen" => $resumen,
                            "Imagen" => $nombre_imagen,
                            "PDF" => $nombre_pdf,
                            "Descarga" => $descarga,
                            "Categoria" => $categoria
                        ];

                        $guardarLibro = libroModelo::agregar_libro_modelo($dataL);

                        if (move_uploaded_file($_FILES['imagen-reg']['tmp_name'], $folderIMG . $nombre_imagen) && move_uploaded_file($_FILES['pdf-reg']['tmp_name'], $folderPDF . $nombre_pdf) && $guardarLibro->rowCount() >=1){

                            $alerta = [
                                "Alerta" => "recargar",
                                "Titulo" => "¡Libro guardado!",
                                "Texto" => "El libro fue registrado exitosamente.",
                                "Tipo" => "success"
                            ];

                        }else{
                            $alerta = [
                                "Alerta" => "simple",
                                "Titulo" => "Ocurrió un error inesperado",
                                "Texto" => "Los archivos no pudieron guardarse, por favor intente nuevamente.",
                                "Tipo" => "error"
                            ];
                        }

                    }else{
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "PDF inválido",
                            "Texto" => "El tamaño o el formato del PDF introducido no coincide con el indicado, por favor intente nuevamente.",
                            "Tipo" => "error"
                        ];
                    }

                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Imagen inválida",
                        "Texto" => "El tamaño o el formato de la imagen introducida no coincide con el indicado, por favor intente nuevamente.",
                        "Tipo" => "error"
                    ];
                }
            }

            return mainModel::sweet_alert($alerta);
        }

        public function paginador_libro_controlador($pagina, $registros, $busqueda, $privilegio, $categoria,$nombre){

            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $busqueda = mainModel::limpiar_cadena($busqueda);
            $categoria = mainModel::limpiar_cadena($categoria);

            $tabla = "";

            $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

            if(isset($busqueda) && $busqueda != ""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM libro
                WHERE  (LibroTitulo LIKE '%$busqueda%' OR LibroAutor LIKE '%$busqueda%')
                ORDER BY LibroTitulo ASC LIMIT $inicio, $registros";

                $paginaurl = "search";
            }elseif(isset($categoria) && $categoria != ""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM libro
                WHERE CategoriaCodigo = '$categoria'
                ORDER BY LibroTitulo ASC LIMIT $inicio, $registros";

                $paginaurl = "catalog/".$nombre;
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM libro
                ORDER BY LibroTitulo ASC LIMIT $inicio, $registros";

                $paginaurl = "catalog/all";
            }

            $conexion = mainModel::conectar();

            $datos = $conexion->query($consulta);

            $datos = $datos->fetchAll();

            $total = $conexion->query("SELECT FOUND_ROWS()");
            $total = (int) $total->fetchColumn();

            $Npaginas = ceil($total/$registros);

            $tabla .= '
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">TÍTULO</th>
                            <th class="text-center">AUTOR</th>
                            <th class="text-center">INFORMACIÓN</th>
                            <th class="text-center">LEER</th>';

                            if($privilegio == 1){
                                $tabla .= '<th class="text-center">AJUSTES</th>';
                            }

            $tabla .= '</tr>
                    </thead>
                    <tbody>'
                ;

                if($total >= 1 && $pagina <= $Npaginas){
                    $contador = $inicio + 1;

                    foreach($datos as $rows){
                        $tabla .= '
                        <tr>
                            <td>'.$contador.'</td>
                            <td>'.$rows['LibroTitulo'].'</td>
                            <td>'.$rows['LibroAutor'].'</td>
                            <td>
                                <a href='.SERVERURL.'bookinfo/'. mainModel::encryption($rows["LibroCodigo"]).' data-title="Más información"><i class="zmdi zmdi-info zmdi-hc-2x"></i></a>
                            </td>
                            <td>
                                <a value="'.$rows['LibroTitulo'].'" class="view-pdf" href="'.SERVERURL.'files/books/'.$rows['LibroPDF'].'" data-title="Abrir PDF"><i class="zmdi zmdi-file zmdi-hc-2x"></i></a>
                            </td>';

                            if($privilegio == 1){
                                $tabla .= '
                            <td>
                                <a href='.SERVERURL.'bookconfig/'. mainModel::encryption($rows["LibroCodigo"]).' data-title="Ajustes"><i class="zmdi zmdi-wrench zmdi-hc-2x"></i></a>
                            </td>';
                            }

                        $tabla .= '</tr>';
                        $contador++;
                    }

                }else{

                    if($total >= 1){
                        $tabla .= '
                            <tr>
                                <td colspan="7">
                                    <a href="' . SERVERURL . $paginaurl .'/" class="btn btn-sm btn-info btn-raised">
                                        Haga clic aquí para recargar el listado
                                    </a>
                                </td>
                            </tr>
                        ';
                    }else{
                        $tabla .= '
                            <tr>
                                <td colspan="8"> No hay registros en el sistema. </td>
                            </tr>
                        ';
                    }
                }

            $tabla .= '</tbody></table></div>';

            if($total >= 1 && $pagina <= $Npaginas){
                $tabla .= '
                    <nav class="text-center">
                    <ul class="pagination pagination-sm">'
                ;

                if($pagina == 1){
                    $tabla .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
                }else{
                    $tabla .= '<li><a href="'.SERVERURL.$paginaurl.'/'.($pagina - 1).'/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
                }

                for ($i=1; $i <= $Npaginas; $i++) {

                    if($pagina == $i){
                        $tabla .= '<li class="active"><a href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
                    }else{
                        $tabla .= '<li><a href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
                    }
                }

                if($pagina == $Npaginas){
                    $tabla .= '<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
                }else{
                    $tabla .= '<li><a href="'.SERVERURL.$paginaurl.'/'.($pagina + 1).'/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
                }

                $tabla .= '</ul></nav>';
            }

            return $tabla;
        }

        public function datos_libro_controlador($tipo, $codigo){
            $codigo = mainModel::decryption($codigo);
            $codigo = mainModel::limpiar_cadena($codigo);
            $tipo = mainModel::limpiar_cadena($tipo);
            return libroModelo::datos_libro_modelo($tipo, $codigo);
        }

        public function actualizar_libro_controlador(){

            $codigo = mainModel::limpiar_cadena($_POST['codigo-up']);
            $titulo = mainModel::limpiar_cadena($_POST['titulo-up']);
            $autor = mainModel::limpiar_cadena($_POST['autor-up']);
            $pais = mainModel::limpiar_cadena($_POST['pais-up']);
            $year = mainModel::limpiar_cadena($_POST['year-up']);
            $editorial = mainModel::limpiar_cadena($_POST['editorial-up']);
            $edicion = mainModel::limpiar_cadena($_POST['edicion-up']);
            $categoria = mainModel::limpiar_cadena($_POST['categoria-up']);
            $resumen = mainModel::limpiar_cadena($_POST['resumen-up']);
            $descarga = mainModel::limpiar_cadena($_POST['optionsPDF']);

            $datosLibro = [
                "Titulo" => $titulo,
                "Autor" => $autor,
                "Pais" => $pais,
                "Year" => $year,
                "Editorial" => $editorial,
                "Edicion" => $edicion,
                "Resumen" => $resumen,
                "Descarga" => $descarga,
                "Categoria" => $categoria,
                "Codigo" => $codigo
            ];

            if(libroModelo::actualizar_libro_modelo($datosLibro)){

                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "¡Datos actualizados!",
                    "Texto" => "El libro ha sido actualizado exitosamente.",
                    "Tipo" => "success"
                ];

            }else{

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No hemos podido actualizar los datos del libro, por favor intenta nuevamente.",
                    "Tipo" => "error"
                ];
            }

            return mainModel::sweet_alert($alerta);
        }
    }