<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['update_btn']))
{
   $update_qty = $_POST['quantity'];
   $update_id = $_POST['quantity_id'];
   $update_quantity_query = mysqli_query($connect, "UPDATE `cart` SET cart_quantity = '$update_qty' WHERE cart_id = '$update_id'");
   
   if($update_quantity_query)
   {
      header('location:cart.php');
   };
};

if(isset($_GET['remove']))
{
   $remove_id = $_GET['remove'];
   mysqli_query($connect, "DELETE FROM `cart` WHERE cart_id = '$remove_id'");
   header('location:cart.php');
};

?>
 
<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Order Cart</title>
	<link rel="stylesheet" href="main.css"/>
<style>
.cart-details{
	color:white;
	margin: 40px auto;
	padding-right: 100px;
	padding-left: 100px;
}

table{
	width:100%;
	border-collapse: collapse;
}

.foods-details{
	display:flex;
	flex-wrap: wrap;
}

.foods-details p{
	margin: 0;
}

th{
	 font-size: 25px;
	text-align: left;
	padding: 5px;
	color: #fff;
	background: orange;
}

td{
	padding: 10px 5px;
}

td input{
	width:40px;
	height: 30px;
	padding: 5px;
}

td a{
	color:red;
	font-size:13px;
}

td img{
	width: 80px;
	height: 80px;
	margin-right: 10px;
}

td:last-child{
	text-align: right;
}

th:last-child{
	text-align: right;
}

.total{
	display:flex;
	justify-content: flex-end;

}

.total table{
	border-top: 3px solid orange;
	width: 100%;
	max-width:400px;
}

.payment{
        background-color: #CC0000;
        line-height: 42px;
        margin-top: 20px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
        color: white;
        font-size: 20px;
        position: relative;
		cursor: pointer;
}

.payment:hover{
	background-color:#E06666;
}


td form input{
	border: 2px solid white;
	width: 150px;
	height: 17px;
	display: flex;
	float: left;
	position: relative;
}

.update-quantity-button{
   padding:10px 10px 10px 10px;
   cursor: pointer;
   font-size: 15px;
   background-color: #3D85C6;
   color:white;
   width: 70px;
   height:40px;
   margin-right:10px;
}

.update-quantity-button:hover{
   background-color: #6FA8DC;
}

.option-button{
   text-align: center;
   background-color: orange;
   color:white;
   font-size: 25px;
   padding:10px 10px;
   cursor: pointer;
   text-decoration:none;
}

.option-button:hover{
	background-color:#F6B26B;
	color:white;
}

.heading{
   font-family:Average;
   text-align: center;
   font-size: 2rem;
   text-transform: uppercase;
   color:white;
   margin-bottom: 2rem;
}

#close-icon{
	position:absolute;
	width:20px;
	height:20px;
	right:10px;
	top:5px;
	cursor:pointer;
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
	padding: 5px 15px 5px 15px;
}

.account, .name {
	font-size:23px;
}

.account{
	
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
<header>
        <div class="container">
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
			 
			 <p class="name"><?= $fetch_profile['users_name']; ?></p>
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
            </div>
			
			<script src="user_java.js"></script>
			
        </div>
</header>
	   
		<div class="cart-details">
		<h1 class="heading">Shopping Cart</h1>
		<table>
			<div class="cart-subject">
			<tr>
				<th>Foods</th>
				<th>Quantity</th>
				<th>Subtotal</th>
			</tr>
			</div>
		<div class="order-cart">
		
		<?php 
         
         $results = mysqli_query($connect, "SELECT * FROM `cart`");
         $grand_total = 0;
		 $delivery_fees = 10;
         if(mysqli_num_rows($results) > 0){
            while($row = mysqli_fetch_assoc($results)){
         ?>

			<tr class="cart-items">
				<td>
					<div class="foods-details">
					<img src="image/<?php echo $row['cart_image']; ?>" alt="">
					<div>
						<p class="c-title"><?php echo $row['cart_name'];?></p>
						<small>Price: RM <?php $price = $row['cart_price']; 
						echo number_format($price,2); ?></small>
						<br/>
						<a class = "remove-link" href="cart.php?remove=<?php echo $row['cart_id']; ?>" onclick="return confirm('Do You Want To Remove This Item?')">Remove</a>
					</div>
					</div>
				</td>
				<div>
				<form action="" method="post">
				<td><input type="hidden" name="quantity_id" value="<?php echo $row['cart_id']; ?>">
		        <input class="cart-quantity" name="quantity" type="number" value="<?php echo $row['cart_quantity']; ?>" min="1">
				<input class="update-quantity-button" type="submit" value="Update" name="update_btn"></td>
				<td class="cart-price">RM <?php $sub_total = $row['cart_price'] * $row['cart_quantity']; 
				echo number_format($sub_total,2);
				?></td>
				</form>
				</div>
			</tr>
			
			 <?php
				$grand_total += $sub_total;
					};
				};
			 ?>
			</div>
		</table>
		
		<div class="total">
		<table>
		<tr>
				<td class="title">Sub Total</td>
				<td class="cart-total-price">RM <?php echo number_format($grand_total,2); ?></td>
		</tr>
		<tr>
				<td>Delivery Fees</td>
				<td>RM <?php echo number_format($delivery_fees,2);?></td>
		</tr>
		<tr>
				<td>Total</td>
				<td>RM <?php echo number_format(($grand_total + $delivery_fees),2) ;?></td>
		</tr>
		</table>
		</div>
		<table>
		<tr>
				<td><a href="menu.php" class="option-button">Continue Shopping</a></td>
				<td><a href="checkoutform.php"><button class="payment" onclick="return confirm('Are You Sure You Want To Proceed With Checkout');">Proceed To Checkout</button></a></td>
		</tr>
		</table>
		</div>
</body>
</html>