<?php include("dataconnection.php");
session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};
?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Administrator Landing Page</title>
	<link rel="stylesheet" href="landing.css">
</head>
<body>
	<div class="header">
		<div class="side">
		<a href="#" class="logo">
			<img src="Image/logo.jpg" class="lg"></a>
		<ul class= "links">
			<li><a href="manage_staff.php"><p>Staff</p></a></li>
			<li><a href="manage_member.php"><p>Member</p></a></li>
			<li><a href="manage_message.php"><p>Messages</p></a></li>
			<li><a href="manage_rating.php"><p>Rating</p></a></li>
			<li><a href="manage_product.php"><p>Items</p></a></li>
			<li><a href="manage_order.php"><p>Order</p></a></li>
			<li style="margin-top:50px;"><a style="color:white; border: 2px solid red; background-color:red;" href="admin_logout.php" onclick="return confirm('Logout From This Website?');">
			<p>Log Out</p></a></li>
		</ul>
		</div>
	</div>
	
	<div class="cardbox">
	<?php
		 $select_admin = mysqli_query($connect, "SELECT * FROM `admin` WHERE id = '$admin_id'");
         if(mysqli_num_rows($select_admin) > 0)
		{
			$fetch_admin = mysqli_fetch_assoc($select_admin);
		}
    ?>
	<h2>Welcome Back, <?= $fetch_admin['admin_Name']; ?></h2>
	
	<div class="card">
	<?php
         $total_pendings = 0;
		 $select_pendings = mysqli_query($connect, "SELECT * FROM `order` WHERE order_payment_status = 'Pending'");
         while($fetch_pendings = mysqli_fetch_assoc($select_pendings))
		 {
            $total_pendings += $fetch_pendings['order_total_price'];
         };
    ?>
	<div class="card1">
	<div class="numbers"><span>RM </span><?php echo number_format($total_pendings,2); ?></div>
	<a href="manage_order.php"><p>Total Pendings</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
         $total_pendings = 0;
		 $select_pendings = mysqli_query($connect, "SELECT * FROM `order` WHERE order_payment_status = 'Completed'");
         while($fetch_pendings = mysqli_fetch_assoc($select_pendings))
		 {
            $total_pendings += $fetch_pendings['order_total_price'];
         };
    ?>
	<div class="card2">
	<div class="numbers"><span>RM </span><?php echo number_format($total_pendings,2); ?></div>
	<a href="manage_order.php"><p>Total Completes</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $select_orders = mysqli_query($connect, "SELECT * FROM `order`");
		 $row_count = mysqli_num_rows($select_orders);
    ?>
	<div class="card3">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_order.php"><p>Total Orders</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $select_products = mysqli_query($connect, "SELECT * FROM `items`");
		 $row_count = mysqli_num_rows($select_products);
    ?>
	<div class="card4">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_product.php"><p>Product Added</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $select_user = mysqli_query($connect, "SELECT * FROM `users`");
		 $row_count = mysqli_num_rows($select_user);
    ?>
	<div class="card4">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_member.php"><p>User Account</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $selected_admin = mysqli_query($connect, "SELECT * FROM `admin`");
		 $row_count = mysqli_num_rows($selected_admin);
    ?>
	<div class="card4">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_staff.php"><p>Admins</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $select_messages= mysqli_query($connect, "SELECT * FROM `messages`");
		 $row_count = mysqli_num_rows($select_messages);
    ?>
	<div class="card4">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_message.php"><p>New Messages</p></a>
	</div>
	</div>
	
	<div class="card">
	<?php
		 $select_rating= mysqli_query($connect, "SELECT * FROM `rating`");
		 $row_count = mysqli_num_rows($select_rating);
    ?>
	<div class="card4">
	<div class="numbers"><p><?php echo $row_count; ?></p></div>
	<a href="manage_rating.php"><p>New Ratings</p></a>
	</div>
	</div>
	
	</div>
</body>
</html>