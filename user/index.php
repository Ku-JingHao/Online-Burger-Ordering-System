<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Home</title>
    <link rel="stylesheet" href="main.css"/>
<style>
body{
	background-image: url("Image/burger_background.jpg");
	height: 100vh;
    font-family:sans-serif;
	background-repeat: no-repeat;
    background-size: cover;
    background-position-x: center;
    background-position-y: center;
  
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





.welcome-word{
		margin: 0 auto;
		margin-left: 540px;
		margin-top:130px;
        padding-top: 80px;
		padding-left: 200px;
        color: white;
        max-width: 600px;
}

.welcome-word h2 {
        
        font-size: 30px;
        font-weight: 700;
		font-family: 'Times new Roman';
		margin: 0;
		
}
	
.welcome-word h3 {
        font-size: 70px;
        font-weight: bold;
		font-family: 'Georgia';
		color:orange;
	    margin: 0
}
    
.welcome-word p {
        
        font-size: 20px;
		font-family: 'Times new Roman';
		margin: 0;
}

#close-icon{
	position:absolute;
	width:20px;
	height:20px;
	right:10px;
	top:5px;
	cursor:pointer;
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
 
  <div class="welcome-word">
                <h2>Are you hungry?</h2>
                <h3>Don't Wait !</h3>
				<p>Lets start to order burger now</p>
                <a href="list of menu.php"><button class="btn">Order Now</button></a>
   </div>
   
</body>
</html>