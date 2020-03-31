<br>
<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo SERVERURL?>category/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVA CATEGORÍA
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL?>categorylist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CATEGORÍAS
            </a>
        </li>
    </ul>
</div>

<?php
    require_once "./controladores/categoriaControlador.php";
    $insCat = new categoriaControlador();
?>

<!-- Panel listado de categorias -->
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE CATEGORÍAS</h3>
        </div>
        <div class="panel-body">
            <?php
                $pagina = explode("/", $_GET['views']);
                echo $insCat->paginador_categoria_controlador($pagina[1], 10, $_SESSION['privilegio_sbp'], "");
            ?>
        </div>
    </div>
</div>