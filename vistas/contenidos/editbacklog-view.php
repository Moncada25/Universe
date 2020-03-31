<br>
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; EDITAR TAREA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/backlogAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Tarea *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,60}" class="form-control" type="text" name="tarea" id="tarea" required="" maxlength="60">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Puntos *</label>
                                    <input pattern="[0-9+]{1,15}" class="form-control" type="text" name="puntos" id="puntos" maxlength="2">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="Nueva" selected>Nueva</option>
                                        <option value="Nueva">Activa</option>
                                        <option value="Nueva">Impedimento</option>
                                        <option value="Nueva">Cerrada</option>
                                        <option value="Nueva">Remover</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Descripción *</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="2" maxlength="500"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                    <a href="<?php echo SERVERURL; ?>tasklist/" class="btn btn-danger btn-raised btn-sm">
                    <i class="zmdi zmdi-back"></i> Volver
                </a>
                </p>

                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>