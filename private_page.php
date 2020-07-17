<?php
    session_start();
    if(!isset($_SESSION['username'])){//if the user hasn't logged in, take the back to the login page
        header("Location:login.php");
    }

    

?>
<html>
    <head>
        <title>Homepage </title>
        <script type="text/javascript"src="validate.js"></script>
        <link type="text/css" rel="stylesheet" href="marembesho.css"/>


        <!-- css-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </head>
    <body>
        <p>This is a private page</p>
        <p>We love it and want to protect it</p>
        <p><a href="logout.php"></a>Logout</p>

        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">Generate APi key</button> <br> <br>

        <!---The text area below will hold the APi key-->
        <strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating new key will stop the application from functioning) <br>

        <textarea name="api_key" id="api_key" cols="100" rows="2" readonly> <?php echo fetchUserApiKey(); ?> </textarea>

        <h3>Service Description:</h3>
        We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it

        <hr>

    </body>
</html>