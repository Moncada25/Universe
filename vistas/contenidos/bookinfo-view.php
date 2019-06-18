<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Información <small>LIBRO</small></h1>
    </div>
</div>

<?php 
    require_once "./controladores/libroControlador.php"; 
    $insLibro = new libroControlador();    

    $datos = explode("/", $_GET['views']);

    $libro = $insLibro->datos_libro_controlador("Unico", $datos[1]);
    $libro = $libro->fetch();
?>

<!-- Panel info libro -->
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-info"></i> &nbsp; <?php echo $libro['LibroTitulo']; ?></h3>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group label-floating">
                                <span>Título</span>
                                <input class="form-control" value="<?php echo $libro['LibroTitulo']; ?>" readonly="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <img src="<?php echo SERVERURL.'adjuntos/images/'.$libro['LibroImagen']; ?>" alt="book" class="img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group label-floating">
                                            <span>Autor</span>
                                            <input class="form-control" value="<?php echo $libro['LibroAutor']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <span>País</span>
                                            <input class="form-control" value="<?php echo $libro['LibroPais']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <span>Año</span>
                                            <input class="form-control"value="<?php echo $libro['LibroYear']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <span>Editorial</span>
                                            <input class="form-control" value="<?php echo $libro['LibroEditorial']; ?>" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group label-floating">
                                            <span>Edición</span>
                                            <input class="form-control" value="<?php echo $libro['LibroEdicion']; ?>" readonly="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Introducción al libro</legend>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group label-floating">
                                <span>Introducción</span>
                                <textarea readonly="" class="form-control" rows="3"><?php echo $libro['LibroResumen']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend><i class="zmdi zmdi-download"></i> &nbsp; Descargar archivo PDF</legend>
                <p class="text-center">
                    <a href="<?php echo SERVERURL.'adjuntos/books/'. $libro["LibroPDF"]?>" download="<?php echo "Bookverse - ".$libro["LibroTitulo"]?>" class="btn btn-raised btn-primary">
                    <i class="zmdi zmdi-cloud-download"></i> &nbsp; DESCARGAR PDF
                    </a>
                </p>
            </fieldset>
        </div>
    </div>
</div>