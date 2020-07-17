<?php
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','btc3205');
    define('PORT','3306');
    define('CHARSET','utf8mb4');

  
    

  class DBConnector{

    public $conn;
    function __construct(){

    /*
    
    $DB_SERVER='localhost';
    $DB_USER='root';
    $DB_PASS='';
    $DB_NAME='btc3205';
    $PORT='3306';
    $CHARSET='utf8mb4';

        $options=[
            PDO::ATTR_ERRMODE              =>PDO::ERRMODE_EXCEPTION,//tells PDO to throw exception everytime a query fails
            PDO::ATTR_DEFAULT_FETCH_MODE   =>PDO::FETCH_ASSOC,//
            PDO::ATTR_EMULATE_PREPARES     =>false,//tells PDO whether to use an emulation mode or not.
        ];

        $dsn="mysql:host=$DB_SERVER;dbname=$DB_NAME;charset=$CHARSET;port=$PORT";

        try{
            $conn =new PDO($dsn,$DB_USER,$DB_PASS,$options);
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(),(int)$e->getCode());
        }
        
        */
        

      $this->conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Error:".mysqli_error());
      //if the connection is unsuccessful, there will be an error message
        mysqli_select_db($this->conn,DB_NAME);

    }
  
    public function closeDatabase(){
     $this->conn->close();
    }

  }


?>
