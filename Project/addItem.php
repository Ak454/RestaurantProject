<?php
include 'navBar.php';
// include 'dbConfig.php';



if ($_SESSION['admin'] != 1 ){
  header("Location: index.php");
}

$db = new PDO("mysql:dbname=fyp;host=localhost", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['submitted'])){

  $name = $db->quote($_POST['menuItem']);
  $description =  $db->quote($_POST['description']);
  $course = $db->quote($_POST['course']);
  $price =  $db->quote($_POST['price']);

  echo $name;
  echo $description;
  echo $course;
  echo $price;

  $query1 = "INSERT INTO menuitem (menuItemId, name, description, Course, price) VALUES (default, $name, $description, $course, $price)";

  $db->exec($query1);


  header("Location: editMenu.php ");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
  <script  type="text/javascript" src="JS/form-validation.js" ></script>

  <style>
  .container {
    width:90%;
  }
  #sel1 {
    min-height: 35px;
      width: 200px;
  }
</style>

</head>
<body>
  <h1>New Menu Item</h1>

  <div class="container">
    <div id="editbox" style="margin-top:50px;" >
      <div class="panel panel-primary" >
        <div class="panel-heading">
          <div class="panel-title">New Menu Item</div>
        </div>

        <div style="padding-top:30px;" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

          <form method="post" id="formValidation" class="form-horizontal" role="form">
            <div style="margin-bottom: 25px" class="input-group">
              <label for="Menu Item" class="">Menu Item </label>
              <input name="menuItem" class="form-control" type="text" value="">

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="description" class="">Description </label>
              <input  name="description" class="form-control" id="description" type="text" value="">

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="course">Course</label>
              <br>
        <select class="form-control" id="sel1" name="course">
                <option value="Starter">Starter</option>
                <option value="Main">Main</option>
                <option value="Dessert">Dessert</option>
                <option value="Drink">Drink</option>
              </select>

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="price" class="">Price </label>
              <input  name="price" class="form-control" id="price" type="text" value="">
            </div>




            <div style="margin-top:10px" class="form-group">
              <!-- Button -->
              <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                <div class="col-sm-12 controls">
                  <input type="submit" id="btn-login" name="submit" value="Add" class="btn btn-success"></a>
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
