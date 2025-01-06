<?php
session_start(['name' => 'SBP']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" href="<?php echo SERVERURL; ?>vistas/assets/img/icon.png">
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/main.css">
	<!--====== Scripts -->
	<?php include "vistas/modulos/script.php"; ?>
</head>
<body>

	<?php

		$peticionAjax = false;

		require_once $SERVERURL . "controladores/loginControlador.php";
		$lc = new loginControlador();

		require_once $SERVERURL . "controladores/vistasControlador.php";
		$vt = new vistasControlador();

		$vistasR = $vt->obtener_vistas_controlador();

		if($vistasR == "login" || $vistasR == "404" || $vistasR == "signup"):

			if(isset($_SESSION['token_sbp']) && isset($_SESSION['usuario_sbp']) && ($vistasR == "login" || $vistasR == "signup")){
				echo $lc->redireccionar_usuario_controlador($_SESSION['tipo_sbp']);
			}

			if($vistasR == "login"){
				require_once $SERVERURL . "vistas/contenidos/login-view.php";
			}elseif($vistasR == "signup"){
				require_once $SERVERURL . "vistas/contenidos/signup-view.php";
			}else{
				require_once $SERVERURL . "vistas/contenidos/404-view.php";
			}

		else:

			if(!isset($_SESSION['token_sbp']) || !isset($_SESSION['usuario_sbp'])){
				echo $lc->forzar_cierre_sesion_controlador();
			}
	?>

	<!-- SideBar -->
    <?php include $SERVERURL . "vistas/modulos/navlateral.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">

		<!-- NavBar -->
        <?php include $SERVERURL . "vistas/modulos/navbar.php"; ?>

		<!-- Content page -->
		<?php require_once $vistasR; ?>

	</section>

<?php include $SERVERURL . "vistas/modulos/logoutScript.php";

			endif; ?>

		<script>
			$.material.init();
		</script>
</body>
</html>