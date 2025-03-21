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
	<title>User Landing Page</title>
	<link rel="stylesheet" href="main.css"/>
<style>

body {background-color: black;}
h2{
	color: white;
}
p {color : #DCDCDC; font-size : 50px; font-family: Average;}

a{text-decoration : none;}

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

img{
	height:50%;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
  background-color:#474e5d;
}

.about-section {
  text-align: center;
  background-color: black;
  color: white;
  margin-bottom:5px;
}

.menubtn{
		background-color: #f42f2c;
        line-height: 42px;
        margin-bottom: 20px;
        padding-left: 30px;
        padding-right: 30px;
        border: 2px solid red;
        color: #fff;
        display: inline-block;
        font-size: 30px;
        font-weight: 500;
        position: relative;
		cursor: pointer;
		font-family: Comic Sans MS;
		border-radius: 5px;
}

.menubtn:hover{
	background-color:#E06666;
	 border: 2px solid #E06666;
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
</HEAD>
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
<?php
	$select_profile = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$user_id'");
	if(mysqli_num_rows($select_profile) > 0)
	{
		$fetch_profile = mysqli_fetch_assoc($select_profile);
	}			
?>
			 
  <p>WELCOME TO BIG BURGER, <?= $fetch_profile['users_name']; ?></p>
</div>

<div style="text-align:center;">
            <a href="list of menu.php"><button class="menubtn">Browse Our Store Options</button></a>
        </div>
<div class="row">
  <div class="column">
    <div class="card">
	<img src="Image/burger2.jpg" alt="burger2" style="width:100%">
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="Image/burger3.jpg" alt="burger3" style="width:100%">
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="Image/frenchfries.jpg" alt="burger2" style="width:100%">
    </div>
  </div> 
</div>

<div class="row">
  <div class="column">
    <div class="card">
	<img src="Image/burger1.jpg" alt="burger1" style="width:100%; height:500px;">
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="Image/bubbletea1.jpg" alt="burger3" style="width:100%; height:500px;">
    </div>
  </div>

  <div class="column">
    <div class="card">
	<img src="Image/bubbletea2.jpg" alt="bubbletea2" style="width:100%; height:500px;">
    </div>
  </div> 
</div>
<script>
				let popout = document.getElementById("popout");
				
				function openPopout(){
					popout.classList.add("open-popout");
				}
			</script>
</body>
</html>