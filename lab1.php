<?php
include_once "DBConnector.php";
include_once "User.php";

$connection=new DBConnector;

if(isset($_POST['btn-save'])){
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $city=$_POST['city_name'];
  $uName=$_POST['username'];
  $pas=$_POST['password'];
  $utc=$_POST['utc_timestamp'];
  $tmz_offset=$_POST['time_zone_offset'];
  

  //now we create a User object

  $user=new User($first_name,$last_name,$city,$uName,$pas,$utc,$tmz_offset);

  if(!$user->validateForm()){
    $user->createFormErrorSessions();
    header("Refresh:0");
    die();
  }

  $uploads=new FileUploader;

  $res=$user->save();

  $file_upload_response=$uploader->uploadFile();
  

  if(!$res){//will tell us if the result is saved or not
    echo "Data not saved";
  }else{
    echo "Data saved";
  }
  $connection->closeDatabase();
}


?>
<html>
  <head>
    <title>Register Here</title>
    <link type="text/css" rel="stylesheet"href="marembesho.css">
    <script type="text/javascript" src="validate.js"></script>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript"src="timezone.js"></script>

  </head>
  <body>
      <form class="needs-validation" novalidate name="registrationForm"id="user_form" method="post"
        onsubmit="return validateForm()"action="<? $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <div>
          <?php
            session_start();
            if(!empty($_SESSION['form_errors'])){
              echo "".$_SESSION['form_errors'];
              unset($_SESSION['form_errors']);
            }
          ?>
        </div>
        <div class="form-row">
    
          <div class="col-md-4 mb-3">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" id="first_name" placeholder="First name" required>
          </div>

          <div class="col-md-4 mb-3">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" id="last_name" placeholder="Last name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationTooltip03">City</label>
            <input type="text" class="form-control" id="city_name" placeholder="City" required>
            <div class="invalid-tooltip">
              Please provide a valid city.
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="user_name">User Name</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="username">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <input type="hidden" class="form-control" id="utc_timestamp" name="utc_timestamp"value="">
          </div>

          <div class="col-md-4 mb-3">
          <input type="hidden" class="form-control" id="time_zone_offset"name="time_zone_offset" value="">
          </div>



          <div class="col-md-4 mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" required>
          </div>
          <div class="col-md-4 mb-3">
            <button class="btn btn-primary" type="submit" id="btn-save">Submit form</button>
          </div>
        </div>

        <div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="fileToUpload"name="imageFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" id="btn-upload">Submit Image</button>
            </div>
        </div>
      
      </form>
    <form>
      
    <p>Click<a href="login.php">here</a> to continue registration</p>
  </body>
</html>     
       

