<?php
    if($_SESSION['tipo_sbp'] != "Administrador"){
        echo $lc->forzar_cierre_sesion_controlador();
    }
?>

<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles text-center"><small>REGISTROS</small></h1>
    </div>
</div>

<div class="full-box text-center" style="padding: 30px 10px;">

    <?php
        require "./controladores/administradorControlador.php";

        $IAdmin = new administradorControlador();
        $CAdmin = $IAdmin->datos_administrador_controlador("Conteo", 0);

        $dataBitacora = $IAdmin->datos_bitacora(10);

        require "./controladores/clienteControlador.php";

        $ICliente = new clienteControlador();
        $CCliente = $ICliente->datos_cliente_controlador("Conteo", 0);

        require "./controladores/libroControlador.php";

        $ILibro = new libroControlador();
        $CLibro = $ILibro->datos_libro_controlador("Conteo", 0);
    ?>

    <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
            Administradores
        </div>
        <div class="full-box tile-icon text-center">
            <i class="zmdi zmdi-account"></i>
        </div>
        <div class="full-box tile-number text-titles">
            <p class="full-box"><?php echo $CAdmin->rowCount(); ?></p>
            <small>Registrados</small>
        </div>
    </article>
    <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
            CLIENTES
        </div>
        <div class="full-box tile-icon text-center">
            <i class="zmdi zmdi-male-alt"></i>
        </div>
        <div class="full-box tile-number text-titles">
            <p class="full-box"><?php echo $CCliente->rowCount(); ?></p>
            <small>Registrados</small>
        </div>
    </article>
    <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
            Libros
        </div>
        <div class="full-box tile-icon text-center">
            <i class="zmdi zmdi-book"></i>
        </div>
        <div class="full-box tile-number text-titles">
            <p class="full-box"><?php echo $CLibro->rowCount(); ?></p>
            <small>Registrados</small>
        </div>
    </article>
</div>
<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles text-center"><small>LÍNEA DE TIEMPO</small></h1>
    </div>
    <section id="cd-timeline" class="cd-container">

        <?php
        foreach($dataBitacora as $bitacora):
            $user = $IAdmin->datos_usuario($bitacora['CuentaCodigo'], $bitacora['BitacoraTipo']);
            $user = $user->fetch();
        ?>

        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL."vistas/assets/avatars/".$user[2]; ?>" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">
                    <?php echo "<strong>".$user[0] . " ".$user[1]."</strong>";?>
                </h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inicio: <em><?php echo $bitacora['BitacoraHoraInicio'];?></em> &nbsp;&nbsp;&nbsp; <br>
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Final: <em><?php echo $bitacora['BitacoraHoraFinal'];?></em>
                </p>
                <h4 class="text-center text-titles">
                    <i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> <?php echo $bitacora['BitacoraFecha'];?>
                </h4>
                <strong><span class="cd-date"> <?php echo $bitacora['BitacoraTipo'];?></span></strong>
            </div>
        </div>

        <?php endforeach; ?>
    </section>
</div>