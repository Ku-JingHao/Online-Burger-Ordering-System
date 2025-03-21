<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['update_customer'])){
   $update_id = $_POST['update_id'];
   $update_name = $_POST['update_name'];
   $update_name = filter_var($update_name, FILTER_SANITIZE_STRING);
   $update_email = $_POST['update_email'];
   $update_email = filter_var($update_email, FILTER_SANITIZE_STRING);
   $update_number = $_POST['update_number'];
   $update_number = filter_var($update_number, FILTER_SANITIZE_STRING);
   
   if(!empty($update_name)){
      $update_names = mysqli_query($connect, "UPDATE `users` SET users_name = '$update_name' WHERE id = '$user_id'");
   }

   if(!empty($update_email)){
      $select_email = mysqli_query($connect, "SELECT * FROM `users` WHERE users_email = '$update_email'");
	  if(mysqli_num_rows($select_email) > 0)
	  {
         $message[] = 'Email Already Taken!';
      }
	  
	  else{
         $update_emails = mysqli_query($connect, "UPDATE `users` SET users_email = '$update_email' WHERE id = '$user_id'");
      }
   }

   if(!empty($update_number))
   {
      $select_number = mysqli_query($connect, "SELECT * FROM `users` WHERE users_number = '$update_number'");

       if(mysqli_num_rows($select_number) > 0)
	  {
         $message[] = 'Number Already Taken!';
      }
	  else
	  {
         $update_numbers =  mysqli_query($connect, "UPDATE `users` SET users_number = '$update_number' WHERE id = '$user_id'");
      }
   }
   

	
};

?>

<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" href="main.css"/>
<style>
body{
	background-color: #000000;
	color:white;
    font-family:sans-serif;
}

/*message*/
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

.title{
	text-align:center;
	margin-top:30px;
	font-family: Average;
	font-size:50px;
}

.user{
	font-family: Average;
	border : 1px solid grey;
	width:30%;
	background-color: white;
	color:black;
	text-align:center;
	margin:0 auto;
	padding-top:30px;
	padding-bottom:40px;
	font-size:23px;
}

.user img{
	width:200px;
	height:200px;
}

.Updatebtn{
		background-color: orange;
        line-height: 50px;
        margin-top: 10px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
        color: #fff;
        display: inline-block;
        font-size: 23px;
        font-weight: bold;
        position: relative;
		cursor: pointer;
		text-decoration:none;
}

.Updatebtn:hover, .changebtn:hover{
	background-color:#F6B26B;
	color:white;
}

.changebtn{
	background-color: orange;
	margin-left:10px;
	padding:0 8px 0 8px ;
        line-height: 50px;
        border: none;
        color: #fff;
        display: inline-block;
        font-size: 25px;
        font-weight: bold;
        position: relative;
		cursor: pointer;
		text-decoration:none;
}

.update-container{
   position: fixed;
   top:0; 
   left:0;
   z-index: 1100;
   background-color: transparent;
   padding:2rem;
   display: none;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   width: 100%;
}

.update-container form{
   width: 30rem;
   border-radius: .5rem;
   background-color: white;
   text-align: center;
   padding:2rem;
}

.update-container form .row{
   width: 270px;
   background-color: white;
   border-radius: .5rem;
   margin:1rem 0;
   font-size: 1.3rem;
   color:black;
   padding:1.2rem 1.4rem;
   text-transform: none;
   font-family:Average;
}

.button,.option-button,.delete-button{
   display: block;
   width: 100%;
   text-align: center;
   background-color: #2E8B57;
   color:white;
   font-size: 1.3rem;
   padding:1.2rem 3rem;
   border-radius: 0.5rem;
   cursor: pointer;
   margin-top: 1rem;
   text-decoration: none;
  font-family:Average;
}

.option-button,.delete-button{
	width: 50%;
}

.button:hover{
   background-color: #86BF99;
}

.option-button:hover{
	background-color:#F6B26B;
}


.option-button{
	background-color: orange;
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

<section class="user-details">

   <h1 class="title">My Profile</h1>

   <div class="box-container">

   <?php
      $results = mysqli_query($connect, "SELECT * FROM `users` WHERE id = '$user_id'");
	  if ($results) {
          $row_view = mysqli_fetch_assoc($results); 
   ?>
   <div class="user">
      <img src="Image/user-icon.png" alt="">
      <p><b>Name  : </b><span style="color:#674EA7;"><?php echo $row_view['users_name']; ?></span></p>
	  <p><b>Email : </b><span style="color:#674EA7;"><?php echo $row_view['users_email']; ?></span></p>
	  <p><b>Phone Number : </b><span style="color:#674EA7;"><?php echo $row_view['users_number']; ?></span></p>
	  <p><b>Birth Date : </b><span style="color:#674EA7;"><?php echo $row_view['users_birth_date']; ?></span></p>
	  <p><b>Gender : </b><span style="color:#674EA7;"><?php echo $row_view['users_gender']; ?></span></p>
      <form action="" method="POST">
		<input type="hidden" name="user-id" value="<?= $row_view['id']; ?>">
		  <div class="flex-btn">
			<a href="myprofile.php?updated=<?php echo $row_view['id']; ?>" class="Updatebtn">Update Profile</a>	
			<a href="change_password.php" class="changebtn">Change Password</a>	
		  </div>
	  </form>
   </div>
   </div>
    <?php
      }
   ?>

</section>

<div class="update-container">

   <?php
   
   if(isset($_GET['updated'])){
      $update_acc = $_GET['updated'];
      $update_query = mysqli_query($connect, "SELECT * FROM `users` WHERE id = $update_acc");
      if(mysqli_num_rows($update_query) > 0)
	  {
         while($row_update= mysqli_fetch_assoc($update_query))
		 {
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_id" value="<?php echo $row_update['id']; ?>">
      <input type="text" class="row" required name="update_name" value="<?php echo $row_update['users_name']; ?>">
      <input type="email" class="row" required name="update_email" value="<?php echo $row_update['users_email']; ?>"> 
	  <input type="tel" required name="update_number" class="row" value="<?php echo $row_update['users_number']; ?>">
      <input type="submit" value="Update Customer Account" name="update_customer" class="button">
      <input style="width:100%;" type="reset" value="Cancel" id="close-edit" class="option-button">
   </form>

   <?php
            };
         };
         echo "
		 <script>
		document.querySelector('.update-container').style.display = 'flex';
		document.querySelector('#close-edit').onclick = () =>{
		document.querySelector('.update-container').style.display = 'none';
		window.location.href = 'myprofile.php';};		
		</script>";
      };
   ?>

</div>

</body>
</html>