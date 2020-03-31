<?php

    if($peticionAjax){
        require_once "../core/configAPP.php";
    }else{
        require_once "./core/configAPP.php";
    }

    class mainModel{

        protected static function conectar(){
            $enlace = new PDO(SGBD, USER, PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $enlace;
        }

        protected function ejecutar_consulta_simple($consulta){
            $respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            return $respuesta;
        }

        protected function agregar_cuenta($datos){
            $sql = self::conectar()->prepare(
                "INSERT INTO cuenta(CuentaCodigo, CuentaPrivilegio, CuentaUsuario, CuentaClave, CuentaEmail,
                CuentaEstado, CuentaTipo, CuentaGenero, CuentaFoto)
                 VALUES(:Codigo, :Privilegio, :Usuario, :Clave, :Email, :Estado, :Tipo, :Genero, :Foto)");

            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->bindParam(":Privilegio", $datos['Privilegio']);
            $sql->bindParam(":Usuario", $datos['Usuario']);
            $sql->bindParam(":Clave", $datos['Clave']);
            $sql->bindParam(":Email", $datos['Email']);
            $sql->bindParam(":Estado", $datos['Estado']);
            $sql->bindParam(":Tipo", $datos['Tipo']);
            $sql->bindParam(":Genero", $datos['Genero']);
            $sql->bindParam(":Foto", $datos['Foto']);

            $sql->execute();

            return $sql;
        }

        protected function eliminar_cuenta($codigo){
            $sql = self::conectar()->prepare("DELETE FROM cuenta WHERE CuentaCodigo=:Codigo");
            $sql->bindParam(":Codigo", $codigo);

            $sql->execute();

            return $sql;
        }

        protected function datos_cuenta($codigo, $tipo){

            $query = self::conectar()->prepare("SELECT * FROM cuenta WHERE CuentaCodigo = :Codigo AND CuentaTipo = :Tipo");

            $query->bindParam(":Codigo", $codigo);
            $query->bindParam(":Tipo", $tipo);

            $query->execute();

            return $query;
        }

        protected function actualizar_cuenta($datos){

            $query = self::conectar()->prepare("UPDATE cuenta
            SET CuentaPrivilegio = :Privilegio, CuentaUsuario = :Usuario, CuentaClave = :Clave, CuentaEmail = :Email, CuentaEstado = :Estado, CuentaGenero = :Genero, CuentaFoto = :Foto
            WHERE CuentaCodigo = :Codigo");

            $query->bindParam(":Privilegio", $datos['CuentaPrivilegio']);
            $query->bindParam(":Usuario", $datos['CuentaUsuario']);
            $query->bindParam(":Clave", $datos['CuentaClave']);
            $query->bindParam(":Email", $datos['CuentaEmail']);
            $query->bindParam(":Estado", $datos['CuentaEstado']);
            $query->bindParam(":Genero", $datos['CuentaGenero']);
            $query->bindParam(":Foto", $datos['CuentaFoto']);
            $query->bindParam(":Codigo", $datos['CuentaCodigo']);

            $query->execute();

            return $query;
        }

        protected function guardar_bitacora($datos){

            $sql = self::conectar()->prepare("INSERT INTO bitacora(BitacoraCodigo, BitacoraFecha, BitacoraHoraInicio, BitacoraHoraFinal, BitacoraTipo, BitacoraYear, CuentaCodigo)
            VALUES(:Codigo, :Fecha, :HoraInicio, :HoraFinal, :Tipo, :Year, :Cuenta)");

            $sql->bindParam(":Codigo", $datos['Codigo']);
            $sql->bindParam(":Fecha", $datos['Fecha']);
            $sql->bindParam(":HoraInicio", $datos['HoraInicio']);
            $sql->bindParam(":HoraFinal", $datos['HoraFinal']);
            $sql->bindParam(":Tipo", $datos['Tipo']);
            $sql->bindParam(":Year", $datos['Year']);
            $sql->bindParam(":Cuenta", $datos['Cuenta']);

            $sql->execute();

            return $sql;
        }

        protected function actualizar_bitacora($codigo, $hora){

            $sql = self::conectar()->prepare("UPDATE bitacora SET BitacoraHoraFinal = :Hora WHERE BitacoraCodigo = :Codigo");

            $sql->bindParam(":Hora", $hora);
            $sql->bindParam(":Codigo", $codigo);

            $sql->execute();

            return $sql;
        }

        protected function eliminar_bitacora($codigo){

            $sql = self::conectar()->prepare("DELETE FROM bitacora WHERE CuentaCodigo = :Codigo");

            $sql->bindParam(":Codigo", $codigo);

            $sql->execute();

            return $sql;
        }

        public static function datos_bitacora($limite){

            $sql = self::conectar()->prepare("SELECT * FROM bitacora ORDER BY id DESC LIMIT $limite");

            $sql->execute();

            return $sql;
        }

        public function datos_usuario($codigo, $tipo){

            if($tipo == "Administrador"){

                $query = self::conectar()->prepare(
                  "SELECT A.AdminNombre, A.AdminApellido, C.CuentaFoto
                    FROM admin A
                    INNER JOIN cuenta C
                    ON C.CuentaCodigo = A.CuentaCodigo
                    WHERE C.CuentaCodigo = '$codigo'
                ");

            }else{

                $query = self::conectar()->prepare(
                  "SELECT A.ClienteNombre, A.ClienteApellido, C.CuentaFoto
                    FROM cliente A
                    INNER JOIN cuenta C
                    ON C.CuentaCodigo = A.CuentaCodigo
                    WHERE C.CuentaCodigo = '$codigo'
                ");
            }

            $query->execute();

            return $query;
        }

        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
        }

		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
        }

        public static function generar_codigo_aleatorio($letra, $longitud, $num){

            for($i=1; $i <= $longitud; $i++){
                $numero = rand(0,9);
                $letra .= $numero;
            }

            return $letra.$num;
        }

        protected function limpiar_cadena($cadena){
            $cadena = trim($cadena);
            $cadena = stripcslashes($cadena);
            $cadena = str_ireplace("<script>", "", $cadena);
            $cadena = str_ireplace("</script>", "", $cadena);
            $cadena = str_ireplace("<script src", "", $cadena);
            $cadena = str_ireplace("<script type=", "", $cadena);
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("DELETE FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("--", "", $cadena);
            $cadena = str_ireplace("^", "", $cadena);
            $cadena = str_ireplace("[", "", $cadena);
            $cadena = str_ireplace("]", "", $cadena);
            $cadena = str_ireplace("==", "", $cadena);
            $cadena = str_ireplace(";", "", $cadena);

            return $cadena;
        }

        public static function eliminar_acentos($cadena){

            //Reemplazamos la A y a
            $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
            );

            //Reemplazamos la E y e
            $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );

            //Reemplazamos la I y i
            $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );

            //Reemplazamos la O y o
            $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );

            //Reemplazamos la U y u
            $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );

            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );

            return $cadena;
        }

        public static function enviar_correo($asunto, $mensaje, $usuario){

            include "../libs/PHPMailer-master/src/PHPMailer.php";
            include "../libs/PHPMailer-master/src/SMTP.php";

            $email_user = "packappsmysystems@gmail.com";
            $email_password = "PackApps123**";
            $the_subject = "Feedback by ".$usuario;
            $address_to = "zanti4020@gmail.com";
            $from_name = $asunto;
            $phpmailer = new PHPMailer\PHPMailer\PHPMailer();
            // ---------- datos de la cuenta de Gmail -------------------------------
            $phpmailer->Username = $email_user;
            $phpmailer->Password = $email_password;
            //-----------------------------------------------------------------------
            //$phpmailer->SMTPDebug = 1;
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->Host = "smtp.gmail.com"; // GMail
            $phpmailer->Port = 465;
            $phpmailer->IsSMTP(); // use SMTP
            $phpmailer->SMTPAuth = true;
            $phpmailer->setFrom($phpmailer->Username, $from_name);
            $phpmailer->AddAddress($address_to); // recipients email
            $phpmailer->Subject = $the_subject;

            $phpmailer->Body .= "<h2>" . $mensaje . "</h2>";
            $phpmailer->IsHTML(true);
            $phpmailer->Send();
        }

        public static function mostrar_modal($id){



        }

        protected function sweet_alert($datos){

            if($datos['Alerta'] == "simple"){
                $alerta = "
                    <script>
                        swal({
                            title: '". $datos['Titulo'] ."',
                            text: '". $datos['Texto'] ."',
                            type: '". $datos['Tipo'] ."'
                        });
                    </script>
                ";
            }elseif($datos['Alerta'] == "recargar"){
                $alerta = "
                    <script>
                        swal({
                            title: '". $datos['Titulo'] ."',
                            text: '". $datos['Texto'] ."',
                            type: '". $datos['Tipo'] ."',
                            confirmButtonText: 'Aceptar'
                        }).then(function() {
                            location.reload();
                        });
                    </script>
                    ";
            }elseif($datos['Alerta'] == "limpiar"){
                $alerta = "
                <script>
                    swal({
                        title: '". $datos['Titulo'] ."',
                        text: '". $datos['Texto'] ."',
                        type: '". $datos['Tipo'] ."',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        $('.FormularioAjax').trigger('reset');
                    });
                </script>
                ";
            }

            return $alerta;
        }
    }