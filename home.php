<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "jwt_class.php";

if($_GET['act'] == 'beranda'){

    $gettoken = new jwt_class();
    $token = $gettoken->get_jwt_token();
    echo json_encode(array("token"=>$token));
    
}

if($_GET['act'] == 'data'){

    $vertoken = new jwt_class();
    $jwt = $vertoken->getHeader();
    $ver = $vertoken->verify_jwt_token($jwt);
    echo $ver;

}





