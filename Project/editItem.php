<?php
include 'navBar.php';
include 'dbConfig.php';

if ($_SESSION['admin'] != 1 ){
  header("Location: index.php");
}
if (isset($_POST['idSubmitted'])){
  $menuItemId = $_POST['menuItemId'];
  // echo $menuItemId;

  $query = $db->query("SELECT * FROM menuitem where menuItemId = " . $menuItemId);
  while($row = $query->fetch_assoc()){
    // $menuItemId = $row['menuItemId']
    $itemName = $row['name'];
    $description = $row['description'];
    $course = $row['Course'];
    $price = $row['price'];
  }
}


if (isset($_POST['submitted'])){

  $menuItemId = $_POST['menuItemId'];
  $name = $_POST['menuItem'];
  $description = $_POST['description'];
  $course = $_POST['course'];
  $price = $_POST['price'];


  $query1 = "UPDATE menuitem SET name = '$name', description='$description', Course = '$course', price = '$price' WHERE menuitemId = $menuItemId";

  mysqli_query($db, $query1);

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
</style>

</head>
<body>
  <h1>Edit Menu Item</h1>

  <div class="container">
    <div id="editbox" style="margin-top:50px;" >
      <div class="panel panel-primary" >
        <div class="panel-heading">
          <div class="panel-title">Edit Menu Item</div>
        </div>

        <div style="padding-top:30px;" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

          <form method="post" id="formValidation" class="form-horizontal" role="form">
            <div style="margin-bottom: 25px" class="input-group">
              <label for="menuItem" class="">Menu Item </label>
              <input name="menuItem" class="form-control" type="text" id="menuItem" value="<?php echo $itemName;?>">

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="description" class="">Description </label>
              <input  name="description" class="form-control" id="description" type="text" value="<?php echo $description;?>">

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="course" class="">Course </label>
              <input  name="course" class="form-control" id="course" type="text" value="<?php echo $course;?>">

            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <label for="price" class="">Price </label>
              <input  name="price" class="form-control" id="price" type="text" value="<?php echo $price;?>">
            </div>




            <div style="margin-top:10px" class="form-group">
              <!-- Button -->
              <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                <div class="col-sm-12 controls">
                  <input type="submit" id="btn-login" name="submit" value="Edit" class="btn btn-success"></a>
                  <input type="hidden" name="menuItemId" value="<?php echo $menuItemId;?>" />
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
