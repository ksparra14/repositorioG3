<?php

 class PutController{

static public function putData($table, $data,$id, $nameId){
    $response=PutModel::putData($table, $data,$id, $nameId);

    $return =new PutController();
    $return->fncResponse();
}
static public function fncResponse(){
 if(!empty($response)){
    $json=array(
        'status'=>200,
        'result'=>$response
    );

 }else{

    $json =array(
        'staus'=>404,
        'result'=>'Not Found',
        'method'=>'put'
    );

 }
 echo json_encode($json,http_response_code($json["status"]));

}

}


