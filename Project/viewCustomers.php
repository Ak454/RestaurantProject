<?php
include 'navBar.php';
include 'dbConfig.php';

if ($_SESSION['admin'] != 1 ){
  header("Location: index.php");
}

$query = $db->query("SELECT * FROM `customer` WHERE customer_id != '" . $_SESSION['id'] . "'");


if (isset($_POST['submitted'])){

  $adminStatus = $_POST['admin'];
  $customerid = $_POST['customerid'];


  $query1= "UPDATE customer SET admin = $adminStatus WHERE customer_id = $customerid";
  mysqli_query($db, $query1);

  header("Refresh:0");
}

if (isset($_POST['submitted1'])){

  $customerid = $_POST['customerid'];
  echo $customerid;

  $query2= "DELETE FROM customer WHERE customer_id = $customerid";

  mysqli_query($db, $query2);
  header("Refresh:0");
  echo "Works!";

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Customers</title>
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
    <h1>Customer Details</h1>

    <div class="container">

      <table id="customerTable" class="table">
        <thead>
          <tr>
            <th>Customer ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Admin</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //Loop through table to get all of the orders that the customer has done
          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <tr>
                <td><?php echo $row["customer_id"]; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["firstname"]; ?></td>
                <td><?php echo $row["lastname"]; ?></td>
                <td><?php echo $row["email"]; ?></td>


                <form action = "viewCustomers.php" method = "post">
                  <td>
                    <select name= "admin" class="form-control" id="adminStatus" >
                      <option value="1" <?php echo ($row['admin'] ? 'selected' : ''); ?>>Admin</option>
                      <option value="0" <?php echo (!$row['admin'] ? 'selected' : ''); ?>>Customer</option>
                    </select>
                  </td>
                  <td>
                    <input type="submit" name="submit" value="Update" class="btn btn-secondary" <i class="glyphicon glyphicon-menu-right"></i></p>
                    <input type="hidden" name="customerid" value=<?php echo $row['customer_id']; ?>>
                    <input type="hidden" name="submitted" value="TRUE" />
                  </form>
                </td>

                <form action = "viewCustomers.php" method ="post">
                  <td>
                    <div class="button">

                      <button type= "submit" name="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="glyphicon glyphicon-trash"></i>
                      </button>
                    </div>
                    <input type="hidden" name="customerid" value=<?php echo $row['customer_id']; ?>>
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
              <td colspan="9"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </body>
    </html>
