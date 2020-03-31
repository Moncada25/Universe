<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles text-center"><small>AGREGAR LIBRO</small></h1>
    </div>
</div>

<?php
    require_once "./controladores/categoriaControlador.php";
    $insCat = new categoriaControlador();
?>

<!-- Panel nuevo libro -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO LIBRO</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/libroAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <legend><i class="zmdi zmdi-library"></i> &nbsp; Información básica</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Código de libro *</label>
                                    <input pattern="[a-zA-Z0-9-]{1,30}" class="form-control" type="text" name="codigo-reg" readonly="" value="<?php echo mainModel::generar_codigo_aleatorio("LB", 8, rand(0,9));?>" maxlength="10">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Título *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="titulo-reg" required="" maxlength="40">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Autor *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="autor-reg" required="" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">País</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="pais-reg" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Año</label>
                                    <input pattern="[0-9]{1,4}" class="form-control" type="text" name="year-reg" maxlength="4">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Editorial</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="editorial-reg" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Edición</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="edicion-reg" maxlength="30">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Categoría</label>
                                    <select name="categoria-reg" class="form-control">
                                        <?php
                                        $data = $insCat->datos_categoria_controlador();

                                        foreach ($data as $categoria){?>
                                            <option value="<?php echo $categoria['CategoriaCodigo']; ?>"><?php echo $categoria['CategoriaNombre']; ?></option>
                            <?php  }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Introducción</label>
                                    <textarea name="resumen-reg" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend><i class="zmdi zmdi-attachment-alt"></i> &nbsp; Imagen y archivo PDF</legend>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="control-label">Imagen</span>
                            <input type="file" name="imagen-reg" accept=".jpg, .png, .jpeg">
                            <div class="input-group">
                                <input type="text" readonly="" class="form-control" placeholder="Elija la imagen...">
                                <span class="input-group-btn input-group-sm">
                                    <button type="button" class="btn btn-fab btn-fab-mini">
                                        <i class="zmdi zmdi-attachment-alt"></i>
                                    </button>
                                </span>
                            </div>
                            <span><small>Tamaño máximo: <strong>(5MB)</strong><br>Archivos permitidos <strong>(PNG, JPEG y JPG)</strong></small></span>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <span class="control-label">PDF</span>
                            <input type="file" name="pdf-reg" accept=".pdf">
                            <div class="input-group">
                                <input type="text" readonly="" class="form-control" placeholder="Elija el PDF...">
                                <span class="input-group-btn input-group-sm">
                                    <button type="button" class="btn btn-fab btn-fab-mini">
                                        <i class="zmdi zmdi-attachment-alt"></i>
                                    </button>
                                </span>
                            </div>
                            <span><small>Tamaño máximo: <strong>(5MB)</strong><br>Archivos permitidos: <strong>(PDF)</strong></small></span>
                        </div>
                    </div>
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
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>