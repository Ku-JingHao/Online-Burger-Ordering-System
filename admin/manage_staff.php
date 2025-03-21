<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};

if(isset($_POST['update_admin'])){
   $update_id = $_POST['update_id'];
   $update_name = $_POST['update_name'];
   $update_email = $_POST['update_email'];
   $update_number = $_POST['update_number'];

   if(!empty($update_name))
   {
      $update_names = mysqli_query($connect, "UPDATE `admin` SET admin_Name = '$update_name' WHERE id = '$admin_id'");
   }

   if(!empty($update_email))
   {
       $update_emails = mysqli_query($connect, "UPDATE `admin` SET admin_Email = '$update_email' WHERE id = '$admin_id'");
   }

   if(!empty($update_number))
   {
      $update_numbers =  mysqli_query($connect, "UPDATE `admin` SET admin_Number = '$update_number' WHERE id = '$admin_id'");
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = mysqli_query($connect, "SELECT admin_Pwd FROM `admin` WHERE id = '$admin_id'");
   $fetch_prev_pass = mysqli_fetch_assoc($select_prev_pass);
   $prev_pass = $fetch_prev_pass['admin_Pwd'];
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
			$update_pass = mysqli_query($connect, "UPDATE `admin` SET admin_Pwd = '$confirm_pass' WHERE id = '$admin_id'");
            $message[] = 'Password Has Been Updated Successfully!';
         }
		 else
		 {
            $message[] = 'Please Enter A New Password!';
         }
      }
   } 
  
};

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   $delete_users = mysqli_query($connect, "DELETE FROM `admin` WHERE id = $delete_id");
   header("Location: manage_staff.php");
   
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Member</title>
<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
	background-image: url("Image/white1.jpg");
	background-repeat: no-repeat;
    background-size: cover;
}

h2{
	text-align: center;
}
.container{
	padding-top: 40px;
	padding-right:80px;
	padding-left: 80px;
}

.table{
	width:100%;
	text-align:center;
}

thead{
	font-family:Comic Sans MS;
	font-size:16px;
}

tbody{
	font-family:Average;
	font-size:16px;
}

table.table tr td:last-child {
	padding-left: 10px;
}

.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1100px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {    
	font-family:Average;    
	padding-bottom: 15px;
	background:	#0B5394;
	color: #fff;
	padding: 12px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}

.table-title h2 {
	margin: 5px 0 0;
	font-size: 30px;
}


table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 15px 20px;
	vertical-align: middle;
}


.Addbtn, .Viewbtn, .Deletebtn, .Updatebtn{
		background-color: orange;
        line-height: 35px;
        margin-top: 10px;
        padding-left: 30px;
        padding-right: 30px;
        border: none;
        color: #fff;
        display: inline-block;
        font-size: 18px;
        font-weight: bold;
        position: relative;
		cursor: pointer;
		text-decoration:none;
}

.Deletebtn{
	background-color: red;
}

.Deletebtn:hover{
	background-color:#E06666;
}

.Updatebtn:hover{
	background-color:#F6B26B;
}

.Addbtn{
	background-color: Green;
}

.Viewbtn{
	background-color:#87CEFA;
}

#form {
	width: 250px;
	height: 30px;
	display: flex;
	float: right;
	position: relative;
	bottom:30px;
	cursor: pointer;
}

.hint-text{
	padding-left: 10px;
}

.pagination {
    display: flex;
    float: right;
	position: relative;
	bottom:20px;
}

.pagination a {
	color: black;
	float: left;
	padding: 8px 16px;
    text-decoration: none;
	font-size: 15px;
}

.pagination a:hover{
	color: red;
}

.button-img{
	cursor: pointer;
	width:130px;
	height:60px;
	padding:5px;
}

/* update */
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
   width: 40rem;
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

.delete-button:hover{
	background-color:#E06666;
}

.delete-button{
   margin-top: 0;
   background-color: red;
}

.option-button{
	background-color: orange;
}

/* Message */
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

.empty{
	font-family:Average;
	font-size:20px;
}

</style>

</head>
<body>
<a href="admin_dashboard.php" class="back-button"><img src="Image_admin/backbutton.png" alt="" class="button-img"></a>

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

<div class="container">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
						<h2>Manage <b>Staff</b></h2>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Password</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php
         
				$results = mysqli_query($connect, "SELECT * FROM `admin`");
				if(mysqli_num_rows($results) > 0){
                while($row = mysqli_fetch_assoc($results)){
					
			?>
				
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['admin_Name']; ?></td>
						<td><?php echo $row['admin_Email']; ?></td>
						<td><?php echo $row['admin_Number']; ?></td>
						<td>******</td>
						
						<form action="" method="POST">
						<input type="hidden" name="admin-id" value="<?= $row['id']; ?>">
						<div class="flex-btn">
							<td><a href="manage_staff.php?delete=<?= $row['id']; ?>" class="Deletebtn" onclick="return confirm('Are You Sure You Want To Delete This Admin Account?');">Delete</a></td>
							<td><a href="manage_staff.php?updated=<?php echo $row['id']; ?>" class="Updatebtn">Update</a></td>	
						</div>
						</form>
						
					</tr>	
				<?php
				};
					}
				else
				{
					echo '<p class="empty">No Admin Account Yet!</p>';
				}
				?>	
				
				</tbody>
			</table>
	</div>        
</div>
</div>

<div class="update-container">

   <?php
   
   if(isset($_GET['updated'])){
      $update_acc = $_GET['updated'];
      $update_query = mysqli_query($connect, "SELECT * FROM `admin` WHERE id = $update_acc");
      if(mysqli_num_rows($update_query) > 0)
	  {
         while($row_update= mysqli_fetch_assoc($update_query))
		 {
   ?>

   <form action="" method="post" enctype="multipart/form-data">
	  <p style="font-size:40px; font-weight:bold; font-family:Comic Sans Mc;"> Update Admin Account </p>
      <input type="hidden" name="update_id" value="<?php echo $row_update['id']; ?>">
      <input type="text" class="row" required name="update_name" value="<?php echo $row_update['admin_Name']; ?>">
      <input type="email" class="row" required name="update_email" value="<?php echo $row_update['admin_Email']; ?>"> 
	  <input type="tel" required name="update_number" class="row" value="<?php echo $row_update['admin_Number']; ?>">
	  <input type="password"  name="old_pass" placeholder="Enter Your Old Password" class="row">
	  <input type="password"  name="new_pass"  class="row"  pattern="^(?=.*[A-Za-z]{3})(?=.*\d{3}).{6,}$" placeholder="Create Your Password*" title="At Least Three Character and Three Digit">
	  <input type="password"   name="cpass" placeholder="Confirm Your Password*" class="row" >
		
      <input type="submit" value="Update Admin Account" name="update_admin" class="button">
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
		window.location.href = 'manage_staff.php';
};		 </script>";
      };
   ?>

</div>


</body>
</html>