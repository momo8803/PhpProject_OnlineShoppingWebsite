<?php

session_start();
include '../../PHP/Includes/Dbh.inc.php';
$rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `cart`"));
if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET Quantity = '$update_value' WHERE CartID = '$update_id'");
    if($update_quantity_query){
        header('location:cart.php');
    };
};

if(isset($_GET['remove'])){
    $remove_id = $_GET['CartID'];
    mysqli_query($conn, "DELETE FROM cart WHERE CartID = '$remove_id'");
    header('location:Cart.php');
};

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart`");
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PAPAYA CA | Online Clothing Company</title>
        <link rel="icon" type="image/x-icon" href="../../images/logo.png">
        <link href="../../CSS/header.css" rel="stylesheet"/>
        <link href="../../CSS/footer.css" rel="stylesheet"/>
        <link href="../../CSS/index.css" rel="stylesheet"/>
        <link href="../../CSS/Cart.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <header>
            <a href="../index.php">
        	<img src="../../images/logo.png" class="logo" alt="Papaya logo" />
            </a>
        	<nav class="features">
        		<ul>
        			<?php 
        			 if(!isset($_SESSION["client_id"]))
        			 {
        			?>
        			<li><a href="../login.php"><img src="../../images/user.png" alt="Login"/></a></li>
        			<?php 
        			 }
        			 else
        			 {
        			?>
        			<li><a href="../../PHP/Includes/logout.inc.php"><img src="../../images/logout.png" alt="Login"/></a></li>
                    <li><?php                          
                         $name=$_SESSION["name"];
                         echo "Welcome $name ";
                    ?>
                    </li>
                    <?php }?>
        			<li><a href="Cart.php"><img src="../../images/addToCart.png" alt="Add To Cart"/></a><?php echo "$rows"?></li>
        			<li><a href="wishlist.php"><img src="../../images/wishlist.png" alt="Wishlist"/></a></li>
					<form action="result.php" method = "get">
					<li><input type="image" src="../../images/search.png" alt="Search" value="Submit" class="searchimg" name="submit"/></li>
              		<li><input type="text" placeholder="Search for product..." name="key" class="searchText"/></li>
              		</form>
        		</ul>
        	</nav>
        	<nav class="category">
        		<ul>
        			<li><a href="../men/men.php">MEN</a></li>
        			<li><a href="../women/women.php">WOMEN</a></li>
        			<li><a href="../kids/kids.php">KIDS</a></li>
        			<li><a href="../about.php">ABOUT US</a></li>
        		</ul>
        	</nav>
        </header>

		<div class="cart-container">
    		<div class="shopping-cart">
    
           		<h1>shopping cart</h1><br/>
        
           		<table>
        
                      <thead>
                         <th></th>
                         <th>Name</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total price</th>
                         <th></th>
                      </thead>
                
                      <tbody>
                
                         <?php 
                         
                         $select_cart = mysqli_query($conn, "SELECT * FROM cart c, products p WHERE p.ProductId=c.ProductId");
                         $grand_total = 0;
                         if(mysqli_num_rows($select_cart) > 0){
                            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                         ?>
                
                         <tr>
                            <td><img src="<?php echo $fetch_cart['Img'] ?>" alt="Image"></td>
                            <td class ="title"><?php echo $fetch_cart['ProductName']; ?></td>
                            <td>$<?php echo number_format($fetch_cart['Price']); ?></td>
                            <td>
                               <form action="" method="post" class="cartForm">
                                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['CartID']; ?>" >
                                  <input type="number" class="quantity" name="update_quantity" min="1"  value="<?php echo $fetch_cart['Quantity']; ?>" >
                                  <input type="submit" value="update" name="update_update_btn">
                               </form>   
                            </td>
                            <td>$<?php echo $sub_total = number_format($fetch_cart['Price'] * $fetch_cart['Quantity']); ?></td>
                            <td><a href="cart.php?remove&CartID=<?php echo $fetch_cart['CartID']; ?>" class="delete-btn"> remove</a></td>
                         </tr>
                         <?php
                           $grand_total += $sub_total;  
                            };
                         };
                         ?>
                         <tr class="table-bottom">
<!--                             <td></td> -->
                            <td colspan="4">GRAND TOTAL</td>
                            <td>$<?php echo $grand_total; ?></td>
                            <td><a href="cart.php?delete_all" class="delete-btn"> delete all </a></td>
                         </tr>
                         <tr class="options">
                         	<td></td>
                         	<td></td>
                         	<td></td>
                         	<td></td>
                         	<td><button type="submit"><a href="../index.php">CONTINUE SHOPPING</a></button></td>
                         	<?php  if(mysqli_num_rows($select_cart) > 0){
                         	?>
                         	<td><button type="submit"><a href="payment.php">PROCEED TO CHECKOUT</a></button></td>
                         	<?php } else {?>
                         	<td><button type="submit">PROCEED TO CHECKOUT</button></td>
                         	<?php }?>
                         	
                         </tr>
                         
                
                      </tbody>
        
           		</table>
    		</div>
		</div>

        <footer>
        	<div class="social">
                <a href="http://www.facebook.com" class="fa fa-facebook"></a>
                <a href="http://www.twitter.com" class="fa fa-twitter"></a>
                <a href="http://www.google.com" class="fa fa-google"></a>
                <a href="http://www.instagram.com" class="fa fa-instagram"></a>
            </div>
            <p>LaSalle College &copy; 2022 - Fall</p>
        </footer>
        <script src="../JS/index.js"></script>
    </body>
</html>