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
        <link href="../../CSS/payment.css" rel="stylesheet"/>
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

            <section class="men-images">
                <div class="img-container">
                    <img src="../../images/checkout.jpeg" alt="banner"/>
<!--                     <h1 class="title">About PAPAYA</h1> -->
<!--                     <p class = "about-text">PAPAYA is a multinational online retail clothing company based in Montreal, focusing on fashion clothing for men, women, and children. To making it possible for customers around the world to express themselves through fashion and design, and to choose a more sustainable lifestyle. We create value for people and society in general by delivering our customer offering and by developing with a focus on sustainable and profitable growth.</p> -->
<!--                 </div>                -->
<!--             </section> -->
            

<!--             <section id="background3"> -->
                <div class="container">
                  <form id="myForm">
                    <fieldset>
                      <legend>Credit Card Information</legend>
                      
                      <div class="grp-content">
                        <label>*Card Number</label>
                        <input type="text" placeholder="Card Number ...">
                      </div>
                      <div class="grp-content">
                        <label>*CVC</label>
                        <input type="text" placeholder="CVC ...">
                      </div>
                      <div class="grp-content">
                        <label>*Name On The Card</label>
                        <input type="text" placeholder="Name ...">
                      </div>
                      <div class="grp-content">
                        <label>*Expiration</label>
                        <input type="date month" placeholder="MM/YY ...">
                      </div>
                     
                    </fieldset>
                    <fieldset>
                      <legend>Shipping Address</legend>
                      <div class="grp-content">
                        <label>*Address</label>
                        <input type="text" placeholder="Street ...">
                      </div>
                      <div class="grp-content">
                        <label>*City</label>
                        <input type="text" placeholder="City ...">
                      </div>
                      <div class="grp-content">
                        <label>*Postal Code</label>
                        <input type="text" placeholder="Postal Code ...">
                      </div>
                      <div class="grp-content">
                        <label>*Province:</label>
                        <select>
                          <option></option>
                          <option>AB</option>
                          <option>BC</option>
                          <option>QC</option>
                          <option>ON</option>
                          <option>MB</option>
                          <option>PE</option>
                        </select>
                      </div>
                      <div class="grp-content">
                        <label>*Country</label>
                        <input type="text" placeholder="Country ...">
                      </div>

                      <div class="grp-content">
                        <input type="submit" value="Submit" onclick="purch()">
                        <input type="reset" value="Reset">
                      </div>
                    
                    </fieldset>
                  </form>      
                </div>    
<!--             </section> -->
            
               
            </div>       
			 </section> 
                 

        <footer>
        	<div class="social">
                <a href="http://www.facebook.com" class="fa fa-facebook"></a>
                <a href="http://www.twitter.com" class="fa fa-twitter"></a>
                <a href="http://www.google.com" class="fa fa-google"></a>
                <a href="http://www.instagram.com" class="fa fa-instagram"></a>
            </div>
            <p>LaSalle College &copy; 2022 - Fall</p>
        </footer>
        <script src="../..//JS/index.js"></script>
    </body>
</html>