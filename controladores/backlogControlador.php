<?php

if($peticionAjax){
    require_once "../modelos/backlogModelo.php";
}else{
    require_once "./modelos/backlogModelo.php";
}

class backlogControlador extends backlogModelo{

    public function agregar_tarea_controlador(){

        session_start(['name' => 'SBP']);

        $tarea = mainModel::limpiar_cadena($_POST['tarea']);
        $puntos = mainModel::limpiar_cadena($_POST['puntos']);
        $descricion = mainModel::limpiar_cadena($_POST['descripcion']);
        $estado = mainModel::limpiar_cadena($_POST['estado']);
        $fecha = date("M") . " " . date("d") . ", " . date("Y"). " - " . date("H:i");
        $usuario = $_SESSION['nombre_sbp'] . " " . $_SESSION['apellido_sbp'] . " (" . $_SESSION['usuario_sbp'] . ")";
        $cuenta = $_SESSION['codigo_cuenta_sbp'];

        $data = [
            "Usuario" => $usuario,
            "Tarea" => $tarea,
            "Puntos" => $puntos,
            "Descripcion" => $descricion,
            "Estado" => $estado,
            "Fecha" => $fecha,
            "Cuenta" => $cuenta
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

    public function paginador_tareas_controlador($pagina, $registros, $codigo, $busqueda){

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $codigo = mainModel::limpiar_cadena($codigo);
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if(isset($busqueda) && $busqueda != "all"){
            $consulta = "SELECT SQL_CALC_FOUND_ROWS *
            FROM task
            WHERE AccountCode = '$codigo'
            ORDER BY Date ASC LIMIT $inicio, $registros";

            $paginaurl = "tasklist";
        }else{
            $consulta = "SELECT SQL_CALC_FOUND_ROWS *
            FROM task
            ORDER BY Date ASC LIMIT $inicio, $registros";

            $paginaurl = "backlog";
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
                        <tr>';

                        if($busqueda != ""){
                            $tabla .= '<th class="text-center">ASIGNACIÓN</th>';
                        }

                        $tabla .= '
                            <th class="text-center">TAREA</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">PUNTOS</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">FECHA</th>';
                            if($busqueda == ""){
                                $tabla .= '<th class="text-center">EDITAR</th>';
                            }
                        $tabla .= '
                        </tr>
                    </thead>
                <tbody>';

                if($total >= 1 && $pagina <= $Npaginas){
                    $contador = $inicio + 1;

                    foreach($datos as $rows){
                        $tabla .= '
                        <tr>';

                            if($busqueda != ""){
                                $tabla .= '<td>'.$rows['UserAssigned'].'</td>';
                            }

                            $tabla .= '
                                <td>'.$rows['Task'].'</td>
                                <td>'.$rows['Description'].'</td>
                                <td>'.$rows['Points'].'</td>
                                <td>'.$rows['Status'].'</td>
                                <td>'.$rows['Date'].'</td>';

                            if($busqueda == ""){
                                $tabla .= '
                                <td>
                                    <a href="'.SERVERURL.'editbacklog/'.mainModel::encryption($rows['ID']).'" class="btn btn-info btn-raised btn-xs">
                                        <i class="zmdi zmdi-refresh"></i>
                                    </a>
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

}