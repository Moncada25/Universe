<?php

    class vistasModelo{

        protected function obtener_vistas_modelo($vistas){

            $listaBlanca = ["adminlist", "adminsearch", "admin", "book", "bookconfig", "bookinfo",
                        "catalog", "category", "categorylist", "client", "clientlist", "clientsearch",
                        "home", "myaccount", "mydata",
                        "search", "signup", "github", "task", "tasklist", "backlog"];

            if(in_array($vistas, $listaBlanca)){

                if(is_file("./vistas/contenidos/" . $vistas . "-view.php")){
                    $contenido = "./vistas/contenidos/" . $vistas . "-view.php";
                }else{
                    $contenido = "login";
                }

                if($vistas == "signup"){
                    $contenido = "signup";
                }

            }elseif($vistas == "login"){
                $contenido = "login";
            }elseif($vistas == "index"){
                $contenido = "login";
            }else{
                $contenido = "404";
            }

            return $contenido;
        }
    }