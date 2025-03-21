<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['mail'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $subject = $_POST['subject'];
   $subject = filter_var($subject, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);


   $message_query = mysqli_query($connect, "SELECT * FROM `messages` WHERE messages_name = $name, messages_number = $number, messages_email = $email, messages_subject = $subject, 	messages_text = $msg");
   
   if($message_query)
   {
      $message[] = 'Already Sent The Message!';
   }
   
   else{
	   
	  $insert_query = mysqli_query($connect, "INSERT INTO `messages`(user_id, messages_name, messages_number, messages_email, messages_subject, 	messages_text) 
	  VALUES('$user_id', '$name', '$number', '$email', '$subject', '$msg')");
	
      $message[] = 'Sent Message Successfully!';
   }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<link rel="stylesheet" href="main.css"/>
<style>
body{
	background-color: #000000;
	color:white;
    font-family:sans-serif;
}

.box{
	width: 80%;
	margin:50px auto;
}

.contact-page{
	background:grey;
	display: flex;
}

.contact-left{
	flex-basis:60%;
	padding: 40px 60px;
}

.contact-left h3{
	font-family:lexend;
	font-size:25px;
	color:white;
	font-weight:600;
	margin-bottom:30px;
}

.contact-right{
	flex-basis:40%;
	padding: 40px;
	background:white;
	color: black;
}

.contact-right h3{
	font-family:lexend;
	font-size:25px;
	color:black;
	font-weight:600;
	margin-bottom:10px;
}

h1{
	text-align:center;
	font-family: Average;
	font-size:55px;
	color:silver;
	margin-bottom:10px;
}

.box p{
	margin-bottom:40px;
	text-align:center;
	font-family: "Comic Sans MS";
	font-size:20px;
}

.left-row{
	display:flex;
	justify-content:space-between;
	margin-bottom:20px;
}

.left-row, .left-title{
	flex-basis:45%;
}

input{
	width:100%;
	height:25px;
	border:none;
	border-bottom:1px solid white;
	outline:none;
	padding-bottom:5px;
}

textarea{
	width:100%;
	border:1px solid white;
	outline:none;
	padding: 10px;
	box-sizing:border-box;
}

label{
	font-family: Cambria;
	font-size:17px;
	margin-bottom:6px;
	display:block;
	color:white;
}

.btn{
 border: 1px solid white;
	background: transparent;
	color: white;
	display: block;
	line-height: 40px;
	height:50px;
	width:130px;
	font-size: 20px;
	float:left;
}

.btn:hover{
	background: white;
    color: black;
	cursor: pointer;
}

table{
	font-family: Cambria;
	font-size:17px;
}

tr td:first-child{
	padding-right:20px;
}

tr td{
	padding-top:20px;
}


.map{
	position:absolute
}

.message{
   background-color: blue;
   position: sticky;
   top:0; 
   left:0;
   z-index: 10000;
   border-radius: .5rem;
   background-color: white;
   padding:10px 10px 10px;
   margin:0 auto;
   max-width: 1200px;
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap:1.2rem;
 }

.message span{
   font-size: 2rem;
   color:black;
   font-family: Comic Sans MS;
}

.message i{
   font-size: 2.0rem;
   color:black;
   cursor: pointer;
}

.message i:hover{
   color:red;
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

	<div class="box">
		<h1>Contact Us</h1>
		<p>We would love to respond to your queries and help you suceed. 
		Feel free to get in touch with us. Write a Message Here !!</p>
		<div class="contact-page">
			<div class="contact-left">
				<h3>Send Your Request</h3>
				
				<form action="" method="post">
					<div class="left-row">
						<div class="left-title">
							<label>Name</label>
							<input type = "text" name = "name" cols = "20" size = "21" placeholder = "Name" required>
						</div>
						<div class="left-title">
							<label>Phone Number</label>
							<input type="tel" name="number" pattern="[0-9]{3}-[0-9]{7}" placeholder="011-2345678" class="phoneNumber"required>
						</div>
					</div>
					
					<div class="left-row">
						<div class="left-title">
							<label>Email</label>
							<input type = "email" name = "mail" placeholder = "myname@example.com"required>
						</div>
						<div class="left-title">
							<label>Subject</label>
							<input type = "text" name = "subject" placeholder = "Product Issues" required>
						</div>
					</div>
					
					<label>Message</label>
					<textarea name="msg" cols = "80" rows = "10" placeholder = "Write here..."></textarea>
					<p><input type ="submit" name = "send" value = "Submit" class="btn" required></p>
				</form>
				
			</div>
			<div class="contact-right">
				<h3>Reach Us</h3>
				<table>
					<tr>
						<td><b>Name</b></td>
						<td style="color:#615151;">Big Burger</td>
					</tr>
					<tr>
						<td><b>Email</b> </td>
						<td style="color:#615151;">bigburger@gmail.com</td>
					</tr>
					<tr>
						<td><b>Phone</b></td>
						<td style="color:#615151;">017-2345678</td>
					</tr>
					<tr>
						<td><b>Address</b></td>
						<td style="color:#615151;">Persiaran Multimedia 63100 Cyberjaya <br/> Selangor</td>
					</tr>
					<tr><td><iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.610479363014!2d101.63971171422656!3d2.927771497867579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdb6e4a9d3b7a1%3A0xd0f74e8ad10f1129!2sMultimedia%20University%20-%20MMU%20Cyberjaya!5e0!3m2!1sen!2smy!4v1646931861159!5m2!1sen!2smy"
					width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

</body>
</html>