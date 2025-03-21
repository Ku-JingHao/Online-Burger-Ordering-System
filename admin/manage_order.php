<?php include("dataconnection.php");

if(isset($_POST['update-payment'])){

   $order_id = $_POST['order-id'];
   $payment_status = $_POST['payment-status'];

   $update_status = mysqli_query($connect, "UPDATE `order` SET order_payment_status = '$payment_status' WHERE order_id = '$order_id'");

   $message[] = 'Order Payment Status Has Updated!';

}

if(isset($_GET['delete']))
{
   $delete_id = $_GET['delete'];
   $delete_order = mysqli_query($connect, "DELETE FROM `order` WHERE order_id = $delete_id");
   header("Location: manage_order.php");
   
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Order</title>
<style>
body {

	color: #566787;
	background: #f5f5f5;
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
	padding-bottom: 15px;
	background:	#708090;
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
	padding: 12px 20px;
	vertical-align: middle;
}

.Viewbtn, .Deletebtn, .Updatebtn{
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
		text-decoration: none;
		font-family:Average;
}

.Deletebtn{
	background-color: red;
}

.Viewbtn{
	background-color:#87CEFA;
}

.Cancel-button{
   display: block;
   width: 100%;
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

.Cancel-button:hover, .Deletebtn:hover{
	background-color:#E06666;
}

.Viewbtn:hover{
	background-color:#A2C4C9;
}

.Updatebtn:hover{
	background-color:#F6B26B;
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

.status{
	  text-align: center;
}

select{
	width:100%; height:45px;
}
.price{
	text-align:center;
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

.view-container{
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


.view-container form{
   width: 50rem;
   border-radius: .5rem;
   background-color: white;
   text-align: center;
   padding:1.5rem;
   font-size:20px;
   font-family:Times New Roman;
   border:2px solid black;
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
						<h2>Manage <b>Order</b></h2>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Order Date/Time</th>
						<th>Customer Name</th>
						<th>Total Price</th>
						<th>Order Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php
         
				$results = mysqli_query($connect, "SELECT * FROM `order`");
				if(mysqli_num_rows($results) > 0){
                while($row = mysqli_fetch_assoc($results)){
					
				?>
				
					<tr>
						<td><?php echo $row['order_id']; ?></td>
						<td><?php echo $row['order_date']; ?></td>
						<td><?php echo $row['order_name']; ?></td>
						<td class="price">RM <?php echo number_format ($row['order_total_price'],2); ?></td>
						
						<form action="" method="POST">
						<input type="hidden" name="order-id" value="<?= $row['order_id']; ?>">
						<td class="status">
						<select name="payment-status" class="drop-down">
							<option value="" selected disabled><?= $row['order_payment_status']; ?></option>
							<option value="Pending">Pending</option>
							<option value="Completed">Completed</option>
						</select></td>
						<div class="flex-btn">
							<td><a href="manage_order.php?view=<?= $row['order_id']; ?>" class="Viewbtn">View</a></td>
							<td><a href="manage_order.php?delete=<?= $row['order_id']; ?>" class="Deletebtn" onclick="return confirm('Are You Sure You Want To Delete This Order?');">Delete</a></td>
							<td><input type="submit" value="Update" class="Updatebtn" name="update-payment"></td>	
						</div>
						</form>
						
					</tr>	
				<?php
				};
					}
				else
				{
					echo '<p class="empty">no orders placed yet!</p>';
				}
				?>	
				
				</tbody>
			</table>
	</div>        
</div>
</div>

<div class="view-container">

   <?php
   
   if(isset($_GET['view'])){
      $view_items = $_GET['view'];
      $view_query = mysqli_query($connect, "SELECT * FROM `order` WHERE order_id = $view_items");
      if(mysqli_num_rows($view_query) > 0)
	  {
         while($row_view = mysqli_fetch_assoc($view_query))
		 {
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <p> Order Date : <span><?= $row_view['order_date']; ?></span> </p>
      <p> Name : <span><?= $row_view['order_name']; ?></span> </p>
      <p> Email : <span><?= $row_view['order_email']; ?></span> </p>
      <p> Phone Number : <span><?= $row_view['order_phone_number']; ?></span> </p>
      <p> Address : <span><?= $row_view['order_address'];?>,</span> <span><?=$row_view['order_zip'];?>,</span>  <span><?=$row_view['order_city'];?>,</span> <span><?=$row_view['order_state'];?></span> </p>
      <p> Total Product : <span><?= $row_view['order_total_products']; ?></span> </p>
      <p> Total Price : <span>RM<?= number_format ($row_view['order_total_price'],2); ?></span> </p>
      <p> Payment Method : <span><?= $row_view['payment_method']; ?></span> </p>
	  <p> Payment Status : <span style="color:<?php if($row_view['order_payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $row_view['order_payment_status']; ?></span></p>
	  <p> Additional Notes : <span><?= $row_view['order_notes']; ?></span> </p>
      <input style="width:100%;" type="reset" value="Cancel" id="close-edit" class="Cancel-button">
   </form>

   <?php
            };
         };
         echo "
		 <script>
		document.querySelector('.view-container').style.display = 'flex';
		document.querySelector('#close-edit').onclick = () =>{
		document.querySelector('.view-container').style.display = 'none';
		window.location.href = 'manage_order.php';
};		 </script>";
      };
   ?>

</div>

</body>
</html>