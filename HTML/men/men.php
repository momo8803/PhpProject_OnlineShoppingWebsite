<?php 
    session_start();
    include '../../PHP/Includes/Dbh.inc.php';
    $rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `cart`"));
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PAPAYA CA | Online Clothing Company</title>
        <link rel="icon" type="image/x-icon" href="../../images/logo.png">
        <link href="../../CSS/header.css" rel="stylesheet"/>
        <link href="../../CSS/footer.css" rel="stylesheet"/>
        <link href="../../CSS/index.css" rel="stylesheet"/>
        <link href="../../CSS/men.css" rel="stylesheet"/>
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
        			<li><a href="men.php">MEN</a></li>
        			<li><a href="../women/women.php">WOMEN</a></li>
        			<li><a href="../kids/kids.php">KIDS</a></li>
        			<li><a href="../about.php">ABOUT US</a></li>
        		</ul>
        	</nav>
        </header>
        <div class="men-category">
            <nav class="options">
                <ul>
                    <li><a href="men_pants.php">Pants</a></li>
                    <li><a href="men_shirts.php">Shirts</a></li>
                    <li><a href="men_tshirt.php">T-Shirts</a></li>
                </ul>
            </nav>
            <section class="men-images">
                <div class="img-container">
                    <img src="../../images/tshirts.jpg" alt="T-Shirts"/>
                    <a href="men_tshirt.php"><button class="btn"> T-Shirts</button></a>
                </div>
                <div class="img-container">
                    <img src="../../images/sale.jpg" alt="Sale"/>
                    <a href="men_tshirt.php"><button class="btn">On Sale</button></a> 
                </div> 
                <div class="img-container">              
                    <img src="../../images/pants.jpg" alt="Pants"/>
                    <a href="men_pants.php"><button class="btn">Pants</button></a>
                </div>
                <div class="img-container">
                    <img src="../../images/shirts.jpg" alt="Shirts"/>
                    <a href="men_shirts.php"><button class="btn">Shirts</button></a>   
                </div> 
            </section>
            
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