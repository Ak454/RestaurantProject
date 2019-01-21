<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- <link rel="stylesheet" type="text/css" href="CSS/style.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
  .navbar-nav > li{
    padding-left:10px;
    padding-right:10px;
  }

h1 {
  text-align: center;
}
</style>

</head>

<body>
  <?php if (isset($_SESSION['username']) && $_SESSION['admin'] == false){ ?>
<!-- This shows the navbar for a regular user  -->
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="findUs.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Your Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="viewOrders.php">View Orders</a>
            <a class="dropdown-item" href="editDetails.php">Edit Details</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="viewCart.php">View Cart</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link disabled"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['firstname']; ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
        </li>
      </ul>
    </nav>

<!-- If the user is an admin then show the admin navBar -->
  <?php } elseif (isset($_SESSION['username']) && $_SESSION['admin'] == true) { ?>

    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="findUs.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admin Tools
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="customerOrders.php">View Customer Orders</a>
            <a class="dropdown-item" href="viewCustomers.php">Edit Users</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="editMenu.php">Edit Menu</a>
          </div>
        </li>>
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href=""><span class="glyphicon glyphicon-user"></span> Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
          </li>
        </ul>
      </nav>

      <?php } else { ?>
<!-- If the user is not logged in then show the guest navBar -->
        <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-dark">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="findUs.php">About Us</a>
            </li>
            </ul>
            <ul class="navbar-nav navbar-right">
              <li class="nav-item">
                <a class="nav-link" href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="loginScreen.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
              </li>
            </ul>
          </nav>

    <?php } ?>
<h1>Aston Takeaway</h1>
<h1>Aston Takeaway</h1>
  </body>
  </html>
