<?php include('navBar.php');

//session_start();
//if the form has been submitted
if (isset($_POST['submitted'])){
  //create a database connection
  $db = new PDO("mysql:dbname=fyp;host=localhost", "root", "");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //get and sanitise the inputs, we don't need to do this with the password as we hash it anyway
  $safe_username = $db->quote($_POST['username']);
  $safe_firstname = $db->quote($_POST['firstname']);
  $safe_lastname = $db->quote($_POST['lastname']);
  $safe_email = $db->quote($_POST['email']);
  $hashed_password = md5($_POST['password']);


  //insert the entry into the database
  $query = "insert into customer values (default, $safe_username, '$hashed_password', $safe_firstname, $safe_lastname, $safe_email, '0')";

  $db->exec($query);

  //get the ID
  $id = $db->lastInsertId();

  //Output success or the errors
  echo "Congratulations! You are now registered. Your ID is: $id";

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
    <div id="signupbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title">Sign Up</div>
        </div>

        <div class="panel-body" >
          <form id="formValidation" name = "loginform" class="form-horizontal" role="form" action="register.php" method = "post">

            <div id="signupalert" style="display:none" class="alert alert-danger">
              <p>Error:</p>
              <span></span>
            </div>

            <div class="form-group">
              <label for="username" class="col-md-3 control-label">Username</label>
              <div class="col-md-9">
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-md-3 control-label">Password</label>
              <div class="col-md-9">
                <input required type="password" class="form-control" name="password" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-md-3 control-label">Email</label>
              <div class="col-md-9">
                <input required type="text" class="form-control" name="email" placeholder="Email Address">
              </div>
            </div>

            <div class="form-group">
              <label for="firstname" class="col-md-3 control-label">First Name</label>
              <div class="col-md-9">
                <input required type="text" class="form-control" name="firstname" placeholder="First Name">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-md-3 control-label">Last Name</label>
              <div class="col-md-9">
                <input required type="text" class="form-control" name="lastname" placeholder="Last Name">
              </div>
            </div>


            <div class="form-group">
              <!-- Button -->
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="submitted" value="TRUE" />
                <button id="btn-signup" type="submit" value = "Submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
                <!-- <span style="margin-left:8px;">or</span> -->
              </div>
            </div>



              <div class="form-group">
                <div class="col-md-12 control">
                  <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                    Already have an Account!
                    <a href="loginScreen.php">
                      Login Here
                    </a>
                  </div>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </body>
  </html>
