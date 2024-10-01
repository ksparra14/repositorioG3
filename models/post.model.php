<?php
require_once "connection.php";

class PostModel{
    

    /* crear un peticion por para crear datos de forma dinamimca */

    static public function postData($table, $data){
        $columns="";
        $paramns= "";
        foreach($data as $key => $value){
             $columns .=$key.",";
             $paramns .=":".$key. ",";
        }
        $columns = substr($columns, 0, -1);
        $paramns = substr($paramns, 0 , -1);
        $sql="INSERT INTO $table ($columns) VALUE ($paramns)";
        $link = Connection::connect();
        $stmp=$link->prepare($sql);
        foreach($data as $key=> $value){
            $stmp -> bindParam(":".$key, $data[$key],PDO::PARAM_STR);
        }
        if($stmp->execute()){
            $response= array(
                "lastaId"=> $link -> lastInsertId(),
                "coment" => "proceso exitoso"
            );   
            return $response;
        }else{
            return $link->errorInfo();
        }
    }
}


?>