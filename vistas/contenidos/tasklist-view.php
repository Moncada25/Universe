<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles text-center"><small>BACKLOG</small></h1>
    </div>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo SERVERURL; ?>task/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVA TAREA
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>tasklist/" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; MIS TAREAS
            </a>
        </li>
        <li>
            <a href="<?php echo SERVERURL; ?>backlog/" class="btn btn-warning">
                <i class="zmdi zmdi-search"></i> &nbsp; BACKLOG
            </a>
        </li>
    </ul>
</div>

<?php
    require_once "./controladores/backlogControlador.php";
    $insBacklog = new backlogControlador();
?>

<!-- Panel listado de tareas -->
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; MIS TAREAS</h3>
        </div>
        <div class="panel-body">
            <?php
                $pagina = explode("/", $_GET['views']);
                echo $insBacklog->paginador_tareas_controlador($pagina[1], 10, $_SESSION['codigo_cuenta_sbp'], "");
            ?>
        </div>
    </div>
</div>