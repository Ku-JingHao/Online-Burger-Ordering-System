<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send']))
{

   $date = $_POST['date_visit'];
   $food = $_POST['food'];
   if($food == "Excellent")
   {
	   $rating_food_results = 4;
   }
   
   else if($food == "Good")
   {
	   $rating_food_results = 3;
   }
   
   else if($food == "Average")
   {
	   $rating_food_results = 2;
   }
   
   else if($food == "Dissatisfied")
   {
	   $rating_food_results = 1;
   }
   
		   
		   $service = $_POST['service'];
		   if($service == "Excellent")
		   {
			   $rating_service_results = 4;
		   }
		   
		   else if($service == "Good")
		   {
			   $rating_service_results = 3;
		   }
		   
		   else if($service == "Average")
		   {
			   $rating_service_results = 2;
		   }
		   
		   else if($service == "Dissatisfied")
		   {
			   $rating_service_results = 1;
		   }
   
   $order = $_POST['order']; 
   if($order == "Excellent")
   {
	   $rating_order_results = 4;
   }
   
   else if($order == "Good")
   {
	   $rating_order_results = 3;
   }
   
   else if($order == "Average")
   {
	   $rating_order_results = 2;
   }
   
   else if($order == "Dissatisfied")
   {
	   $rating_order_results = 1;
   }  
   
			$speed = $_POST['speed'];
			if($speed == "Excellent")
		   {
			   $rating_speed_results = 4;
		   }
		   
		   else if($speed == "Good")
		   {
			   $rating_speed_results = 3;
		   }
		   
		   else if($speed == "Average")
		   {
			   $rating_speed_results = 2;
		   }
		   
		   else if($speed == "Dissatisfied")
		   {
			   $rating_speed_results = 1;
		   }
		   
   $experience = $_POST['experience'];
   if($experience == "Excellent")
   {
	   $rating_experience_results = 4;
   }
   
   else if($experience == "Good")
   {
	   $rating_experience_results = 3;
   }
   
   else if($experience == "Average")
   {
	   $rating_experience_results = 2;
   }
   
   else if($experience == "Dissatisfied")
   {
	   $rating_experience_results = 1;
   } 
   
   $msg = $_POST['msg'];
   

   $rating_query = mysqli_query($connect, "SELECT * FROM `rating` WHERE rating_date = $date, rating_food = $food, rating_service = $service, rating_order = $order, rating_speed = $speed, rating_experience = $experience, rating_msg = $msg");
  
   $rating_results = (($rating_food_results + $rating_service_results + $rating_order_results + $rating_speed_results + $rating_experience_results) / 5);
   
   if($rating_query)
   {
      $message[] = 'Already Submmited';
   }
   
   else{
	   
	  $insert_query = mysqli_query($connect, "INSERT INTO `rating`(user_id, rating_date, rating_food, rating_service, rating_order, rating_speed, rating_experience, rating_msg, rating_results) 
	  VALUES('$user_id', '$date', '$food', '$service', '$order', '$speed', '$experience', '$msg', '$rating_results')");
	
      $message[] = 'Thanks For Your Rating!';
   }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Rating Form</title>
	<link rel="stylesheet" href="main.css"/>
<style>
body{
        height: 100vh;
        background-color: #000000;
        font-family:sans-serif;
		display: block;
}
h1{
	font-family: Average;
	font-size:40px;
    color : #DCDCDC;
	text-align: center;
	padding-top: 10px;
}
h2{
	font-family: "Comic Sans MS";
    color : #DCDCDC;
	text-align: center;
	margin-bottom:50px;
}

input[type="radio"]{
  margin: 0 2px 20px 40px;
}

.box{
	text-align: center;
  padding: 10px 20px 20px 10px;
  color : white;
  width: 650px;
  height: 50px;
  color : white;
}

.box p{
	font-weight:bold;
	font-family:Times New Roman;
	font-size:18px;
}

.suggest{
	position: relative;
	top: 40px;
    color : white;
    font-size:30px;
    line-height : 10px;
    padding-left: 850px;

}

.submitbtn{
	background-color: #f42f2c;
        line-height: 42px;
        margin-bottom: 15px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
        color: #fff;
        display: inline-block;
        font-size: 20px;
        font-weight: 500;
        position: relative;
		cursor: pointer;
}

.submitbtn:hover{
	background-color:#E06666;
}

.rate{
	display: flex;
	flex-direction: column;
	position: absolute;
	top: 220px;
	padding-left: 20px;
}

.button{
	border: 1px solid white;
	padding-bottom: 35px;
}

.date-visit, .cus-name{
	width:120px;
	height:30px;
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

.cus-name{
	float:left;
	margin-top:25px;
	margin-left:100px;
	color:#B4A7D6;
	font-size:10px;
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
	
    <h1>Please Review Us</h1>
    <h2>Please let us know how was the food and service.</h2>

     <form action="" method="post">  
	<div class = "suggest"><p style="font-family: Cambria;">Any comments, questions or suggestions? </p>
    <p><textarea name="msg" cols = "70" rows = "13"placeholder = "Type Here......"></textarea></p>
    <p><input type ="submit" name = "send" value = "Submit" class="submitbtn" required></p></div>	 
	
	<div class="rate">
    <div class = "box">
	<?php
      $results = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$user_id'");
	  if ($results) {
          $row_view = mysqli_fetch_assoc($results); 
   ?>
		<p class="cus-name" style="font-size:20px; ">Name : <?php echo $row_view['users_name']; ?></p>
	
	<?php
      }
   ?>
   
   <p style="color:#B4A7D6; font-size:20px;">Day Ordered : <input class="date-visit" type = "date" name = "date_visit"/></p>
	</div>
	<div class ="button">
    <div class = "box"><p>Food Quality</p>
                   <input type = "radio" name = "food" value = "Excellent"/>Excellent
                   <input type = "radio" name = "food" value = "Good"/>Good
                   <input type = "radio" name = "food" value = "Average"/>Average
                   <input type = "radio" name = "food" value = "Dissatisfied"/>Dissatisfied</div>
                   
    <div class = "box"><p>Overall Service Quality</p>
                              <input type = "radio" name = "service" value = "Excellent"/>Excellent
                              <input type = "radio" name = "service" value = "Good"/>Good
                              <input type = "radio" name = "service" value = "Average"/>Average
                              <input type = "radio" name = "service" value = "Dissatisfied"/>Dissatisfied</div>
                              
    <div class = "box"><p>Order Accuracy</p>
                      <input type = "radio" name = "order" value = "Excellent"/>Excellent
                      <input type = "radio" name = "order" value = "Good"/>Good
                      <input type = "radio" name = "order" value = "Average"/>Average
                      <input type = "radio" name = "order" value = "Dissatisfied"/>Dissatisfied</div>
                      
    <div class = "box"><p>Speed of Service</p>
                      <input type = "radio" name = "speed" value = "Excellent"/>Excellent
                      <input type = "radio" name = "speed" value = "Good"/>Good
                      <input type = "radio" name = "speed" value = "Average"/>Average
                      <input type = "radio" name = "speed" value = "Dissatisfied"/>Dissatisfied</div>
                      
    <div class = "box"><p>Overall Experience</p>
                      <input type = "radio" name = "experience" value = "Excellent"/>Excellent
                      <input type = "radio" name = "experience" value = "Good"/>Good
                      <input type = "radio" name = "experience" value = "Average"/>Average
					  <input type = "radio" name = "experience" value = "Dissatisfied"/>Dissatisfied</div>
	</div>
	</div>
</form>
</body>
</html>