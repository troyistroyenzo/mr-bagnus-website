<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="with=device-width, initial-scale=1.0">
	
	<title> Mister Bangus - Cart </title>
	<link rel="stylesheet" href="stylesheet.css">
    
    <!-- Poppins font link from GoogleFonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap4 & Font-Awesome CDN link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
    
</head>
<body>
    <!-------- Header --------->
	<section class="sub-header"> 
        <nav>
            <a href="index.html"><img src="Images/logo.png"></a>
            <div class="navlinks" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="catalog.html">CATALOG</a></li>
					<li><a href="cart.html">CART</a></li>
					<li><a href="review.html">REVIEWS</a></li>
					<li><a href="faq.html">FAQS</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <h1>Mister Bangus Cart</h1>
	</section>
    
    <!-------- Blog --------->
	
	<section class="cart-content">
    <?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
                <table>
                <tbody>
            <tr>
            <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
            <?php		
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                        <tr>
                        <td><?php echo $item["name"]; ?></td>
                        <td><?php echo $item["quantity"]; ?></td>
                        <td><?php echo "Php ".$item["price"]; ?></td>
                        <td><a href="cartcontroller.php?action=remove&code=<?php echo $item["code"]; ?>" class="delbtn">Delete</a></td>
                        </tr>
                        <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["price"]*$item["quantity"]);
                }
                ?>

        <tr>
        <td>Total:</td>
        <td><?php echo $total_quantity; ?></td>
        <td><strong><?php echo "Php ".number_format($total_price, 2); ?></strong></td>
        <td></td>
        </tr>
        </tbody>
        </table>		

        <a href="" class="button" onclick="checkout()">Checkout</a>
        <?php
        } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php 
        }
        ?>
		
        
	</section>

	<!-------- Footer ---------->	
	
	<section class="footer">
			<h4>About Us</h4>
		<p>Mister Bangus is a seafood-selling business rooted in Dagupan City.<br>Part of its earnings are also sent for a cancer patient's treatment.</p>
			<div class="icons">
				<a href="https://www.instagram.com/misterbangusfarmph/">
					<i class="fa fa-instagram"> Mister Bangus</i> </a>
			</div>
			<p>Made with <i class="fa fa-heart-o"></i> by Cahate, Ravacio, Suelto, Urmenita </p>
			<p> © 2021 MISTER BANGUS </p>
		</section>
	
<!-------- JavaScript for Menu Navigation --------->
<script>
    var navLinks = document.getElementById("navLinks");
    
    function showMenu(){
        navLinks.style.right = "0";
    }
    
    function hideMenu(){
        navLinks.style.right = "-200px";
    }

    function checkout(){
        alert("Orders checked out.");
    }

</script>
    
    
    
</body>
</html> 