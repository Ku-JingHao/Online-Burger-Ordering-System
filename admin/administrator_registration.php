<?php include("dataconnection.php");
session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};

if(isset($_POST['btnSubmit'])){

   $Name = $_POST['Name'];
   $Name = filter_var($Name, FILTER_SANITIZE_STRING);
   $Email = $_POST['Email'];
   $Email = filter_var($Email, FILTER_SANITIZE_STRING);
   $Number = $_POST['Number'];
   $Number = filter_var($Number, FILTER_SANITIZE_STRING);
   $Pwd = sha1($_POST['Pwd']);
   $Pwd = filter_var($Pwd, FILTER_SANITIZE_STRING);

   
   $select_user = mysqli_query($connect, "SELECT * FROM `admin` WHERE admin_Email = '$Email' OR admin_Number = '$Number'");
   $row = mysqli_fetch_assoc($select_user);
	
   if(mysqli_num_rows($select_user) > 0)
   {
      $message[] = 'Email or Phone Number already exists!';
   }
   else
   {
		 $insert_query = mysqli_query($connect, "INSERT INTO `admin`(admin_Name, admin_Email, admin_Number, admin_Pwd) 
		 VALUES('$Name', '$Email', '$Number', '$Pwd')");
		 
		 $select_user = mysqli_query($connect, "SELECT * FROM `admin` WHERE admin_Email = '$Email' AND admin_Pwd = '$Pwd'");
		 $row = mysqli_fetch_assoc($select_user);
		 
          if(mysqli_num_rows($select_user) > 0){
            $_SESSION['admin_id'] = $row['id'];
         }
      }
   }


?>

<!DOCTYPE html>
<HTML>
<HEAD>
    <title>Registration</title>
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

.email, .name, .phoneNumber{
	width: 500px;
	height: 50px;
	padding: 10px 20px;
	margin: 5px 0;
	display: inline-block;
	border: 1px solid black;
	box-sizing: border-box;
}


.password{
	width: 500px;
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


.register_btn{
       border: 1px solid black;
	background: transparent;
	color: black;
	display: block;
	line-height: 40px;
	width:130px;
	font-size: 20px;
}

.register_btn:hover{

	background: black;
    color: white;
	cursor: pointer;
}


.form p{
	font-size:20px;
}

.register-link{
	text-decoration:none;
	color:red;
}


</style>
</head>
<body>

		<div class="form">
<form name="RegistrationFrm" method="post" action="#">
		<h4>Admin Registration Form</h4>
		<p><b>Name :</b><br/><input type="name" name="Name" placeholder="Enter Your Name*" class="name" required></p>
        <p><b>Email  : </b><br/><input type="email" name="Email" placeholder="Enter Your Email*" class="email" required></p>
        <p><b>Phone Number:</b><br/><input type="tel" name="Number" pattern="[0-9]{3}-[0-9]{7}" placeholder="011-2345678" class="phoneNumber" required></p>
		<p><b>Password : (at least three character and three digits)</b><br/><input type="password"  name="Pwd" placeholder="Enter Your Password*" class="password" pattern="^(?=.*[A-Za-z]{3})(?=.*\d{3}).{6,}$" title="At Least Three Character and Three Digit" required></p>
		<p><input type="submit" name="btnSubmit" value="Register &#x2192" class="register_btn"></p>
        <p>You Can Now Proceed To Login<a href="administrator_login.php" class="register-link">&nbsp; Proceed to login</a></p>
</form>
		</div>

</body>
</html>