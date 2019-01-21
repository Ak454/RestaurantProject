<?php
include 'navBar.php';
include 'dbConfig.php';

if (! isset($_SESSION['id'])){
  header("Location: index.php");
}


$customer_id = $_SESSION['id'];
//Get user Details from database
$query = $db->query("SELECT * FROM customer where customer_id = " . $customer_id);
while($row = $query->fetch_assoc()){

  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $username = $row['username'];
}


if (isset($_POST['submitted'])){

  $username = $_POST['username'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $hashed_password = md5($_POST['password']);

  $query1 = "UPDATE customer SET username = '$username', password='$hashed_password', firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE customer_id = $customer_id;";

  mysqli_query($db, $query1);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/custom-script.js"></script>

  <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

  <script src="js/form-validation.js"></script>


</head>
<body>
  <section id="content">
    <div id="breadcrumbs-wrapper">
      <div class="container">
        <div class="row">
          <div class="col s12 m12 l12">
            <h2 class="breadcrumbs-title">User Details</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div id="editbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" >
        <div class="panel panel-primary" >
          <div class="panel-heading">
            <div class="panel-title">Edit Details</div>
          </div>

          <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

            <form method="post" id="formValidation" class="form-horizontal" role="form">
              <div style="margin-bottom: 25px" class="input-group">
                <label for="username" class="">Username </label>
                <input name="username" class="form-control" type="text" value="<?php echo $username;?>">

              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <label for="firstname" class="">Firstname </label>
                <input  name="firstname" class="form-control" id="firstname" type="text" value="<?php echo $firstname;?>">

              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <label for="lastname" class="">Lastname </label>
                <input  name="lastname" class="form-control" id="lastname" type="text" value="<?php echo $lastname;?>">

              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <label for="email" class="">Email </label>
                <input  name="email" class="form-control" id="email" type="text" value="<?php echo $email;?>">

              </div>

              <div style="margin-bottom: 25px" class="input-group">
                <label for="password" class="">Password </label>
                <input  name="password" class="form-control" id="password" type="password" value="">

              </div>



              <div style="margin-top:10px" class="form-group">
                <!-- Button -->
                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                  <div class="col-sm-12 controls">
                    <input type="submit" id="btn-login" name="submit" value="Edit" class="btn btn-success"></a>
                    <input type="hidden" name="submitted" value="TRUE" />
                  </div>
                </div>

              </form>

            </div>

          </div>
        </div>
      </div>
    </div>
  </body>
  </html>

  <?php  ?>
