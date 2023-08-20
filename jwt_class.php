<?php

require "vendor/autoload.php";
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class jwt_class {

    // jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
    // $expirationTime = $issuedAt + 60 * 60 * 24 * 60;
    
    function get_jwt_token(){        
            
            $key = 'abc123@';
            $issuedat_claim = time();
            $notbefore_claim = $issuedat_claim + 10;
            $expire_claim = $issuedat_claim + 60;
            $payload = [
                'iss' => 'http://localhost',
                'aud' => 'THE_AUDIENCE',
                'iat' => $issuedat_claim,
                'nbf' => $notbefore_claim,
                'exp' => $expire_claim,
                "data" => array(
                    "username" => "admin",
                    "password" => "admin"
                )
            ];
            http_response_code(200);
            $jwt = JWT::encode($payload, $key, 'HS256');
            return $jwt;
    }


    function verify_jwt_token($jwt){        
            
        $secret_key = "abc123@";
        try {
            $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
                if($decoded){
                    http_response_code(200);
                    echo json_encode(array(
                        "message" => "granted:"
                    ));
                }
        }catch (Exception $e){
            http_response_code(401);
            echo json_encode(array(
                "error" => $e->getMessage()
            ));
        }
    }

    function getHeader(){

        $authHeader = getallheaders();
        $arr = explode(" ", $authHeader['Authorization']);
        $jwt = $arr[1];
        
        if($jwt){
            return $jwt;
        }else{
            http_response_code(401);
            exit(); 
        }        
        
    
    }
}
?>
