<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-wrench zmdi-hc-fw"></i> Ajustes <small>LIBRO</small></h1>
    </div>
</div>

<?php 
    require_once "./controladores/categoriaControlador.php"; 
    $insCat = new categoriaControlador();    

    require_once "./controladores/libroControlador.php"; 
    $insLibro = new libroControlador();    

    $datos = explode("/", $_GET['views']);

    $libro = $insLibro->datos_libro_controlador("Unico", $datos[1]);
    $libro = $libro->fetch();
?>

<!-- Tabla de adjuntos -->
<div class="container-fluid">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-attachment-alt"></i> &nbsp; GESTIONAR ADJUNTOS</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php echo $libro['LibroImagen']; ?></td>
                            <td class="text-center">Imagen</td>
                            <td>
                                <form action="">
                                    <input type="hidden" name="adjunto-tipo" value="">
                                    <input type="hidden" name="adjunto-nombre" value="">
                                    <p class="text-center">
                                        <button class="btn btn-raised btn-danger btn-xs"><i class="zmdi zmdi-delete"></i></button>
                                    </p>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><?php echo $libro['LibroPDF']; ?></td>
                            <td class="text-center">PDF</td>
                            <td>
                                <form action="">
                                    <input type="hidden" name="adjunto-tipo" value="">
                                    <input type="hidden" name="adjunto-nombre" value="">
                                    <p class="text-center">
                                        <button class="btn btn-raised btn-danger btn-xs"><i class="zmdi zmdi-delete"></i></button>
                                    </p>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Panel actualizar libro -->
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; ACTUALIZAR LIBRO</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/libroAjax.php" method="POST" data-form="update" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Código de libro *</label>
                                    <input pattern="[a-zA-Z0-9-]{1,30}" class="form-control" value="<?php echo $libro['LibroCodigo']; ?>" type="text" name="codigo-up" readonly="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Título *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" value="<?php echo $libro['LibroTitulo']; ?>"  type="text" name="titulo-up" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Autor *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" value="<?php echo $libro['LibroAutor']; ?>" type="text" name="autor-up" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">País</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" value="<?php echo $libro['LibroPais']; ?>"  type="text" name="pais-up" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Año</label>
                                    <input pattern="[0-9]{1,4}" class="form-control" value="<?php echo $libro['LibroYear']; ?>" type="text" name="year-up" maxlength="4">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Editorial</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" value="<?php echo $libro['LibroEditorial']; ?>" type="text" name="editorial-up" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Edición</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" value="<?php echo $libro['LibroEdicion']; ?>" type="text" name="edicion-up" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Categoría</label>
                                    <select name="categoria-up" class="form-control">
                                        <?php 
                                        $data = $insCat->datos_categoria_controlador();

                                        foreach ($data as $categoria){
                                            
                                            if($libro['CategoriaCodigo'] != $categoria['CategoriaCodigo']){ ?>
                                                <option value="<?php echo $categoria['CategoriaCodigo']; ?>"><?php echo $categoria['CategoriaNombre']; ?></option>
                <?php                  }else{ ?>
                                                <option value="<?php echo $categoria['CategoriaCodigo']; ?>" selected><?php echo $categoria['CategoriaNombre']; ?></option>
                <?php                  }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group label-floating">
                                <label class="control-label">Introducción</label>
                                <textarea name="resumen-up" class="form-control" rows="3"><?php echo $libro['LibroResumen']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>      
                <br>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <label class="control-label">¿El archivo PDF será descargable para los clientes?</label>
                        <div class="radio radio-primary">
                            <label>
                                <input type="radio" name="optionsPDF" id="optionsRadios1" value="Yes" checked="">
                                <i class="zmdi zmdi-cloud-download"></i> &nbsp; Sí, PDF descargable
                            </label>
                        </div>
                        <div class="radio radio-primary">
                            <label>
                                <input type="radio" name="optionsPDF" id="optionsRadios2" value="No">
                                <i class="zmdi zmdi-cloud-off"></i> &nbsp; No, PDF no descargable
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <p class="text-center" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar</button>
                    </p>
                </div>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>

<!-- Panel eliminar libro -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="zmdi zmdi-delete"></i> &nbsp; ELIMINAR LIBRO</h3>
                </div>
                <div class="panel-body">
                    <p class="lead">
                        Eliminar <strong>todo</strong> contenido del libro en el sistema
                    </p>
                    <form>
                        <input type="hidden" value="">
                        <p class="text-center">
                            <button class="btn btn-raised btn-danger">
                                <i class="zmdi zmdi-delete"></i> &nbsp; ELIMINAR DEL SISTEMA
                            </button>	
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>