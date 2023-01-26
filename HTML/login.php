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
		<link href="../CSS/login.css" rel="stylesheet"/>
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
		<div class="login-container">
<!-- 			<form class="loginForm" action="../PHP/Includes/Login.inc.php" method="POST"> -->
<form class="loginForm" action="../PHP/Includes/LoginClient.inc.php" method="POST">
				<h3>LOGIN</h3>
				<style><?php include '../CSS/login.css';?></style>
					<?php 
            			if(isset($_GET["error"])){
            			    if($_GET["error"] == "emptyinput") {
            			        echo "<p>Fill in all fields!</p>";
            			    }
            			    elseif($_GET["error"] == "wrongpassword") {
            			        echo "<p>Incorrect Password!</p>";
            			    }
            			    elseif($_GET["error"] == "stmtfailed") {
            			        echo "<p>Something went wrong. Try again!</p>";
            			    }
            			    elseif($_GET["error"] == "clientdoesntexist") {
            			        echo "<p>Email address doesn't exist!</p>";
            			    }
            			}
        			?>
				<input type="email" name="email" placeholder="Email"><br/>
				<input type="password" name="password" placeholder="Password"><br/>
				<button type="submit" name="login-submit">LOGIN</button><br/>
				<a href="changePassword.php">Forgot Password</a><br/>
				<a href="signUp.php">Create an account</a>
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