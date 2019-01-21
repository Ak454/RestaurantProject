<?php
include 'navBar.php';
include 'dbConfig.php';

if (! isset($_SESSION['id'])){
  header("Location: index.php");
}

//Get the orders for the customer_id
$query = $db->query("SELECT * FROM orders WHERE customer_id = " .  $_SESSION['id'] . " AND status != 'Completed'ORDER BY status DESC");
$query1 = $db->query("SELECT * FROM orders WHERE customer_id = " . $_SESSION['id'] . " AND status = 'Completed' ORDER BY status DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Orders</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

  <!-- Script to set up dataTable -->
  <script>
  $(document).ready(function() {
    $('#viewOrdersTable').DataTable();
    $('#viewOrdersTable1').DataTable();
  } );
</script>

<style>
.container{padding: 50px;}
input[type="number"]{width: 20%;}
</style>
</head>
<body>
  <br>
  <h1>Orders</h1>

  <!-- Tab Manager  -->
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#currentOrders">Current Orders</a></li>
      <li><a data-toggle="tab" href="#previousOrders">Completed Orders</a></li>
    </ul>


    <div class="tab-content">
      <div id="currentOrders" class="tab-pane fade in active">
        <div class="container">

          <table id="viewOrdersTable"  class="table">
            <thead>
              <tr>
                <th>Order Num</th>
                <th>Price</th>
                <th>Date and Time Ordered</th>
                <th>Status</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              <?php
              //Loop through table to get all of the orders that the customer has done
              if($query->num_rows > 0){
                $orderArray;
                $i = 0;
                while($row = $query->fetch_assoc()){
                  $orderArray[$i] = $row["order_id"];
                  ?>
                  <tr>
                    <td><?php echo $orderArray[$i]; ?></td>
                    <td><?php echo '£' . $row["total_price"]; ?></td>
                    <td><?php echo $row["created"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td>
                      <form action = "orderDetails.php" method = "post">
                        <input type="hidden" name="orderid" value=<?php echo $orderArray[$i]; ?>>
                        <!-- <a href="orderDetails.php" class="btn btn-primary">View Order Details<i class="glyphicon glyphicon-menu-right"></i></a> -->
                        <input type="submit" name="submit" value="View Order Details" class="btn btn-primary" <i class="glyphicon glyphicon-menu-right"></i></p>
                      </form>
                    </td>
                  </tr>
                  <?php
                  $i++;
                } }else{ ?>
                  <p>No Orders found.....</p>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back</a></td>
                  <td colspan="4"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <!-- Previous Orders Tab -->
        <div id="previousOrders" class="tab-pane fade">
          <div class="container">
            <table id="viewOrdersTable1"  class="table">
              <thead>
                <tr>
                  <th>Order Num</th>
                  <th>Price</th>
                  <th>Date and Time Ordered</th>
                  <th>Status</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //Loop through table to get all of the orders that the customer has done
                if($query1->num_rows > 0){
                  $orderArray;
                  $i = 0;
                  while($row = $query1->fetch_assoc()){
                    $orderArray[$i] = $row["order_id"];
                    ?>
                    <tr>
                      <td><?php echo $orderArray[$i]; ?></td>
                      <td><?php echo '£' . $row["total_price"]; ?></td>
                      <td><?php echo $row["created"]; ?></td>
                      <td><?php echo $row["status"]; ?></td>
                      <td>
                        <form action = "orderDetails.php" method = "post">
                          <input type="hidden" name="orderid" value=<?php echo $orderArray[$i]; ?>>
                          <!-- <a href="orderDetails.php" class="btn btn-primary">View Order Details<i class="glyphicon glyphicon-menu-right"></i></a> -->
                          <input type="submit" name="submit" value="View Order Details" class="btn btn-primary" <i class="glyphicon glyphicon-menu-right"></i></p>
                        </form>
                      </td>
                    </tr>
                    <?php
                    $i++;
                  } }else{ ?>
                    <p>No Orders found.....</p>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Back</a></td>
                    <td colspan="4"></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </body>
      </html>
