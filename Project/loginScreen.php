<?php include('navBar.php');
//if the form has been submitted
if (isset($_POST['submitted'])){
  //get the information out of get or post depending on your form
  $username = $_POST['username'];
  $password = $_POST['password'];
  //mail ('akashparmar1996@gmail.com', 'login', 'you have logged in');

  //connect to the database
  $db = new PDO("mysql:dbname=fyp;host=localhost", "root", "");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  //sanitise the inputs!
  $safe_username = $db->quote($username);

  //run a query to get the user associated with that username
  $query = "select * from customer where username = $safe_username";

  $result = $db->query($query);

  $firstrow = $result->fetch();

  if (!empty($firstrow)) {

    $hashed_password = md5($password);

    if ($firstrow['password'] == $hashed_password) {
      session_start();
      $_SESSION['id'] = $firstrow['customer_id'];
      $_SESSION['username'] = $firstrow['username'];
      $_SESSION['firstname'] = $firstrow['firstname'];
      $_SESSION['lastname'] = $firstrow['lastname'];
      $_SESSION['admin'] = $firstrow['admin'];

      header("Location: welcomeScreen.php");

    } else {

      echo "Incorrect Username or Password";
    }
  }
  echo "Incorrect Username or Password";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
  <script src="js/form-validation.js"></script>

</head>
<body>

  <div class="container">
    <div name ="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" >
      <div class="panel panel-primary" >
        <div class="panel-heading">
          <div class="panel-title">Login</div>
        </div>

        <div style="padding-top:30px" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

          <form  method="post" id="formValidation" name ="loginform"  class="form-horizontal" role="form">

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input  id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">
            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input  id="login-password" type="password" class="form-control" name="password" placeholder="Password">
            </div>



            <div style="margin-top:10px" class="form-group">
              <!-- Button -->

              <div class="col-sm-12 controls">
                <input type="submit" id="btn-login" name="submit" value="Login" class="btn btn-success"></a>
                <input type="hidden" name="submitted" value="TRUE" />
              </div>
            </div>


            <div class="form-group">
              <div class="col-md-12 control">
                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                  Don't have an account!
                  <a href="register.php">
                    Sign Up Here
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

</body>
</head>
