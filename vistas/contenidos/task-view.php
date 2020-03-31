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

<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA TAREA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/backlogAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating is-empty">
                                    <label class="control-label">Tarea *</label>
                                    <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ][0-9]{1,15}{1,60}" class="form-control" type="text" name="tarea" id="tarea" required="" maxlength="60">
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
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>