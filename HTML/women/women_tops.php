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
        header("Location: women_tops.php?error=notFound");;
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO cart(ProductID, ProductName, Price, Quantity) VALUES($product_id, '$product_name', '$product_price', '$product_quantity')");
        header("Location: women_tops.php?success=addedToCart");
    }
    
}

if(isset($_POST['add_to_wishlist'])){
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    
    $select_wishlist = mysqli_query($conn, "SELECT p.* FROM wishlist w JOIN products p ON p.ProductID = w.ProductID WHERE p.ProductName = '$product_name'");
    
    if(mysqli_num_rows($select_wishlist) > 0){
        header("Location: women_tops.php?error=notFound");
    }else{
        $insert_product = mysqli_query($conn, "INSERT INTO wishlist(ProductID) VALUES($product_id)");
        header("Location: women_tops.php?success=addedToWishlist");
    }
    
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
        <link href="../../CSS/men_pants.css" rel="stylesheet"/>
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
        			<li><a href="../features/Cart.php"><img src="../../images/addToCart.png" alt="Add To Cart"/></a><?php echo "$rows"?></li>
        			<li><a href="../features/wishlist.php"><img src="../../images/wishlist.png" alt="Wishlist"/></a></li>
					<form action="../features/result.php" method = "get">
					<li><input type="image" src="../../images/search.png" alt="Search" value="Submit" class="searchimg" name="submit"/></li>
              		<li><input type="text" placeholder="Search for product..." name="key" class="searchText"/></li>
              		</form>
        		</ul>
        	</nav>
        	<nav class="category">
        		<ul>
        			<li><a href="../men/men.php">MEN</a></li>
        			<li><a href="women.php">WOMEN</a></li>
        			<li><a href="../kids/kids.php">KIDS</a></li>
        			<li><a href="../about.php">ABOUT US</a></li>
        		</ul>
        	</nav>
        </header>
        <div class="men-category">
            <nav class="options">
                <ul>
                    <li><a href="women_tops.php">Tops</a></li>
                    <li><a href="women_jeans.php">Jeans</a></li>
                    <li><a href="women_dresses.php">Dresses</a></li>
                </ul>
            </nav>
           
            
            
<h2 style="text-align:center"><br>BLACK FRIDAY ON SALE</h2>

<?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM products WHERE CategoryID = 2000");
      if(mysqli_num_rows($select_products) > 0){
          $counter = 0;
         while($fetch_product = mysqli_fetch_assoc($select_products)){
             if($counter == 0) {
      ?>
              	<div class="Row">
                     <?php }?>	
                       <div class="card">
                             <form method="post" action="women_tops.php?action=add&id=<?php echo $fetch_product["ProductID"]; ?>">  
                                            <img src="<?php echo $fetch_product["Img"]; ?>" class="img-top">
                                            <img src="<?php echo $fetch_product["Img2"]; ?>" alt="Denim Jeans" >
                                            <h1><?php echo $fetch_product["ProductName"]; ?></h1>
                                            <p class="price"><?php echo "$".$fetch_product["Price"]; ?></p>
                                            <p>New Arrival<br><?php echo $fetch_product["Description"]; ?></p>
                                            <p><button type="submit" value="add to cart" name="add_to_cart">Add to Cart</button></p>
                                            <p><button type="submit" value="add to wishlist" name="add_to_wishlist">Add to Wish List</button></p>
                                <input type="hidden" name="product_id" value="<?php echo $fetch_product['ProductID']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['ProductName']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['Price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['Img']; ?>">
                            </form>
                        </div>  
                
    		<?php
    		$counter++;
           	if($counter == 3) {
           	    echo "</div>";
           	    $counter = 0;
            }
        }
    }
        ?>     
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
    </body>
</html>