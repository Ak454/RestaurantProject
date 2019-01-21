<?php
include 'navBar.php';
include 'dbConfig.php';

if ($_SESSION['admin'] != 1 ){
  header("Location: index.php");
}

$query = $db->query("SELECT customer.customer_id, customer.username, customer.firstname, customer.lastname, orders.order_id, orders.total_price, orders.status
  FROM customer, orders
  WHERE customer.customer_id = orders.customer_id
  AND orders.status != 'Completed'");

$query1 = $db->query("SELECT customer.customer_id, customer.username, customer.firstname, customer.lastname, orders.order_id, orders.total_price, orders.status
    FROM customer, orders
    WHERE customer.customer_id = orders.customer_id
    AND orders.status = 'Completed'");



    if (isset($_POST['submitted'])){


      $statusValue = $_POST['statusValue'];
      $orderid = $_POST['orderid'];

      $query2 = "UPDATE orders SET status = '$statusValue' WHERE order_id = $orderid";
      mysqli_query($db, $query2);

      header("Refresh:0");
    }
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
        $('#ordersTable').DataTable();
        $('#ordersTable1').DataTable();
      } );
      </script>

      <style>
      .container{padding: 50px;}
      input[type="number"]{width: 10%;}
      #selStatus {min-height: 35px;
        width: 200px;}
        </style>

      </head>
      <body>
<h1>Customer Orders</h1>

        <!-- Tab Manager  -->
        <div class="container">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#currentOrders">Current Orders</a></li>
            <li><a data-toggle="tab" href="#previousOrders">Completed Orders</a></li>
          </ul>


          <div class="tab-content">
            <div id="currentOrders" class="tab-pane fade in active">

              <div class="container">

                <table id="ordersTable" class="table">
                  <thead>
                    <tr>
                      <th>Customer ID</th>
                      <th>Username</th>
                      <th>Firstname</th>
                      <th>Surname</th>
                      <th>Order ID</th>
                      <th>Price</th>
                      <th>Current Status</th>
                      <th>Edit Status</th>
                      <th>&nbsp;</th>
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
                          <td><?php echo $row["customer_id"]; ?></td>
                          <td><?php echo $row["username"]; ?></td>
                          <td><?php echo $row["firstname"]; ?></td>
                          <td><?php echo $row["lastname"]; ?></td>
                          <td><?php echo $row["order_id"]; ?></td>
                          <td><?php echo "£" . $row["total_price"]; ?></td>
                          <td><?php echo $row["status"]; ?></td>

                          <form action = "customerOrders.php" method = "post">
                            <td>
                              <select name="statusValue" class="form-control"  id="selStatus">
                                <option value="Ready For Collection">Ready For Collection</option>
                                <option value ="Completed">Completed</option>
                              </select>
                            </td>
                            <td>
                              <input type="submit" name="submit" value="Update" class="btn btn-secondary" <i class="glyphicon glyphicon-menu-right"></i></p>
                              <input type="hidden" name="orderid" value=<?php echo $orderArray[$i]; ?>>
                              <input type="hidden" name="submitted" value="TRUE" />
                            </form>
                          </td>
                          <td>
                            <form action = "orderDetails.php" method = "post">
                              <input type="hidden" name="orderid" value=<?php echo $orderArray[$i]; ?>>
                              <input type="submit" name="submit" value="View Order Details" class="btn btn-primary" <i class="glyphicon glyphicon-menu-right"></i></p>
                            </form>
                          </td>
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
              </div>

              <div id="previousOrders" class="tab-pane fade">
                <div class="container">
                  <table id="ordersTable1" class="table">
                    <thead>
                      <tr>
                        <th>Customer ID</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Surname</th>
                        <th>Order ID</th>
                        <th>Price</th>
                        <th>Current Status</th>
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
                            <td><?php echo $row["customer_id"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php echo $row["firstname"]; ?></td>
                            <td><?php echo $row["lastname"]; ?></td>
                            <td><?php echo $row["order_id"]; ?></td>
                            <td><?php echo "£" . $row["total_price"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
                            <td>
                              <form action = "orderDetails.php" method = "post">
                                <input type="hidden" name="orderid" value=<?php echo $orderArray[$i]; ?>>
                                <input type="submit" name="submit" value="View Order Details" class="btn btn-primary" <i class="glyphicon glyphicon-menu-right"></i></p>
                              </form>
                            </td>

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
              </div>
            </div>
          </body>
          </html>
