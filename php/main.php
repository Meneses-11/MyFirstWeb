<?php
    #Conexión a la base de datos#
    function conex(){
        $pdo = new PDO('mysql:host=localhost;dbname=inventario','root','adrian123');
        return $pdo;
    }
    //metodo de la clase que hemos instanciado
    //$pdo->query("INSERT INTO categoria(cate_name,cate_location) VALUES('prueba','Ixtepec')"); 

    #Verificar Datos#
    function verifDatos($filtro, $info){
        if(preg_match("/^".$filtro."$/",$info)){
            return false;
        }else{ 
            return true;
        }
    }

    #Limpiar cadena de texto#
    function limpCadena($texto){
        $texto = trim($texto);  //metodo para eliminar espacios en blanco al inicio y final
        $texto = stripslashes($texto); //metodo para eliminar las diagonales
        $texto = str_ireplace("<script>","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("</script>","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("<script src","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("<script type=","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("SELECT * FROM","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("DELETE FROM","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("INSERT INTO","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("DROP TABLE","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("DROP DATABASE","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("TRUNCATE TABLE","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("SHOW TABLES","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("SHOW DATABASES","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("<?php","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("?>","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("--","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("^","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("<","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("[","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("]","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("==","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace(";","",$texto); //metodo para buscar y remplazar texto
        $texto = str_ireplace("::","",$texto); //metodo para buscar y remplazar texto
        $texto = trim($texto);
        $texto = stripcslashes($texto);
        return $texto;        
    }

    #Renombrar Fotos#
    function renameFotos($namePhoto){
        $namePhoto = str_ireplace(" ","_",$namePhoto);
        $namePhoto = str_ireplace("/","_",$namePhoto);
        $namePhoto = str_ireplace("#","_",$namePhoto);
        $namePhoto = str_ireplace("-","_",$namePhoto);
        $namePhoto = str_ireplace("$","_",$namePhoto);
        $namePhoto = str_ireplace(".","_",$namePhoto);
        $namePhoto = str_ireplace(",","_",$namePhoto);
        $namePhoto = $namePhoto."_".rand(0,100);
        return $namePhoto;
    }

    #Funcion paginador de tablas#
    function paginTablas($pag,$npag,$url,$nBtn){
        $tabla = '
        <nav class="pagination is-sentered is-rounded" 
        role="navigation" aria-label="pagination">
        ';

        if($pag <= 1){
            $tabla.= '
            <a class="pagination-previous is-disabled" disabled >Anterior</a>
            <ul class="pagination-list">
            ';
            
        }else{
            $tabla.= '
            <a class="pagination-previous" href="'.$url.($pag-1).'">Anterior</a>
            <ul class="pagination-list">
                <li><a class="pagination-link" href="'.$url.'1">1</a></l1>
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            ';
        }

        $cont = 0;
        for($i=$pag ; $i <= $npag ; $i++){
            if($cont >= $nBtn){
                break;
            }
            if($pag == $i){
                $tabla.='
                <li><a class="pagination-link is-current" haref="'.$url.$i.'">'.$i.'</a></li>
                ';
            }else{
                $tabla.='
                <li><a class="pagination-link" haref="'.$url.$i.'">'.$i.'</a></li>
                ';
            }
            $cont++;
        }

        if($pag == $npag){
            $tabla.= '
            </ul>
            <a class="pagination-next is-disabled" disabled >Siguiente</a>
            ';
            
        }else{
            $tabla.= '
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" href="'.$url.$npag.'">'.$npag.'</a></li>
            </ul>
            <a class="pagination-next" href="'.$url.($pag+1).'">Siguiente</a>
            ';
        }

        $tabla.='</nav>';
        return $tabla;

    }

