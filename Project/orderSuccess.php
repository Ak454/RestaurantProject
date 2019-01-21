<?php
include('navBar.php');
if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<div class="container">
    <h1>Order Success</h1>
    <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?></p>
    <p>Your Food will be ready soon, You can view that status of your orders  <a href="viewOrders.php">HERE!</a></p>
</div>
</body>
</html>
