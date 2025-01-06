<section class="full-box cover dashboard-sideBar">
    <div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
    <div class="full-box dashboard-sideBar-ct">
        <!--SideBar Title -->
        <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
        <?php echo COMPANY; ?>
        </div>
        <!-- SideBar User info -->
        <div class="full-box dashboard-sideBar-UserInfo">
            <figure class="full-box">
                <img src="<?php echo SERVERURL; ?>vistas/assets/avatars/<?php echo $_SESSION['foto_sbp']; ?>" alt="UserIcon">
                <h4 class="text-center text-titles"><?php echo $_SESSION['nombre_sbp'] . " " . $_SESSION['apellido_sbp']; ?></h4>
                <h5 class="text-center text-titles"><?php echo $_SESSION['tipo_sbp']; ?></h5>
            </figure>

            <?php
                if($_SESSION['tipo_sbp'] == "Administrador"){
                    $tipo = "admin";
                }else{
                    $tipo = "user";
                }
            ?>

            <ul class="full-box list-unstyled text-center">
                <li>
                    <a href="<?php echo SERVERURL; ?>mydata/<?php echo $tipo . "/" . $lc->encryption($_SESSION['codigo_cuenta_sbp']); ?>" data-title="Mis datos">
                        <i class="zmdi zmdi-account-circle"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SERVERURL; ?>myaccount/<?php echo $tipo . "/" . $lc->encryption($_SESSION['codigo_cuenta_sbp']); ?>" data-title="Mi cuenta">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $lc->encryption($_SESSION['token_sbp']); ?>" data-title="Cerrar sesión" class="btn-exit-system">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- SideBar Menu -->
        <ul class="list-unstyled full-box dashboard-sideBar-Menu">

            <?php if($_SESSION['tipo_sbp'] == "Administrador"):?>

            <li>
                <a href="<?php echo SERVERURL; ?>home/">
                    <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
                </a>
                <ul class="list-unstyled full-box">
                    <li>
                        <a href="<?php echo SERVERURL; ?>categorylist/"><i class="zmdi zmdi-labels zmdi-hc-fw"></i> Categorías</a>
                    </li>
                    <li>
                        <a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Nuevo libro</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
                </a>
                <ul class="list-unstyled full-box">
                    <li>
                        <a href="<?php echo SERVERURL; ?>adminlist/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
                    </li>
                    <li>
                        <a href="<?php echo SERVERURL; ?>clientlist/"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Clientes</a>
                    </li>
                </ul>
            </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo SERVERURL; ?>catalog/all/">
                    <i class="zmdi zmdi-book-image zmdi-hc-fw"></i> Catálogo de libros
                </a>
            </li>
            <li>
                <a href="<?php echo SERVERURL; ?>tasklist/">
                    <i class="zmdi zmdi-lamp zmdi-hc-fw"></i> Backlog
                </a>
            </li>
        </ul>
    </div>
</section>