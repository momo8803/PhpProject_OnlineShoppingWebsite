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
        <link href="../CSS/about.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
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
                         echo "Welcome $name ";
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

            <section class="men-images">
                <div class="img-container">
                    <img src="../images/about_banner.jpg" alt="banner"/>
                    <h1 class="title">About PAPAYA</h1>
                    <p class = "about-text">PAPAYA is a multinational online retail clothing company based in Montreal, focusing on fashion clothing for men, women, and children. To making it possible for customers around the world to express themselves through fashion and design, and to choose a more sustainable lifestyle. We create value for people and society in general by delivering our customer offering and by developing with a focus on sustainable and profitable growth.</p>
                </div>               
            </section>
            

                <div class="goal">
                                    
                    <img src="../images/path.jpg" alt="path" class="goal_pic">
                
                    
                    <h1 class="gh">Our Goals</h1>
                    <p class="gp">At PAPAYA, we consider the needs of present and future generations, and are aware that our entire business must be conducted in a way that is economically, socially and environmentally sustainable. This is why we set clear ambitions and bold goals.</p>  
                </div>
                <div class="market">
                    <img src="../images/market.jpg" alt="market" class="market-pic">
                    <h1 class="title2">Markets</h1>
                    <p class="mp">PAPAYA Clothing Company is expanding, with a focus on omnichannel sales. We make it possible for our customers to shop and be inspired when and how they choose in our stores, on our brands own websites, on digital marketplaces and in social media. We offer strong and unique brands that want to give customers unbeatable value with the best combination of fashion, quality, price and sustainability. </p>
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