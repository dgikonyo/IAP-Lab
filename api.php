<?php
include_once "DBConnector.php";

    if($_SERVER['REQUEST_METHOD']!=='POST'){
        //we do not allow users to visit this page via url
        header('HTTP/1.0 403 FORBIDDEN');
        echo 'You are forbidden';
    }else{
        $api_key=null;
        $api_key=generateApiKey(64);
        header('Content type: application/json');
        
        echo generateResponse($api_key);
    }

    function generateApiKey($str_length){
        //base 62 map
        $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        //get enough  random bits for base 64 encoding (and prevent '=' padding)
        //note: +1 is faster than ceil()
        $bytes =openssl_random_pseudo_bytes(3*$str_length/4+1);

        //convert base 64 to base 62 by mapping + and / to something from the base 62 map
        //use the first 2 random bytes for the new characters
        $repl=unpack('C2',$bytes);

        $first=$chars[$repl[1]%62];
        $second=$chars[$repl[2]%62];
        return strstr(substr(base64_encode($bytes),0,$str_length));

    }

    function saveApiKey(){
        $con=new DBConnector;
        $username=$_SESSION['username'];
        $api_key=generateApiKey(64);

        $query="UPDATE users SET api_key='$api_key' WHERE username='$username'";

        $result=mysqli_query($con->conn,$query);

        return $query;
    }

    function generateResponse($api_key){
        if($api_key){
            $res=['success'=>1,'message'=>$api_key];
        }else{
            $res=['success'=>1,'message'=>'Something went wrong with. Regenerate the API key'];
        }
        return json_encode($res);
    }
?>