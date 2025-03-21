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
  <title>About Us</title>
      <link rel="stylesheet" href="main.css"/>
<style>
body {background-color: black;font-size:20px;}

h1 {
	color : #DCDCDC	;
	font-family:Georgia;}
 
p {color : white;}

h2 {color : white;}

hr{
	  border-top: 1px solid rgba(255, 255, 255, 0.2);
}

h3{color : white;}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 50px;
  background-color:#474e5d;
}

.about-section {
  padding: 10px;
  text-align: center;
  background-color: black;
  color: white;
}

.container {
  padding: 0 16px;
  padding-bottom:5px;
}

.container::after, .row::after {
  clear: both;
  display: table;
}

.title {
  color: grey;
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

<div class="about-section">
  <h1>About Us Page</h1>
  <p style="font-family: Comic Sans MS;">Some text about who we are</p>
  <hr/>
</div>

<h2 style="text-align:center; font-family: Average;">Here are our members</h2>
<div class="row">
  <div class="column">
    <div class="card">
	<img src="JH.png" alt="KuJingHao" style="width:100%">
      <div class="container">
        <h3>Ku Jing Hao</h3>
        <p>Student ID : 1201203310</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="JM.png" alt="SeeJianMan" style="width:100%">
      <div class="container">
        <h3>See Jian Man</h3>
        <p>Student ID : 1201203321</p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="MH.png" alt="NgMinHoong" style="width:100%">
      <div class="container">
        <h3>Ng Min Hoong</h3>
        <p>Student ID : 1201203289</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>