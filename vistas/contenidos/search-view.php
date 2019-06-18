<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-search zmdi-hc-fw"></i> Búsqueda <small>LIBRO</small></h1>
    </div>
</div>

<?php 
    if(!isset($_SESSION['busqueda_libro']) && empty(isset($_SESSION['busqueda_libro']))):
?>

<div class="container-fluid">
    <form class="well FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <div class="form-group label-floating">
                    <span class="control-label">¿Qué libro estás buscando?</span>
                    <input class="form-control" type="text" name="busqueda_inicial_libro" required="">
                </div>
            </div>
            <div class="col-xs-12">
                <p class="text-center">
                    <button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
                </p>
            </div>
        </div>
        <div class="RespuestaAjax"></div>
    </form>
</div>
<?php else: ?>
<div class="container-fluid">
    <form class="well FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off" enctype="multipart/form-data">
        <p class="lead text-center">Su última búsqueda  fue <strong>“<?php echo $_SESSION['busqueda_libro'];?>”</strong></p>
        <div class="row">
            <input class="form-control" type="hidden" name="eliminar_busqueda_libro" value="destruir">
            <div class="col-xs-12">
                <p class="text-center">
                    <button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
                </p>
            </div>
        </div>
        <div class="RespuestaAjax"></div>
    </form>
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR LIBRO</h3>
        </div>
        <div class="panel-body">
            <?php 
                require_once "./controladores/libroControlador.php";
                $insLibro = new libroControlador();
                $pagina = explode("/", $_GET['views']);
                echo $insLibro->paginador_libro_controlador($pagina[1], 10, $_SESSION['busqueda_libro'], $_SESSION['privilegio_sbp'], "", "");
            ?>
        </div>
    </div>
</div>
<?php endif;?>

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
})
</script>