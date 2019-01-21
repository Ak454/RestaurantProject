<?php
include 'navBar.php';
include 'dbConfig.php';

$orderid = $_POST['orderid'];

$query = $db->query("SELECT order_items.orderitems_id, orders.order_id, order_items.menuItemId,menuitem.name, order_items.quantity, menuitem.price
  FROM order_items, orders, menuitem
  WHERE order_items.order_id = orders.order_id
  AND order_items.menuItemId = menuitem.menuItemId
  AND order_items.order_id = $orderid");

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Order Details</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{width: 100%;padding: 50px;}
    .table{width: 65%;float: left;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
  </head>

  <body>
    <div class="container">
      <h1>Order Details</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <tr>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo '£'.$row["price"]; ?></td>
                <td><?php echo $row["quantity"]; ?></td>
                <td><?php echo '£' . $row["price"] * $row["quantity"]; ?></td>
              </tr>
              <?php
            } }else{ ?>
              <p>No Orders found.....</p>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
            </tr>
          </tfoot>
        </table>

        <div class="footBtn">
          <?php
          if ($_SESSION['admin'] == true) { ?>
            <a href="customerOrders.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> View Customer Orders</a>
          <?php  } else { ?>
            <a href="viewOrders.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> View Other Orders</a>
            <td colspan="2"></td>
            <a class="btn btn-success orderBtn" href="cartAction.php?action=addItemsToCart&id=<?php echo $orderid; ?>">Add to cart <i class="glyphicon glyphicon-shopping-cart"></i></a>
          <?php  } ?>
        </div>
      </div>
    </body>
    </html>
