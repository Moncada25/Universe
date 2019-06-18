<div class="efecto-arriba myScroll">
    <div class="container-fluid">
        <div class="page-header">
            <h3 class="text-center">Welcome to Bookverse</h3>
        </div>
    </div>
    <!-- Panel nuevo cliente -->
    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVA CUENTA</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo SERVERURL; ?>ajax/clienteAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                    <fieldset>
                        <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nombres *</label>
                                        <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="nombre-reg" required="" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Apellidos *</label>
                                        <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apellido-reg" required="" maxlength="30">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Teléfono</label>
                                        <input pattern="[0-9+]{1,15}" class="form-control" type="text" name="telefono-reg" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Cargo/Ocupación</label>
                                        <select name="categoria-up" class="form-control">
                                            <option value="Estudiante" selected>Estudiante</option>
                                            <option value="Profesor">Profesor</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Dirección</label>
                                        <textarea name="direccion-reg" class="form-control" rows="2" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend><i class="zmdi zmdi-key"></i> &nbsp; Datos de la cuenta</legend>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nombre de usuario *</label>
                                        <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="usuario-reg" required="" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Contraseña *</label>
                                        <input class="form-control" type="password" name="password1-reg" required="" maxlength="70">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Repita la contraseña *</label>
                                        <input class="form-control" type="password" name="password2-reg" required="" maxlength="70">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">E-mail</label>
                                        <input class="form-control" type="email" name="email-reg" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Genero</label>
                                        <div class="radio radio-primary">
                                            <label>
                                                <input type="radio" name="optionsGenero" id="optionsRadios1" value="Masculino" checked="">
                                                <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
                                            </label>
                                        </div>
                                        <div class="radio radio-primary">
                                            <label>
                                                <input type="radio" name="optionsGenero" id="optionsRadios2" value="Femenino">
                                                <i class="zmdi zmdi-female"></i> &nbsp; Femenino
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <p class="text-center" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-raised btn-sm">Registrarse</button>
                    </p>
                    <input type="hidden" name="registro" value="true">
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 
if(isset($_POST['registro'])){
                echo "<script>window.location.replace('".SERVERURL."');</script>";
            } -->