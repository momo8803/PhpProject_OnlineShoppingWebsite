<?php
// require'../PHP/database.php';
include '../PHP/Includes/Dbh.inc.php';
session_start();



$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");



$rows = mysqli_num_rows($select_cart);

?>

<!DOCTYPE html>
<html>
    <head>
        
        <title>PAPAYA CA | Online Clothing Company</title>
        <link rel="icon" type="image/x-icon" href="../images/logo.png">
        <link href="../CSS/header.css" rel="stylesheet"/>
        <link href="../CSS/footer.css" rel="stylesheet"/>
        <link href="../CSS/index.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body style="background-color:lightgray">
        <header>
            <a href="index.php">
        	<img src="../images/logo.png" class="logo" alt="Papaya logo" />
            </a>
        	<nav class="features">
        		<ul>
        			<?php 
        			 if(!isset($_SESSION["client_id"]))
        			 {
        			?>
        			<li><a href="login.php"><img src="../images/user.png" alt="Login"/></a></li>
        			<?php 
        			 }
        			 else
        			 {
        			?>
        			<li><a href="../PHP/Includes/logout.inc.php"><img src="../images/logout.png" alt="Login"/></a></li>
                    <li><?php                          
                         $name=$_SESSION["name"];
                         echo "Welcome $name";
                    ?>
                    </li>
                    <?php }?>
        			<li><a href="features/Cart.php"><img src="../images/addToCart.png" alt="Add To Cart"/></a><?php echo "$rows"?></li>
        			
        			<li><a href="features/wishlist.php"><img src="../images/wishlist.png" alt="Wishlist"/></a></li>
					<form action="features/result.php" method = "get">
					<li><input type="image" src="../images/search.png" alt="Search" value="Submit" class="searchimg" name="submit"/></li>
              		<li><input type="text" placeholder="Search for product..." name="key" class="searchText"/></li>
              		</form>
        		</ul>
        	</nav>
        	<nav class="category">
        		<ul>
        			<li><a href="men/men.php">MEN</a></li>
        			<li><a href="women/women.php">WOMEN</a></li>
        			<li><a href="kids/kids.php">KIDS</a></li>
        			<li><a href="about.php">ABOUT US</a></li>
        		</ul>
        	</nav>
        </header>
        <div class="slideshow-container">

            <div class="mySlides fade">
              
              <img src="../images/BlackFriday.png" >
              <div class="text">
                
                  <a href="../HTML/kids/kids.php" class="shop-button btn">
                  Kid's Fashion ON SALE
                  Shop Now</a>
              </div>
            </div>
            
            <div class="mySlides fade">
              
              <img src="../images/banner1.jpg" >
              <div class="text">
                <h3>Women's Fashion ON SALE
                <br>60% Off</h3>
                  <a href="../HTML/women/women.php" class="shop-button btn">
                  Shop Now</a>
              </div>
            </div>
            
            <div class="mySlides fade">
              
              <img src="../images/banner3.jpg" >
              <div class="text">
                <h3>Women's Fashion
                <br>50% Off</h3>
                  <a href="../HTML/women/women.php" class="shop-button btn">
                  Shop Now</a>
              </div>
            </div>

            <div class="mySlides fade">
                
                <img src="../images/banner4.jpg" >
                <div class="text">
                  <a href="../HTML/men.php" class="shop-button btn">
                  <h3>Men's Fashion
                  <br>40% Off</h3>
                    
                    Shop Now</a>
                </div>
                </div>
            
        </div>
            <br>
            
            <div style="text-align:center">
              <span class="dot"></span> 
              <span class="dot"></span> 
              <span class="dot"></span>
              <span class="dot"></span> 
            </div>
            
            <div class="img2">
                <img src="../images/outerwear_1.png">
                <img src="../images/outerwear_2.png">
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