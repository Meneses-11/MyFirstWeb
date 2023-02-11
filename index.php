<?php require "./inclu/login_start.php";//requerimos del archivo login_start ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./inclu/head.php";//incluimos al archivo head ?>
</head>
<body>
    <?php 
        
        if(!isset($_GET['vista']) || $_GET['vista']==""){ //si la variable "vista" no existe o no tiene nada
            $_GET['vista'] = "login"; //le asignamos el valor "login"
        }

        if(is_file("./view/".$_GET['vista'].".php") && $_GET['vista']!="login" 
        && $_GET['vista']!="404"){ //si el archivo 'vista' existe y es diferente de login y 404

            include "./inclu/navbar.php"; //incluimos el archivo "navbar" (nuestra barra de navegacion)

            include "./view/".$_GET['vista'].".php"; //incluimos el archivo "$_GET['vista']" (nuestra vista)

            include "./inclu/script.php"; //incluimos el archivo "script" 
            //(contiene el codigo js para mostrar el menu en disp moviles y para enviar los formularios via ajax)
            
        }else{
            if($_GET['vista']=="login"){ //si vista es igual que "login"
                include "./view/login.php"; //incluimos el archivo "login" (nuestra vista de login)
            }else{
                include "./view/404.php"; //incluimos el archivo "404" (nuestra vista de error)
            }
        }

        

    ?>
</body>
</html>
