<div class="blur"></div>
<div class="full-box login-container cover">
    <div class="efecto-abajo">
        <form action="" method="POST" autocomplete="off" class="logInForm">
            <p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
            <p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
            <div class="form-group label-floating is-empty">
                <label class="control-label" for="UserName">Usuario</label>
                <input style="color:whitesmoke;" class="form-control" id="UserName" name="usuario" type="text" required>
                <p class="help-block">Escribe tu nombre de usuario</p>
            </div>
            <div class="form-group label-floating is-empty">
                <label class="control-label" for="UserPass">Contraseña</label>
                <input style="color:whitesmoke;" class="form-control" id="UserPass" name="clave" type="password" required>
                <p class="help-block">Escribe tu contraseña</p>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Iniciar sesión" class="btn btn-info" style="color: #FFF;">
                <br><small>¿No estás registrado?</small><br>
                <a href="<?php echo SERVERURL;?>registro/"><input type="button" value="Regístrate" id="btnRegistrarNuevo" class="btn btn-info" style="color: #FFF;"></a>
            </div>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['usuario']) && isset($_POST['clave'])){

        require_once "./controladores/loginControlador.php";

        $login = new loginControlador();
        
        echo $login->iniciar_sesion_controlador();
    }
?>