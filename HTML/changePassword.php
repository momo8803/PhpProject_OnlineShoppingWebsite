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
        <title>HOME</title>
        <link href="../CSS/header.css" rel="stylesheet"/>
        <link href="../CSS/footer.css" rel="stylesheet"/>
        <link href="../CSS/index.css" rel="stylesheet"/>
		<link href="../CSS/changePassword.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
       <header>
            <a href="index.php">
        	<img src="../images/logo.png" class="logo" alt="Papaya logo" />
            </a>
        	<nav class="features">
        		<ul>
        			<li><a href="login.php"><img src="../images/user.png" alt="Login"/></a></li>
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
		<div class="changePwd-container">
			<form class="changePwdForm" action="../PHP/Includes/ChangePassword.inc.php" method="post">
				<h3><strong>RESET YOUR PASSWORD</strong></h3>
				<input type="email" name="email" placeholder="Email"><br/>
				<input type="password" name="pwd" placeholder="Enter new password"><br/>
				<input type="password" name="confirmPwd" placeholder="Confirm new password"><br/>
				<input type="submit" name="submit-request" value="RESET PASSWORD"/><br/>
				<a href="login.php"><input type="button" value="CANCEL"/></a>
			</form>
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