<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['add_to_cart'])){
	
	if($user_id == ''){
      header('location:login.php');
   }

   else{
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = 1;
   $product_image = $_POST['product_image'];
   
   $cart_items = mysqli_query($connect, "SELECT * FROM `cart` WHERE cart_name = '$product_name' AND user_id = '$user_id'");

   if(mysqli_num_rows($cart_items) > 0)
   {
	   $message[] = 'This Item Is Already Added To The Cart';
   }
   
   else
   {
      $insert_product = mysqli_query($connect, "INSERT INTO `cart`(user_id, cart_name, cart_price, cart_quantity, cart_image) VALUES
	  ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
	  $message[] = 'Item Added To Cart Succesfully';
   }
	}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>BIG Bugers - Menu</title>
<link rel="stylesheet" href="main.css"/>
<style>
*{
	font-family: "Poppins", sans-serif;
	margin:0;
	padding:0;
	scroll-padding-top: 2rem;
	scroll-behaviour: smooth;
	box-sizing: border-box;
	list-style: none;
	text-decoration: none;
}

header{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 10;
}
.button-img{
	cursor: pointer;
	position:absolute;
	right:1300px;
	top:0;
	width:160px;
	top:50px;
	height:110px;
	padding:5px;
}

.message{
   background-color: blue;
   position: sticky;
   top:0; 
   z-index: 10000;
   border-radius: .5rem;
   background-color: white;
   padding:10px 10px;
   margin:0 auto;
   max-width: 900px;
   display: flex;
   align-items: center;
   justify-content: space-between;
}

.message span{
   font-size: 30px;
   color:black;
   font-family: Comic Sans MS;
}

.main span{
	position:absolute;
	right:1270px;
	margin-top:65px;
	padding: 5px 9px 5px 5px;
	border-radius: .5rem;
	background-color: red;
	color: white;
	font-size: 1.5rem;
	 font-style: normal; 
}

.cross-icon{
	width:50px;
	height:50px;
	cursor:pointer;
}

#close-icon{
	position:absolute;
	width:20px;
	height:20px;
	right:10px;
	top:5px;
	cursor:pointer;
}

.add-to-cart{
	background: orange;
	border: 3px solid orange;
	color: white;
	padding: 7px 2px;
	cursor: pointer;
	margin-top:10px;
	width:130px;
	font-size:17px;
	font-family: Anton;
	font-weight:bold;
}

form .add-to-cart{
	padding-margin:0;
}

.add-to-cart:hover{
	border: 3px solid #F6B26B;
	background: #F6B26B;
}


.shop-container .shop-items{
   display: grid;
   grid-template-columns: repeat(auto-fit, 19rem);
   gap:1.7rem;
   justify-content: center;
}

.shop-container .shop-items .shop-product{
  color:white;
   text-align: center;
   padding:10px;
   border:1px solid white;
   border-radius: .5rem;
   height:450px;
}

.shop-container .shop-items .shop-product img{
   height: 12rem;
   width:230px;
}

.shop-container .shop-items .shop-product h3{
   font-family:Times New Roman;
   margin:.7rem 0;
   font-size: 1.3em;
   color:white;
}

.shop-container .shop-items .shop-product .price{
	font-family:Times New Roman;
   margin-bottom: 8px;
   font-size: 1.2rem;
   color:white;
}

.section-header{
  margin-top:100px;
  font-family:Average;
   text-align: center;
   font-size: 2rem;
   text-transform: uppercase;
   color:white;
   margin-bottom: 2rem;
}
.product-category{
	margin-bottom:8px;
	font-size:25px;
	font-family: Comic Sans MS;
	font-weight:bold;
}

.product-description{

	font-family: Times New Roman;
}

/*header*/

.popout{
	border: 1px solid white;
	top:150px;
	width:250px;
	font-family:Average;
	padding: 0 0 0 0;
}


.flex a{
	font-family:Average;
	padding: 5px 15px 5px 15px;
}

.account, .name{
	padding-top:20px;
	font-size:23px;
	font-family:Average;
}

.name{
	padding-bottom:15px;
}

.account a{
	font-family:Average;
	font-weight:bold;
}

.login-btn,.delete-btn{
   display: inline-block;
   font-size: 25px;
   cursor: pointer;
}


.login-btn{
   background-color: green;
   color:black;
   margin-bottom:20px;
}

.delete-btn{
   background-color: red;
   color:white;
}

.login-btn:hover{
	background-color:#93C47D;
   color:white;
}

.delete-btn:hover{
	background-color:#E06666;
	color:white;
}

.profile{
	width:100%;
	height:160px;
}

.profile-btn:hover{
	background-color:#FFD966;
	color:white;
}

.profile-btn{
	display: inline-block;
   font-size: 25px;
   cursor: pointer;
	 background-color:#F1C232;
}
</style>
</head>
<body>

<?php

if(isset($message))
{
   foreach($message as $message)
   {
	  echo '<div class="message"><span>'.$message.'</span> <i class="alert-message" onclick="this.parentElement.style.display = `none`;">
	  <img src="Pictures/cross.png" alt="" class="cross-icon"></i> </div>';
   };
};

?>

	<header>
		   <div class="nav container">
           <div class="main">
                <a href="index.php" class="home">HOME</a>
                <a href="about_us.php" class="about us">ABOUT US</a>
                <a href="list of menu.php" class="menu">MENU</a>
                <a href="contact_us.php" class="contact us">CONTACT US</a>
				<a href="view_order.php" class="order">VIEW ORDER</a>
				
				<div class="login">
			<button type="submit" class="login_register" onclick="openPopout()">Profile</button>
			<div class="popout" id="popout">
			
				<div class="profile">
			<img src="Pictures/close-icon.png" alt="" id="close-icon">
			 <?php
				$select_profile = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$user_id'");
				if(mysqli_num_rows($select_profile) > 0)
				{
					$fetch_profile = mysqli_fetch_assoc($select_profile);
				
			 ?>
			 
			 <p class="name" style="font-family:Average;"><?= $fetch_profile['users_name']; ?></p>
			 <div class="flex">
				<a href="myprofile.php" class="profile-btn">MyProfile</a>
				<a href="user_logout.php" onclick="return confirm('Logout From This Website?');" class="delete-btn">Logout</a>
			 </div>
			 <p class="account">
				<a href="login.php">Login</a> or
				<a href="Registration.php">Register</a>
			 </p> 
			 
			 <?php
				}else{
			 ?>
				<p class="name">Please Login First!</p>
				<a href="login.php" class="login-btn" style="padding: 5px 25px 5px 25px;">Login</a>
			 <?php
			  }
			 ?>
			</div>
			
			</div>
            </div>
			
				 <?php
				  $select_rows = mysqli_query($connect, "SELECT * FROM `cart`");
				  $row_count = mysqli_num_rows($select_rows);
				 ?>
				 <a href="cart.php"><img src="Pictures/view-cart.png" alt="" class="button-img"><span><?php echo $row_count; ?></span>
			</div>
			
			<script src="user_java.js"></script>
			
			</div>
	</header>
	
	<div class="container">
	<section class="shop-container">
		<h1 class="section-header">Our Menu (So what will you have?)</h1>
		
		<div class="shop-items">
		<?php
         
            $results = mysqli_query($connect, "SELECT * FROM `items`");
            if(mysqli_num_rows($results) > 0){
               while($row = mysqli_fetch_assoc($results)){
         ?>
		 <form action="" method="post">
         <div class="shop-product">
			<p class="product-category"><?php echo $row['items_category']; ?><p>
            <img src="image/<?php echo $row['items_image']; ?>" alt="">
            <h3><?php echo $row['items_name']; ?></h3>
            <div class="price">RM <?php echo $row['items_price']; ?></div>
			<p class="product-description"><?php echo $row['items_description']; ?></p>
            <input type="hidden" name="product_name" value="<?php echo $row['items_name']; ?>">
			<input type="hidden" name="product_price" value="<?php echo $row['items_price']; ?>">
			<input type="hidden" name="product_image" value="<?php echo $row['items_image']; ?>">
            <input type="submit" class="add-to-cart" value="ADD TO CART" name="add_to_cart">
         </div>
		 </form>
		 
		 <?php
			};
		  };
		  ?>
			
		</div>
	</section>
	</div>
</body>
</html>