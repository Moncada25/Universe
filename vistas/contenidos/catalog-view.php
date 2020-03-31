<?php
    require_once "./controladores/categoriaControlador.php";
    $insCat = new categoriaControlador();

    $cats = [];
    $datos=explode("/", $_GET['views']);
?>

<br>
<div class="container-fluid text-center">
    <div class="btn-group">
        <a href="<?php echo SERVERURL.'catalog/all/';?>" class="btn btn-link btn-raised">SELECCIONE UNA CATEGORÍA</a>
        <a data-target="dropdown-menu" class="btn btn-link btn-raised dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
        <ul class="dropdown-menu drop" style="border-radius: 15px;">
        <li><a href="<?php echo SERVERURL.'catalog/all/';?>">Todas</a></li>

        <?php
            $data = $insCat->datos_categoria_controlador();
            foreach ($data as $categoria){
                $format = strtolower(mainModel::eliminar_acentos($categoria['CategoriaNombre']));
                $cats[$format] = $categoria['CategoriaCodigo'];
                ?>
                <li>
                    <a href="<?php echo SERVERURL.'catalog/'.$format."/"?>">
                        <?php echo $categoria['CategoriaNombre']; ?>
                    </a>
                </li>
<?php  }
            ?>
        </ul>
    </div>
</div>

<?php

if($datos[1] == "all"){ ?>

    <h2 class="text-titles text-center">Categoría seleccionada <strong>"Todas"</strong></h2>
    <div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title text-center">LIBROS DISPONIBLES</h3>
        </div>
        <div class="panel-body">
            <?php
                require_once "./controladores/libroControlador.php";
                $insLibro = new libroControlador();
                echo $insLibro->paginador_libro_controlador($datos[2], 10, "", $_SESSION['privilegio_sbp'], "", "");
            ?>
        </div>
    </div>

<?php  }elseif($datos[1] == "ciencia" || $datos[1] == "programacion"){

        if($datos[1] == "programacion"){
            $nombre = "Programación";
        }else if($datos[1] == "ciencia"){
            $nombre = "Ciencia";
        } ?>

    <h2 class="text-titles text-center">Categoría seleccionada <strong>"<?php  echo $nombre?>"</strong></h2>
    <div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-book"></i> &nbsp; LISTADO DE LIBROS</h3>
        </div>
        <div class="panel-body">
            <?php
                require_once "./controladores/libroControlador.php";
                $insLibro = new libroControlador();
                echo $insLibro->paginador_libro_controlador($datos[2], 10, "", $_SESSION['privilegio_sbp'], $cats[$datos[1]], $datos[1]);
            ?>
        </div>
    </div>

<?php
            }else{ ?>

                <div class="alert alert-dismissible alert-warning text-center">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="zmdi zmdi-alert-triangle zmdi-hc-5x"></i>
                    <h4>¡Lo sentimos!</h4>
                    <p>La categoría seleccionada no es válida</p>
                </div>

<?php  }
        ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.view-pdf').on('click', function() {
            var pdf_link = $(this).attr('href');
            var iframe = '<div class="iframe-container"><iframe src="' + pdf_link + '"></iframe></div>'
            var titlulo = $(this).attr('value');
            $.createModal({
                title: titlulo,
                message: iframe,
                closeButton: true,
                scrollable: false
            });
            return false;
        });
    });
</script>