<?php

class DeleteController {

/* Peticiones delete para eliminiar datos */

static public function deleteData($table,$id, $nameId){
    $response =DeleteModel::deleteData($table,$id, $nameId);
    $return=new DeleteController();
    $return ->fncResponse($response);

}
/* respuesta del controlador */
public function fncResponse(){
    if(!empty($response)){

        $json=array (
            'status'=>200,
            'result'=>$response

        );

    }else{
        $json =array(
            'status'=>404,
            'result'=>'Not Found',
            'method'=>'delete'

        );

    }
    echo json_encode($json,http_response_code($json["status"]));

}

}