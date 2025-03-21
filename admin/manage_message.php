<?php include("dataconnection.php");

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   $delete_order = mysqli_query($connect, "DELETE FROM `messages` WHERE messages_id = $delete_id");
   header("Location: manage_message.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Messages</title>
<style>
body 
{
	color: #566787;
	font-family: 'Varela Round', sans-serif;
	background-image: url("Image_admin/white1.jpg");
}

.messages .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   gap:1.5rem;
   justify-content: center;
   align-items: flex-start;
}

.messages .box-container .box{
	font-family:Average;
   background-color: white;
   border-radius: .5rem;
   border:1px solid black;
   padding:2rem;
   padding-top: 1rem;
}

.messages .box-container .box p{
   padding: .5rem 0;
   font-size: 1.8rem;
   color:black;
}

.messages .box-container .box p span{
   color:blue;
}

.delete-button{
   display: block;
   width: 94%;
   text-align: center;
   background-color: #CC0000;
   color:white;
   font-size: 1.7rem;
   padding:10px 10px;
   border-radius: 0.5rem;
   cursor: pointer;
   margin-top: 1rem;
   text-decoration: none;
}

.delete-button:hover{
	background-color:#E06666;
}

.heading{
	font-family:Comic Sans MS;
  text-align: center;
   margin-bottom: 2rem;
   text-transform: capitalize;
   color:black;
   font-size: 3rem;
}

.empty{
   border:1px solid black;
   border-radius: .5rem;
   background-color: white;
   padding:1.5rem;
   text-align: center;
   width: 100%;
   font-size: 2rem;
   text-transform: capitalize;
   color:red;
}

.button-img{
	cursor: pointer;
	width:130px;
	height:60px;
	padding:5px;
}
</style>
</head>
<body>
<a href="admin_dashboard.php" class="back-button"><img src="Image_admin/backbutton.png" alt="" class="button-img"></a>
<section class="messages">

   <h1 class="heading">Manage Messages</h1>

   <div class="box-container">

   <?php
	  $view_messages = mysqli_query($connect, "SELECT * FROM `messages`");
      if(mysqli_num_rows($view_messages) > 0)
	  {
         while($row = mysqli_fetch_assoc($view_messages))
		 {
   ?>
   
   <div class="box">
      <p> User ID      : <span><?= $row['user_id']; ?></span> </p>
      <p> Name         : <span><?= $row['messages_name']; ?></span> </p>
      <p> Phone Number : <span><?= $row['messages_number']; ?></span> </p>
      <p> Email        : <span><?= $row['messages_email']; ?></span> </p>
	  <p> Subject      : <span><?= $row['messages_subject']; ?></span> </p>
      <p> Message      : <span><?= $row['messages_text']; ?></span> </p>
      <a href="manage_message.php?delete=<?= $row['messages_id']; ?>" class="delete-button" onclick="return confirm('Do you want to delete this message?');">Delete</a>
   </div>
   
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>

   </div>

</section>

</body>
</html>