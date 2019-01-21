<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

// include database configuration file
include 'dbConfig.php';

//When the user clicks add to cart button
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // get product details
        $query = $db->query("SELECT * FROM menuitem WHERE menuItemId = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['menuItemId'],
            'name' => $row['name'],
            'price' => $row['price'],
            'qty' => 1
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'viewCart.php':'index.php';
        // header("Location: menu.php");
        header("Location: ".$redirectLoc);

//Adding multiple items to the cart from view orders screen
      }elseif($_REQUEST['action'] == 'addItemsToCart' && !empty($_REQUEST['id'])){
        $orderid = $_REQUEST['id'];
        $query = $db->query("SELECT * FROM order_items where order_items.order_id = ". $_REQUEST['id']);

        if($query->num_rows > 0){
          while($row = $query->fetch_assoc()){
            $productID = $row['menuItemId'];

            $query1 = $db->query("SELECT * FROM menuitem WHERE menuItemId = ".$productID);
              $row1 = $query1->fetch_assoc();
              $itemData = array(
                  'id' => $row1['menuItemId'],
                  'name' => $row1['name'],
                  'price' => $row1['price'],
                  'qty' => $row['quantity']
                    );

                    $insertItem = $cart->insert($itemData);
          }
        }

        header("Location: viewCart.php");

//Updates the cart with quantity of items or removing items from the cart.
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['id']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");

        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, menuItemId, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
