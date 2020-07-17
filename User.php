<?php
    include_once "DBConnector.php";
    include "Crud.php";
    include "Authenticator.php";
    include_once "fileUploader.php";


    class User implements Crud,Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;
        
        private $username;
        private $password;
         



        //use the class constructor to initialize the values, the ember variables are private so they cant be instantiated anywhere else
        function __construct($first_name,$last_name,$city_name,$username,$password,$image){//here we are initializing our values that cant be instantiated anywhere because they are private.
            $this->first_name=$first_name;
            $this->last_name=$last_name;
            $this->city_name=$city_name;
            $this->username=$username;
            $this->password=$password;

        }

        public static function create(){//this method fakes a constructor since we cant have multiple constructors,so we fake the creation of an object using the method create()
            $instance=new self();
            return $instance;//will return the object of the class without necessarily using its constructor
        }

        public function setUsername($username){//sets username
            $this->username=$username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setPassword($password){
            $this->password=$password;
        }

        public function getPassword(){//gets password
            return password_hash($this->password);
        }

        public function setUserId($user_id){
            $this->user_id=$user_id;
        }

        public function getUserId(){
            return $this->$user_id;
        }

        public function save(){
            $fn=$this->first_name;
            $ln=$this->last_name;
            $city=$this->city_name;
            $uname=$this->username;

            $this->password=password_hash($this->password,PASSWORD_DEFAULT);
            $pass=$this->password;

            

           /* $connection=new DBConnector();           
            // $connection->$conn=$db;
            $query="INSERT INTO users(first_name,last_name,user_city)
            VALUES(?,?,?)";

            $stmt=$this->$conn->prepare($query);
            $stmt->bind_param("sss",$fn,$ln,$city);
            $stmt->execute();*/

            $con=new DBConnector;

            if($this->isUserExist()){
                echo "<script>alert('Your username is taken')</script>";
            }else{
                $res=mysqli_query($con->conn,"INSERT INTO users(first_name,last_name,user_city,username,password)
                VALUES('$fn', '$ln', '$city','$uname','$pass')") or die("Big error :" .mysql_error());

                return $res;    
            }

            
            
            


            $con->closeDatabase();

        }

        public function readAll(){

            $con=new DBConnector;
            $readQuery="SELECT * FROM users";

            $readResult=mysqli_query($con->conn,$readQuery);
            return $readResult;
        }

        public function readUnique(){
            return null;
        }
        public function search(){
            return null;
        }
        public function update(){
            return null;

        }
        public function removeOne(){
            return null;

        }
        public function removeAll(){
            return null;

        }

        public function validateForm(){

            //will return true if values are not empty
            $fn=$this->first_name;
            $ln=$this->last_name;
            $city=$this->city_name;

            if($fn==""||$ln==""||$city==""){
                return false;
            }
            return true;
        }

        public function createFormErrorSessions(){
            session_start();//starts a session
            $_SESSION['form_errors']="All fields are required";
        }

        public function isPasswordCorrect(){
            $con=new DBConnector;
            $found=false;
            $res=mysqli_query($con->conn,"SELECT * FROM user")or die("Error:".mysqli_error());

            while($row=mysqli_fetch_array($res)){
                if(password_verify($this->getPassword(),$row['password'])&& $this->getUsername()==$row['username']){
                    $found=true;
                }
                
            }
            $con->closeDatabase();
            return $found;
        }

        public function login(){
            if($this->isPasswordCorrect()){
                //if the password is correct, we load the protected page
                header("Location:private_page.php");
            }
        }

        public function createUserSession(){//creates a new session
            session_start();//starts a session
            $_SESSION['username']=$this->getUsername();
        }

        public function logout(){
            session_start();
            unset($_SESSION['username']);//will destroy this session
            session_destroy();
            header("Location:lab1.php");
        }

        public function isUserExist(){

            $con=new DBConnector;
            $query=mysqli_query($con->conn,"SELECT username FROM users")or die("Error:".mysqli_error());

            $nameFound=false;


            while($row=mysqli_fetch_array($con)){

                if($this->getUsername()==$row['username']){
                    echo "Username exists";
                    $nameFound=false;
                }

            }
            $con->closeDatabase();
            return $nameFound;

        }

        

        
    }
?>