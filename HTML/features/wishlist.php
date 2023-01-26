<?php
session_start();
include '../../PHP/Includes/Dbh.inc.php';
$rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `cart`"));
if(isset($_POST['add_to_cart'])){
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE ProductName = '$product_name'");
    
    if(mysqli_num_rows($select_cart) > 0){
        header("Location: wishlist.php?error=notFound");;
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO cart(ProductID, ProductName, Price, Quantity) VALUES($product_id, '$product_name', '$product_price', '$product_quantity')");
        
        mysqli_query($conn, "DELETE FROM wishlist WHERE ProductID = '$product_id'");
        header("Location: wishlist.php?success=addedToCart");
        
    }
    
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['ID'];
    mysqli_query($conn, "DELETE FROM wishlist WHERE wishlistID = '$remove_id'");
    header('location:wishlist.php');
};

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>PAPAYA CA | Online Clothing Company</title>
        <link rel="icon" type="image/x-icon" href="../images/logo.png">
        <link href="../../CSS/header.css" rel="stylesheet"/>
        <link href="../../CSS/footer.css" rel="stylesheet"/>
        <link href="../../CSS/index.css" rel="stylesheet"/>
        <link href="../../CSS/men_shirts.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-color:lightgray">
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
<?php

    $query = "SELECT * FROM wishlist w JOIN products p ON p.ProductID = w.ProductID";
    $run_query = mysqli_query($conn,$query);
    
    if (mysqli_num_rows($run_query)>0) {
        ?>
        <h3 style="text-align: center">Wish List</h3>
        <?php 
        $counter = 0;
        while($items = $run_query->fetch_assoc()) {
            if($counter == 0) {
        ?>
            	<div class="Row">
            	<?php }?>
            		<div class="card">
            		 <form method="post" action="wishlist.php?action=add&id=<?php echo $items["ProductID"]; ?>">  
                       <img src="<?php echo $items["Img"]; ?>" class="img-top">
                       <img src="<?php echo $items["Img2"]; ?>" alt="Denim Jeans" >
                        <h1><?php echo $items["ProductName"]; ?></h1>
                        <p class="price"><?php echo "$".$items["Price"]; ?></p>
                        <p>New Arrival<br><?php echo $items["Description"]; ?></p>
                         <p><button type="submit" value="add to cart" name="add_to_cart">Add to Cart</button></p>
                         <p><button type="submit" value="add to cart" name="remove"><a href="wishlist.php?remove&ID=<?php echo $items['wishlistID']; ?>" class="delete-btn"> remove</a></button></p>
                         <input type="hidden" name="product_id" value="<?php echo $items['ProductID']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $items['ProductName']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $items['Price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $items['Img']; ?>">
                        </form>
            		</div>   	
           	<?php
           	$counter++;
           	if($counter == 3) {
           	    echo "</div>";
           	    $counter = 0;
            }
         } ?>
         </div><?php
    }
    else
    {
    	?>    		
    			<h3 style="text-align: center">WISHLIST EMPTY</h3>
    		
    	<?php 
    }    

?>     
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