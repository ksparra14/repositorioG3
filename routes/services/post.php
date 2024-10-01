<?php
require_once "models/connection.php";
require_once "controllers/post.controller.php";


/*  separar las propiedeades del arreglo */

$columns=array();
foreach (array_keys($_POST) as $key=>$values){
    array_push($columns, $values );
}

/* validamos las tablas y las columnas  */

if(empty(Connection::getColumnsData($table, $columns))){
     $json =array(
        'result'=>400,
        'result'=> "los nombres de los campos de la base de datos no coniciden"
     );
     
     echo json_encode($json,http_response_code($json["status"]));
     return;
}

$response= new PostControlller();

/* peticion post para registro de usuarios */


if(isset($_GET["register"])&& $_GET["register"==true] ){
    $suffix =$_GET["suffix"]?? "user";
    $response ->postRegistrer($table,$_POST,$suffix);

/* cuando recibe una peticion post de login */

}else if(isset($_GET["login"])&& $_GET["login"]==true){
    $suffix =$_GET["suffix"]?? "user";
    $response ->postLogin($table,$_POST,$suffix);

}else{
    if(isset($_GET["token"])){

       /* tarea hacer las validaciones del token de usario jwt */ 

       /* peticion post para usuarios no autorizados*/

       /* peticion post para usuarios autorizados */

       /* validar cuando el token expiro */

       /* validar cuanto el token no conicide con el de la base de datos*/

       /* validar cuando no se envia token*/
    }


}

?>