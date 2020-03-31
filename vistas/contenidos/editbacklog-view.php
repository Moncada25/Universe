<?php

require_once "./controladores/backlogControlador.php";
$insBacklog = new backlogControlador();

$datos = explode("/", $_GET['views']);

$tarea = $insBacklog->datos_tarea_controlador($insBacklog->decryption($datos[1]));
$tarea = $tarea->fetch();
?>

<br>
<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title text-center">EDITAR TAREA</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/backlogAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <fieldset>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tarea *</label>

                                    <?php
                                    if($tarea['Status'] != "Cerrada"){ ?>
                                        <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ][0-9]{1,15}{1,60}" class="form-control" type="text" name="tarea-act" id="tarea-act" value="<?php echo $tarea['Task']?>" required="" maxlength="60">
                            <?php   }else{ ?>
                                        <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ][0-9]{1,15}{1,60}" class="form-control" type="text" name="tarea-act" id="tarea-act" value="<?php echo $tarea['Task']?>" required="" maxlength="60" readonly>
                            <?php   }
                            ?>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Puntos *</label>
                                    <?php
                                    if($tarea['Status'] != "Cerrada"){ ?>
                                        <input pattern="[0-9+]{1,2}" value="<?php echo $tarea['Points']?>" class="form-control" type="text" name="puntos-act" id="puntos-act" maxlength="2">
                            <?php   }else{ ?>
                                        <input pattern="[0-9+]{1,2}" value="<?php echo $tarea['Points']?>" class="form-control" type="text" name="puntos-act" id="puntos-act" maxlength="2" readonly>
                            <?php   }
                            ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Estado</label>
                                    <select name="estado-act" id="estado-act" class="form-control">
                                    <?php
                                    switch($tarea['Status']){

                                        case "Nueva":
                                            echo("<option selected>Nueva</option>
                                            <option>Activa</option>
                                            <option>Impedimento</option>
                                            <option>Cerrada</option>
                                            <option>Remover</option>");
                                        break;
                                        case "Activa":
                                            echo("<option>Nueva</option>
                                            <option selected>Activa</option>
                                            <option>Impedimento</option>
                                            <option>Cerrada</option>
                                            <option>Remover</option>");
                                        break;
                                        case "Impedimento":
                                            echo("<option>Nueva</option>
                                            <option>Activa</option>
                                            <option selected>Impedimento</option>
                                            <option>Cerrada</option>
                                            <option>Remover</option>");
                                        break;
                                        case "Cerrada":
                                            echo("<option>Nueva</option>
                                            <option>Activa</option>
                                            <option>Impedimento</option>
                                            <option selected>Cerrada</option>
                                            <option>Remover</option>");
                                        break;
                                        default:
                                        echo "Error...";
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Descripción *</label>
                                    <?php
                                    if($tarea['Status'] != "Cerrada"){ ?>
                                        <textarea name="descripcion-act" id="descripcion-act" class="form-control" rows="2" maxlength="500"><?php echo $tarea['Description']?></textarea>
                            <?php   }else{ ?>
                                       <textarea name="descripcion-act" id="descripcion-act" class="form-control" rows="2" maxlength="500" readonly><?php echo $tarea['Description']?></textarea>
                            <?php   }
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <p class="text-center" style="margin-top: 20px;">
                    <a href="<?php echo SERVERURL; ?>tasklist/" class="btn btn-danger btn-raised btn-sm">
                        <i class="zmdi zmdi-arrow-left"></i> Volver
                    </a>
                    <button type="submit" name="guardar-tarea" id="guardar-tarea" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar
                    </button>
                </p>
                <input type="hidden" name="id-tarea" id="id-tarea" value="<?php echo $insBacklog->decryption($datos[1])?>"/>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>