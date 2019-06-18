<?php 

    if($peticionAjax){
        require_once "../modelos/categoriaModelo.php";
    }else{
        require_once "./modelos/categoriaModelo.php";
    }

    class categoriaControlador extends categoriaModelo{

        public function agregar_categoria_controlador(){

            $codigo = mainModel::limpiar_cadena($_POST['codigo-cat']);
            $nombre = mainModel::limpiar_cadena($_POST['nombre-cat']);

            $consulta1 = mainModel::ejecutar_consulta_simple("SELECT CategoriaCodigo FROM categoria WHERE CategoriaCodigo = '$codigo' ");

            if($consulta1->rowCount() >= 1){

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El código de la categoría que acaba de ingresar ya se encuentra registrado, por favor verifique los datos e intente nuevamente.",
                    "Tipo" => "error"
                ];

            }else{

                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT CategoriaNombre FROM categoria WHERE CategoriaNombre = '$nombre' ");

                if($consulta2->rowCount() >= 1){

                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "El nombre de la categoría que acaba de ingresar ya se encuentra registrado, por favor verifique los datos e intente nuevamente.",
                        "Tipo" => "error"
                    ];

                }else{

                    $data = [
                        "Codigo" => $codigo,
                        "Nombre" => $nombre,
                    ];

                    $guardarCategoria = categoriaModelo::agregar_categoria_modelo($data);

                    if($guardarCategoria->rowCount() == 1){

                        $alerta = [
                            "Alerta" => "limpiar",
                            "Titulo" => "¡Categoría registrada!",
                            "Texto" => "La categoría ha sido registrada exitosamente.",
                            "Tipo" => "success"
                        ];

                    }else{

                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ocurrió un error inesperado",
                            "Texto" => "No hemos podido registrar la categoría, por favor intente nuevamente.",
                            "Tipo" => "error"
                        ];
                    }
                }
            }

            return mainModel::sweet_alert($alerta);
        }

        public function paginador_categoria_controlador($pagina, $registros, $privilegio, $busqueda){

            $pagina = mainModel::limpiar_cadena($pagina);
            $registros = mainModel::limpiar_cadena($registros);
            $privilegio = mainModel::limpiar_cadena($privilegio);
            $busqueda = mainModel::limpiar_cadena($busqueda);

            $tabla = "";

            $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

            if(isset($busqueda) && $busqueda != ""){
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM categoria 
                WHERE  (CategoriaNombre LIKE '%$busqueda%' OR CategoriaCodigo LIKE '%$busqueda%')
                ORDER BY CategoriaNombre ASC LIMIT $inicio, $registros";

                $paginaurl = "categorysearch";
            }else{
                $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM categoria 
                ORDER BY CategoriaNombre ASC LIMIT $inicio, $registros";
        
                $paginaurl = "categorylist";
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
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">NOMBRE</th>';
                        
                        if($privilegio == 1){
                            $tabla .= '<th class="text-center">ELIMINAR</th>';
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
                            <td>'.$rows['CategoriaCodigo'].'</td>
                            <td>'.$rows['CategoriaNombre'].'</td>';

                            if($privilegio == 1){
                                $tabla .= '
                                    <td>
                                        <form action="'.SERVERURL.'ajax/categoriaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" name="codigo-del" value="'.mainModel::encryption($rows['CategoriaCodigo']).'">
                                            <input type="hidden" name="privilegio-admin" value="'.mainModel::encryption($privilegio).'">

                                            <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>

                                            <div class="RespuestaAjax"></div>
                                        </form>
                                    </td>';
                            }

                        $tabla .= '</tr>';
                        $contador++;
                    }

                }else{

                    if($total >= 1){
                        $tabla .= '
                            <tr>
                                <td colspan="8">
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

        public function eliminar_categoria_controlador(){
            
            $codigo = mainModel::decryption($_POST['codigo-del']);
            $privilegio = mainModel::decryption($_POST['privilegio-admin']);

            $codigo = mainModel::limpiar_cadena($codigo);
            $privilegio = mainModel::limpiar_cadena($privilegio);

            if($privilegio == 1){

                $delCateg = categoriaModelo::eliminar_categoria_modelo($codigo);

                if($delCateg->rowCount() >= 1){

                    $alerta = [
                        "Alerta" => "recargar",
                        "Titulo" => "¡Categoría eliminada!",
                        "Texto" => "La categoría fue eliminada con éxito del sistema.",
                        "Tipo" => "success"
                    ];

                }else{
                    
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "No podemos eliminar esta categoría en este momento.",
                        "Tipo" => "error"
                    ];
                }

            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No tiene los permisos necesarios para eliminar esta categoría.",
                    "Tipo" => "error"
                ];
            }

            return mainModel::sweet_alert($alerta);
        }

        public function datos_categoria_controlador(){
            return categoriaModelo::datos_categoria_modelo();
        }
    }