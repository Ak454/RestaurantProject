<?php
include 'navBar.php';
include 'dbConfig.php';

if ($_SESSION['admin'] != 1 ){
  header("Location: index.php");
}

$query = $db->query("SELECT * FROM `menuItem`");


if (isset($_POST['submitted1'])){

  $itemId = $_POST['menuItemId'];
  echo $itemId;

  $query2= "DELETE FROM menuitem WHERE menuItemId = $itemId";

  mysqli_query($db, $query2);
  header("Refresh:0");
  echo "Works!";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Menu</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
  

  <!-- Script to set up dataTable -->
  <script>
  $(document).ready(function() {
    $('#customerTable').DataTable();
  } );
  </script>

  <style>
  .container{padding: 50px;}
  input[type="number"]{width: 10%;}
  #adminStatus {min-height: 35px;
    width: 200px;}
    </style>

  </head>
  <body>
    <h1>Edit Menu</h1>

    <div class="container">

      <table id="customerTable" class="table">
        <thead>
          <tr>
            <th>Menu Item</th>
            <th>Description</th>
            <th>Course</th>
            <th>Price</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <tr>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["description"]; ?></td>
                <td><?php echo $row["Course"]; ?></td>
                <td><?php echo $row["price"]; ?></td>
                <!-- Edit Item Button -->
                <td>
                  <form action = "editItem.php" method = "post">
                    <input type="hidden" name="menuItemId" value=<?php echo $row["menuItemId"]; ?>>
                    <input type="hidden" name="idSubmitted" value=<?php echo $row["menuItemId"]; ?>>
                    <input type="submit" name="submit" value="Edit" class="btn btn-primary" <i class="glyphicon glyphicon-menu-right"></i></p>
                  </form>
                </td>

                <!-- Delete Item Form -->
                <form action = "editMenu.php" method ="post">
                  <td>
                    <div class="button">
                      <button type= "submit" name="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="glyphicon glyphicon-trash"></i>
                      </button>
                    </div>
                    <input type="hidden" name="menuItemId" value=<?php echo $row['menuItemId']; ?>>
                    <input type="hidden" name="submitted1" value="TRUE" />
                  </td>
                </form>
              </tr>
              <?php
            } }else{ ?>
              <p>No Orders found.....</p>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back</a></td>
              <td><a href="addItem.php" class="btn btn-success orderBtn">Add Menu Item <i class="glyphicon glyphicon-plus"></i></a></td>
              <td colspan="4"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </body>
    </html>
