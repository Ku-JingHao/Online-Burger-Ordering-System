<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['btnSubmit'])){

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = mysqli_query($connect, "SELECT users_password FROM `users` WHERE id = '$user_id'");
   $fetch_prev_pass = mysqli_fetch_assoc($select_prev_pass);
   $prev_pass = $fetch_prev_pass['users_password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['cpass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass)
   {
      if($old_pass != $prev_pass)
	  {
         $message[] = 'Old Password Not Matched!';
      }
	  else if($new_pass != $confirm_pass)
	  {
         $message[] = 'Confirm Password Not Matched!';
      }
	  else
	  {
         if($new_pass != $empty_pass)
		 {
			$update_pass = mysqli_query($connect, "UPDATE `users` SET users_password = '$confirm_pass' WHERE id = '$user_id'");
            $message[] = 'Password Has Been Updated Successfully!';
         }
		 else
		 {
            $message[] = 'Please Enter A New Password!';
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
	  border:1px solid white;
	  padding-bottom:20px;
}

.password{
	width: 100%;
	height: 50px;
	padding: 10px 20px;
	margin: 5px 0;
	display: inline-block;
	border: 1px solid white;
	box-sizing: border-box;
}


.form h4{
	font-size:50px;
	color: #DCDCDC;
	text-dec
}

.back_btn{
	 border: 1px solid white;
	background: transparent;
	color: white;
	display: block;
	line-height: 45px;
	width:220px;
	font-size: 22px;
	text-decoration:none;
	text-align:center;
}

.register_btn{
    border: 1px solid white;
	background: transparent;
	color: white;
	display: block;
	line-height: 45px;
	width:220px;
	font-size: 20px;
}

.register_btn:hover, .back_btn:hover{

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

		<div class="form">
<form name="RegistrationFrm" method="post" action="#">
		<h4>Change Password</h4>
		<p><b>Old Password</b> :<br/><input type="password" name="old_pass" placeholder="Enter Your Old Password" class="password" required/></p>
		<p><b>New Password (at least three character and three digits)</b><br/><input type="password"  name="new_pass" pattern="^(?=.*[A-Za-z]{3})(?=.*\d{3}).{6,}$" placeholder="Create Your Password*" title="At Least Three Character and Three Digit"  class="password" required/></p>
		<p><b>Confirm New Password</b> :<br/><input type="password"  name="cpass" placeholder="Confirm Your Password*" class="password" required/></p>
		<p><input type="submit" name="btnSubmit" value="Change Password &#x2192" class="register_btn"></p>
		<a href="myprofile.php" class="back_btn">Back To Profile </a>	
</form>
		</div>
</body>
</html>