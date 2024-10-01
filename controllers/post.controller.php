<?php

require_once "vendor/autoload.php";
use Firebase\JWT\JWT;

class PostControlller {

/* metodo post para crear datos */

static public function postData($table,$data){
    $response=PostModel::postData($table,$data);
    $return= new PostControlller ();
    $return -> fncResponse ($response, null, null);
}
/* metodo para registrar usuario */

static public function postRegistrer($table,$data,$suffix){
    if(isset($data["password_".$suffix]) && $data["password_".$suffix]!=null ){
        $crypt= crypt($data["password_".$suffix],'$2a$07$azybxcags23425sdg23sdfhsd$');
        $data["password_".$suffix]=$crypt;

        $response=PostModel::postData($table,$data);
        $return=new PostControlller();
        $return ->fncResponse ($response, null,null);
    }
}
/* tarear para revisar registro de usuarios desde apps externas google facebook */
/* ---------------------------- revisar --------------------------------------*/

/* metodo post para login de usuario */
static public function postLogin ($table, $data,$suffix){
    /* validamos que el usuario exista en la base de datos */
    $response=GetModel::getDataFilter($table, "*",  "email_".$suffix,$data["email_".$suffix],null,null,null,null);
    if (!empty($response)){
        if ($response[0]->{"password_".$suffix} !=null){
            $crypt= crypt($data["password_".$suffix],'$2a$07$azybxcags23425sdg23sdfhsd$');
            $token=Connection::jwt($response[0]->{"id_".$suffix},$response[0]->{"email_".$suffix});
            $jwt=JWT::encode($token,"443dsgdfasdgrgasdfnmtrtfdft436");
            
            /* actualizamos la base de datos  */
            $data =array(
                "token_".$suffix=>$jwt,
                "token_exp_".$suffix=>$token["exp"]

            ); 
            $update=PutModel::putData($table,$data,$response[0]->{"id_".$suffix}, "id_".$suffix);

            if(isset($update["comment"])&& $update["comment"]=="The process was successfull"){
                $response[0]->{"token_".$suffix}=$jwt;
                $response[0]->{"token_exp_".$suffix}=$token["exp"];

                $return=new PostControlller();
                $return ->fncResponse($response, null,null);
            }else{
                     $response=null;
                     $return=new PostControlller();
                     $return ->fncResponse($response,"Wrong Password", $suffix);
                }            
                /* cuando se loguena desde apps externas esto es parte de la tarea tienen que actualizar el token revisar la tarea*/            
        }
    }
}

            /* respuesta del controlador  */

            public function fncResponse ($response,$error,$suffix){
                if(!empty($response)){
                    /* quitamos la contraseña de la respuesta */
                    if(isset($response[0]->{"password_".$suffix})){
                        unset($response[0]->{"password_".$suffix});

                    }
                    $json=array(
                        'status'=>200,
                        'result'=>$response
                    );
                }else {

                    if($error !=null){
                        $json= array(
                            'status'=>400,
                            "result"=>$error

                        );

                    }else{
                 $json=array(
                    'status'=>404,
                    'result'=>"Not Found",
                    'method'=>'post'

                 );    
                
                }
            }
                echo json_encode($json,http_response_code($json["status"]));
            }

    }







?>