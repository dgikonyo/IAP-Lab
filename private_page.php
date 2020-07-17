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

    </head>
    <body>
        <p>This is a private page</p>
        <p>We love it and want to protect it</p>
        <p><a href="logout.php"></a>Logout</p>

    </body>
</html>