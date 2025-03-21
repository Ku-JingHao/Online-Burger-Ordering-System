<?php include("dataconnection.php");

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   $delete_order = mysqli_query($connect, "DELETE FROM `rating` WHERE rating_id = $delete_id");
   header("Location: manage_rating.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Product</title>
<style>
body {

	color: #566787;
	font-family: 'Varela Round', sans-serif;
	background-image: url("Image_admin/white1.jpg");
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

h1{
	text-align:center;
	font-family:Comic Sans MS;
	font-size:40px;
}

.container{
   max-width: 1200px;
   margin:0 auto;
   padding-bottom: 5rem; 
}

.product-table table{
   width: 100%;
   text-align: center;
   background-color: #F3F3F3;
}

.product-table table thead th{
   padding:1.5rem;
   font-size: 2rem;
   background-color: #783F04;
   color:white;
   font-family: Comic Sans MS;
}

.product-table table td{
   padding:1.5rem;
   font-size: 2rem;
   color:black;
   font-family: Average;
}

.product-table table td:first-child{
   padding:0;
}

.product-table table tr:nth-child(even){
   background-color: #F9CB9C;
}

.product-table table td:nth-child(2){
   padding:0 1px 0 1px;
}


.product-table .empty{
   margin-bottom: 2rem;
   text-align: center;
   background-color: #CCCCCC;
   color:black;
   font-size: 2rem;
   padding:1.5rem;
}

.button-img{
	cursor: pointer;
	width:130px;
	height:60px;
	padding:5px;
}

.delete-button{
   display: block;
   width: 50%;
   text-align: center;
	background-color: red;
   color:white;
   font-size: 1.7rem;
   padding:1.2rem 3rem;
   border-radius: 0.5rem;
   cursor: pointer;
   margin-top: 1rem;
   text-decoration: none;
}

.delete-button:hover{
	background-color:#E06666;
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

</style>

</head>
<body>
<a href="admin_dashboard.php" class="back-button"><img src="Image_admin/backbutton.png" alt="" class="button-img"></a>

<div class="container">

<section class="product-table">
	<h1>Manage Rating</h1>
   <table>

      <thead>
		 <th>User ID</th>
         <th>Date Visited</th>
         <th>Food Quality</th>
		 <th>Overall Service Quality</th>
		 <th>Order Accuracy</th>
		 <th>Speed of Service</th>
		 <th>Overall Experience</th>
		 <th>Comments</th>
		 <th>Results (4.0)</th>
         <th>Action</th>
      </thead>

      <tbody>
	  <?php
	  $view_rating = mysqli_query($connect, "SELECT * FROM `rating`");
      if(mysqli_num_rows($view_rating) > 0)
	  {
         while($row = mysqli_fetch_assoc($view_rating))
		 {
	  ?>
         <tr>
			<td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['rating_date']; ?></td>
            <td><?php echo $row['rating_food']; ?></td>
			<td><?php echo $row['rating_service']; ?></td>
			<td><?php echo $row['rating_order']; ?></td>
			<td><?php echo $row['rating_speed']; ?></td>
			<td><?php echo $row['rating_experience']; ?></td>
			<td><?php echo $row['rating_msg']; ?></td>
			<td><?php echo number_format($row['rating_results'],2); ?></td>
            <td>
               <a href="manage_rating.php?delete=<?= $row['rating_id']; ?>" class="delete-button" onclick="return confirm('Do you want to delete this rating?');">Delete</a>
            </td>
         </tr>
		 
		 <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
		?>
		 
      </tbody>
   </table>

</section>

</div>
</body>
</html>