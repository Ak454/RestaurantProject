<?php
// include database configuration file
include 'dbConfig.php';
include('navBar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menu</title>
  <meta charset="utf-8">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
  .container{padding: 20px;}
  .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
  .thumbnail {
    height: 125px;  }
  </style>
</head>
<body>
  <div class="container">
    <h1>Menu</h1>
    <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>
    <div id="menu" class="">

      <!-- View the starters -->
      <h2>Starters</h2>
      <?php
      //get rows query
      $query = $db->query("SELECT * FROM menuitem WHERE course = 'Starter' ORDER BY menuItemId");

      // Loop through rows of the table
      if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
          ?>
          <div class="item col-lg-5
">
            <!-- <div class="item col-lg-4"> -->
            <div class="thumbnail">
              <div class="caption">
                <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                <div class="row">
                  <div class="col-md-6">
                    <p class="lead"><?php echo '£'.$row["price"].' GBP'; ?></p>
                  </div>
                  <div class="col-md-6">
                    <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["menuItemId"]; ?>">Add to cart</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } }else{ ?>
        <?php } ?>
      </div>
    </div>

    <div class="container">
      <div id="menu" class="">

        <!-- View the Mains -->
        <h2>Main</h2>
        <?php
        //get rows query
        $query = $db->query("SELECT * FROM menuitem WHERE course = 'Main' ORDER BY menuItemId");
        if($query->num_rows > 0){
          while($row = $query->fetch_assoc()){
            ?>
            <div class="item col-lg-5">
              <div class="thumbnail">
                <div class="caption">
                  <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                  <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                  <div class="row">
                    <div class="col-md-6">
                      <p class="lead"><?php echo '£'.$row["price"].' GBP'; ?></p>
                    </div>
                    <div class="col-md-6">
                      <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["menuItemId"]; ?>">Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } }else{ ?>
          <?php } ?>
        </div>
      </div>

      <div class="container">
        <div id="menu" class="">

          <!-- View the Desserts -->

          <h2>Dessert</h2>
          <?php
          //get rows query
          $query = $db->query("SELECT * FROM menuitem WHERE course = 'Dessert' ORDER BY menuItemId");
          if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
              ?>
              <div class="item col-lg-5">
                <div class="thumbnail">
                  <div class="caption">
                    <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                    <div class="row">
                      <div class="col-md-6">
                        <p class="lead"><?php echo '£'.$row["price"].' GBP'; ?></p>
                      </div>
                      <div class="col-md-6">
                        <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["menuItemId"]; ?>">Add to cart</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } }else{ ?>
            <?php } ?>
          </div>
        </div>


        <div class="container">
          <div id="menu" class="">

            <!-- View the Drinks -->
            <h2>Drinks</h2>
            <?php
            //get rows query
            $query = $db->query("SELECT * FROM menuitem WHERE course = 'Drink' ORDER BY menuItemId");
            if($query->num_rows > 0){
              while($row = $query->fetch_assoc()){
                ?>
                <div class="item col-lg-5">
                  <div class="thumbnail">
                    <div class="caption">
                      <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                      <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                      <div class="row">
                        <div class="col-md-6">
                          <p class="lead"><?php echo '£'.$row["price"].' GBP'; ?></p>
                        </div>
                        <div class="col-md-6">
                          <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["menuItemId"]; ?>">Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } }else{ ?>
              <?php } ?>
            </div>
          </div>


    </body>
    </html>
