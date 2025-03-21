<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['btnSubmit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE users_email = '$email' AND users_password = '$pass'");
   $row = mysqli_fetch_assoc($select_user);
	
   if(mysqli_num_rows($select_user) > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:landing_page.php');
   }else{
      $message[] = 'Incorrect Email or Password!';
   }

}

?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Login/Sign-In</title>
	 <link rel="stylesheet" href="main.css"/>
<style>

.form {
	  width:800px;
	  display: flex;
	  justify-content: center;
	  margin: 0 auto;
	  color:white;
	  
}
.email, .password{
	width: 90%;
	height: 50px;
	padding: 10px 20px;
	margin: 10px 0;
	display: inline-block;
	border: 1px solid white;
	box-sizing: border-box;
}
.form h4{
	font-size:50px;
	color: #DCDCDC;
}

.login-forgot-pass{
	color:white;
	 bottom: 0;
	color: white;
	cursor: pointer;

}

.login_btn{
       border: 1px solid white;
	background: transparent;
	color: white;
	display: block;
	line-height: 40px;
	width:130px;
	font-size: 20px;
}

.login_btn:hover{

	background: white;
    color: black;
	cursor: pointer;
}

.form p{
	font-size:20px;
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
	margin-left:410px;
	margin-top:16px;
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

.register-link{
	text-decoration:none;
	color:red;
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

		<div class="form">
<form action="" method="post" >
		<h4>Login / Sign in Form</h4>
		<p><b>Email  :</b><br/><input type="email" name="email" placeholder="Enter Your Email*" class="email" required/></p>
		<p><b>Password :</b><br/><input type="password"  name="pass" placeholder="Enter Your Password*" class="password" required/></p>
		<p><input type="submit" name="btnSubmit" value="Login &#x2192" class="login_btn"></p>
		<p>Dont't Have An Account?<a href="Registration.php" class="register-link">&nbsp; Register Now</a></p>
</form>
		</div>

</body>
</html>