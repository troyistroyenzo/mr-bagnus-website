<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE product_id='" . $_GET["code"] . "'");

        if(!empty($productByCode[0]["product_id"])) {
            $db_handle->addToCart(1,$productByCode[0]["product_id"],1);
        }
            
			$itemArray = array($productByCode[0]["product_id"]=>array('code'=>$productByCode[0]["product_id"],'name'=>$productByCode[0]["prod_name"], 'quantity'=>1, 'price'=>$productByCode[0]["prod_price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["product_id"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["product_id"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += 1;
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}

            header("Location: cart.php");
            exit();
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}

        header("Location: cart.php");
            exit();
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>