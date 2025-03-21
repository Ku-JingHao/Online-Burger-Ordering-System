<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};

if(isset($_POST['btnSubmit'])){

   $email = $_POST['staff-email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $Pwd = sha1($_POST['Pwd']);
   $Pwd = filter_var($Pwd, FILTER_SANITIZE_STRING);

   $select_user = mysqli_query($connect, "SELECT * FROM `admin` WHERE admin_Email = '$email' AND  admin_Pwd = '$Pwd'");
   $row = mysqli_fetch_assoc($select_user);
	
   if(mysqli_num_rows($select_user) > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:admin_dashboard.php');
   }else{
      $message[] = 'Incorrect Email or Password!';
   }

}

?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Login/Sign-In</title>
<style>
body{
	background-image: url("Image/white1.jpg");
	background-repeat: no-repeat;
    background-size: cover;
}
.form {
	  width:800px;
	  display: flex;
	  justify-content: center;
	  margin: 0 auto;
	  color:black;
	  border:1px solid black;
	  
}
.email, .password{
	width: 90%;
	height: 50px;
	padding: 10px 20px;
	margin: 10px 0;
	display: inline-block;
	border: 1px solid black;
	box-sizing: border-box;
}
.form h4{
	font-size:50px;
	color: Black;
}

.login-forgot-pass, .login-forgot-id{
	color:black;
	 bottom: 0;
	cursor: pointer;

}

.login_btn{
       border: 1px solid black;
	background: transparent;
	color: black;
	display: block;
	line-height: 40px;
	width:130px;
	font-size: 20px;
}

.login_btn:hover{

	background: black;
    color: white;
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

		<div class="form">
<form name="RegistrationFrm" method="post" action="">
		<h4>Login / Sign in Form</h4>
		<p><b>Staff Email:</b><br/><input type="email" name="staff-email" placeholder="Enter Your Staff Email*" class="email" required/></p>
		<p><b>Password :</b><br/><input type="password"  name="Pwd" placeholder="Enter Your Password*" class="password" required/></p>
		<p><input type="submit" name="btnSubmit" value="Login &#x2192" class="login_btn"></p>
		<p>Create An Account Before Login<a href="administrator_registration.php" class="register-link">&nbsp; Proceed To Register</a></p>
</form>
		</div>

</body>
</html>