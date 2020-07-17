<?php   
    include_once "DBConnector.php";
    include_once "User.php";

    $con=new DBConnector;

    if(isset($_POST['btn-login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $instance=User::create();//creates an object of the User class
        $instance->setPassword($password);
        $instance->setUsername($username);

        if($instance->isPasswordCorrect()){
            $instance->login();

            $con->closeDatabase();

            $instance->createUserSession();//creates a session
        }else{
            $con->closeDatabase();
            header("Location:login.php");
        }
    }

?>
<html>
    <head>
        <title>Login Page</title>
        <script type="text/javascript"src="validate.js"></script>
        <link rel="stylesheet"type="text/css" href="marembesho.css">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                  <!--PHP_SELF means we are submitting the for to 'itself' for processing-->
                <form method="post"name="login"action="<?=$_SERVER['PHP_SELF']?>">
                    <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
                    <input type="submit" class="fadeIn fourth" value="Log In" name="btn-login">
                </form>

                <!-- Remind Passowrd 
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                </div>-->

            </div>
        </div>
        
    </body>
</html>