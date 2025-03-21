<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['btnSubmit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $birth = $_POST['birth'];
   $gendertype = $_POST['gendertype'];
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   
   $select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE users_number = '$number' OR users_email = '$email' ");
   $row = mysqli_fetch_assoc($select_user);
	
   if(mysqli_num_rows($select_user) > 0)
   {
      $message[] = 'Email or Phone Number already exists!';
   }
   else{
      if($pass != $cpass)
	  {
         $message[] = 'confirm password not matched!';
      }
	  else
	  {
		 $insert_query = mysqli_query($connect, "INSERT INTO `users`(users_name, users_email, users_number, users_birth_date, users_gender, users_password) 
		 VALUES('$name', '$email', '$number', '$birth', '$gendertype', '$cpass')");
		 
		 $select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE users_email = '$email' AND users_password = '$pass'");
		 $row = mysqli_fetch_assoc($select_user);
		 
          if(mysqli_num_rows($select_user) > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Register/Sign-up</title>
	<link rel="stylesheet" href="main.css"/>
<style>
.form {
	  width:800px;
	  display: flex;
	  justify-content: center;
	  margin: 0 auto;
	  color:white;
	  
}
.email, .password, .first_name, .last_name, .phoneNumber{
	width: 70%;
	height: 50px;
	padding: 10px 20px;
	margin: 5px 0;
	display: inline-block;
	border: 1px solid white;
	box-sizing: border-box;
}

.date{
	width: 20%;
	height: 20px;
	padding: 10px 20px;
}
.form h4{
	font-size:50px;
	color: #DCDCDC	;
}


.register_btn{
    border: 1px solid white;
	background: transparent;
	color: white;
	display: block;
	line-height: 40px;
	width:130px;
	font-size: 20px;
}

.register_btn:hover{

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
<form name="RegistrationFrm" method="post" action="#">
		<h4>Registration / Sign-Up  Form</h4>
		<p><label for="FirstName"><b>Full Name :</b></label><br/><input type="text" id="FirstName" name="name" class="first_name" placeholder="Enter Your First Name*"required/></p>
		<p><b>Email  : </b><br/><input type="email" name="email" placeholder="Enter Your Email*" class="email" required/></p>
		<p><b>Date Of Birth : </b><input type="date" name="birth" max="2007-12-12" placeholder="dd/mm/yyyy" class="date"></p>
		<p><b>Phone number:</b><br/><input type="tel" name="number" pattern="[0-9]{3}-[0-9]{7}" placeholder="011-2345678" class="phoneNumber"required/></p>
		<p><b>Gender : </b><input type="radio" name="gendertype" value="Male"/>Male
						<input type="radio" name="gendertype" value="Female"/>Female
		<p><b>Password : (at least three character and three digits)</b><br/><input type="password"  name="pass" pattern="^(?=.*[A-Za-z]{3})(?=.*\d{3}).{6,}$" placeholder="Create Your Password*" title="At Least Three Character and Three Digit"  class="password" required/></p>
		<p><b>Confirm Your Password</b> :<br/><input type="password"  name="cpass" placeholder="Confirm Your Password*" class="password" required/></p>
		<p><input type="submit" name="btnSubmit" value="Register &#x2192" class="register_btn"></p>
</form>
		</div>
</body>
</html>