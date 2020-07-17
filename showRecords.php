<?php
    include_once "DBConnector.php";
    include "User.php";

    $userRecords=new User("","","","");
    $readResult=$userRecords->readAll();

    $showRecordsConnection=new DBConnector;
?>
<html>
    <head>
        <title>Records from Database</title>
        <link rel="stylesheet"href="marembesho.css"/>
    </head>
    <body>
        <table class="r">
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User City</th>
            </tr>
                <?php
                    if(!$showRecordsConnection){
                        echo "No Connection";
                    }else{
                        echo "Successful";
                    }

                    while($rowResult=mysqli_fetch_assoc($readResult)){
                        echo "<tr>";
                        echo "<td>".$rowResult["id"]."</td>";
                        echo "<td>".$rowResult["first_name"]."</td>";
                        echo "<td>".$rowResult["last_name"]."</td>";
                        echo "<td>".$rowResult["user_city"]."</td>";
                        echo "</tr>";
                    }

                    $readResult->free_result();
                ?>
                       
        </table>
    </body>
</html>