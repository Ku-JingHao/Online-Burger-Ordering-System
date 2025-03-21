<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};


?>

<!DOCTYPE html>
<html>
<head>
	<title>View Order</title>
	<link rel="stylesheet" href="main.css"/>
<style>
body{
	background-color: #000000;
	color:white;
    font-family:sans-serif;
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

/* view order */
.title{
	text-align:center;
	margin-top:30px;
	font-family: Average;
	font-size:50px;
}

.box-container{
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 750px));
	grid-row-gap: 40px;
}

.box{
	border:1px solid white;
	font-family: Average;
	padding-left:20px;
	padding-right:10px;
	font-size:18px;
	width:90%;
}

.empty{
	font-size:25px;
	font-family: Average;
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

<section class="orders">

   <h1 class="title">Your Orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Plase Login to See Your Orders</p>';
      }else{
		 $select_orders = mysqli_query($connect, "SELECT * FROM `order` WHERE user_id = '$user_id'");
		 if(mysqli_num_rows($select_orders) > 0)
	  {
         while($row_view = mysqli_fetch_assoc($select_orders))
		 {
     
   ?>
   <div class="box">
      <p> Order Date : <span><?= $row_view['order_date']; ?></span> </p>
      <p> Name : <span><?= $row_view['order_name']; ?></span> </p>
      <p> Email : <span><?= $row_view['order_email']; ?></span> </p>
      <p> Phone Number : <span><?= $row_view['order_phone_number']; ?></span> </p>
      <p> Address : <span><?= $row_view['order_address'];?>,</span> <span><?=$row_view['order_zip'];?>,</span>  <span><?=$row_view['order_city'];?>,</span> <span><?=$row_view['order_state'];?></span> </p>
      <p> Total Product : <span><?= $row_view['order_total_products']; ?></span> </p>
      <p> Total Price : <span>RM<?= number_format ($row_view['order_total_price'],2); ?></span> </p>
      <p> Payment Method : <span><?= $row_view['payment_method']; ?></span> </p>
	  <p> Payment Status : <span style="color:<?php if($row_view['order_payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $row_view['order_payment_status']; ?></span></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">No Orders Placed Yet!</p>';
      }
      }
   ?>

   </div>

</section>

</body>
</html>