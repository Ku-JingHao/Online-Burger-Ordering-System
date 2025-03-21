<?php include("dataconnection.php");

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['order_button'])){
	
if($user_id == ''){
      header('location:login.php');
   }

   else{
   $msg = $_POST['msg'];   
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zip = $_POST['zip'];

   $cart_query = mysqli_query($connect, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
   $price_total = 0;
   
   if(mysqli_num_rows($cart_query) > 0)
   {
      while($cart_item = mysqli_fetch_assoc($cart_query))
	  {
         $product_name[] = $cart_item['cart_name'] .' ('. $cart_item['cart_quantity'] .') ';
         $product_price = ($cart_item['cart_price'] * $cart_item['cart_quantity']);
         $price_total += $product_price;
		 $grand_total = $price_total + 10;
      };
   };
   
   
   
   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($connect, "INSERT INTO `order`(user_id, order_name, order_phone_number, order_email, order_notes, payment_method, order_address, order_city, order_state, order_zip, order_total_products, order_total_price) 
   VALUES('$user_id', '$name','$number','$email', '$msg', '$method','$address','$city','$state','$zip','$total_product','$grand_total')");

   if($cart_query && $detail_query)
   {  
		
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>Thank You For Shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> Total : RM ".number_format($price_total + 10,2)."  </span>
         </div>
         <div class='customer-details'>
            <p> Your Name : <span>".$name."</span> </p>
            <p> Your Phone Number : <span>".$number."</span> </p>
            <p> Your Email : <span>".$email."</span> </p>
            <p> Your Address : <span>".$address.", ".$zip.", ".$city.", ".$state."</span> </p>
            <p> Your Payment Method : <span>".$method."</span> </p>
			<p> Payment Status : <span style='color:red;'>Pending</span> </p>
			<p> Additional Notes : <span>".$msg."</span> </p>
            <p><b>**Your order will usually be delivered within 20 minutes</b></p>
			<p><b>***For Reminder : Please Take A Screenshot of This Receipt For Your References</b></p>
         </div>
            <a href='menu.php' class='option-button'>Continue Shopping</a>
			<p><a href='rating.php'><button class='btn2'>Rate For Us</button></a></p>
         </div>
      </div>
      ";
   }
   }
}

?>

<!DOCTYPE html>
<HTML>
<HEAD>
	<title>Checkout Form</title>
<style>
body{
  background-color:black;
  padding-left: 50px;
  padding-right: 40px;
 }
 
.heading{
	text-align:center; 
	color : white;
	font-family: Comic Sans MS;
	font-size:40px;
	text-transform: uppercase;
 }
 
.row{
  display: flex;
  flex-wrap: wrap;
  margin: 0 -16px;
  padding-left: 16px;
  padding-right: 16px;
 }
  
.zip-state {
  display: flex;
  flex-wrap: wrap;
  margin: 0 -16px;
  padding-right: 5px;
}

.col-25 {

  flex: 30%;
}

.col-50 {
  flex: 25%;
}

.col-75 {

  flex: 75%;
}

.col-25, .col-50, .col-75 {
  padding: 0 16px;
}

.container {
  background-color: black;
  padding: 5px 15px 15px;
  border: 1px solid lightgrey;
  border-radius: 3px;
  padding-left: 15px;
}

input[type=text] {
  width: 80%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

input[type=tel] {
  width: 80%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
  color:white
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn, .btn1{
  background-color: #CC0000;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width:41%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
  font-family:Comic Sans MS;
  margin-left:12px;
}

.btn:hover, .btn1:hover{
  background-color: #E06666;
}

.btn{
	float:right;
	margin-right:105px;
	margin-top: 25px;
}
span.price {
  float: right;
  color: white;
  padding-right: 15px;
}

span.delivery-fees {
  float: right;
  padding-right: 15px;
}

h4, h3, p{color:white;}

.payment-type{
  width:84%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

option{
	font-family:Average;
}


.option-button{
   text-align: center;
   background-color: orange;
   color:white;
   font-size: 35px;
   padding:10px 10px;
   cursor: pointer;
   text-decoration:none;
   font-family: Anton;
}

.option-button:hover{
	background-color:#F6B26B;
	color:white;
}

.btn2{
    text-align: center;
    background-color:  #CC0000;
    color: white;
    font-size: 30px;
    padding: 10px 10px;
    cursor: pointer;
    width: 46.8%;
    margin-top: 10px;
    height: 60px;
    text-decoration: none;
	font-family: Anton;
}

.btn2:hover{
	background-color:#E06666;
}

.order-message-container{
   height: 100vh;
   position: fixed;
   top:0; left:0;
   overflow-x: hidden;
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: center;
   z-index: 1100;
   background-color: transparent;
   color:white;
   width: 100%;
}

.order-message-container .message-container{
   overflow-y: scroll;
   height: 70%;
   width: 40rem;
   background-color: black;
   color:white;
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
}

.order-message-container .message-container h3{
   font-size: 2.5rem;
   color:white;
   font-family: Average;
}

.order-message-container .message-container .order-detail{
   background-color: grey;
   border-radius: .5rem;
   padding:1rem;
   margin:1rem 0;
}

.order-message-container .message-container .order-detail span{
   background-color: white;
   border-radius: .5rem;
   color:black;
   font-size: 1.6rem;
   display: inline-block;
   padding:1rem 1.5rem;
   margin:1rem;
}

.order-message-container .message-container .order-detail span.total{
   display: block;
   background: red;
   color:white;
}

.order-message-container .message-container .customer-details{
   margin:1.5rem 0;
}

.order-message-container .message-container .customer-details p{
   padding:1rem 0;
   font-size: 1.5rem;
   color:white;
}

.order-message-container .message-container .customer-details p span{
   padding:.5rem;
   text-transform: none;
}

.checkout-form{
	padding-left:50px;
}

.mess{
	margin-left:18px;
}

</style>
</head>
<body>
<div class="col-25">
  		<h1 class="heading">Complete Your Order</h1>
    <div class="container">
	   <?php
			$select_rows = mysqli_query($connect, "SELECT * FROM `cart`");
			$row_count = mysqli_num_rows($select_rows);
	   ?>
      <h4>Cart
        <span class="price" style="color:white">
          <i class="fa fa-shopping-cart"></i>
          <b><?php echo $row_count; ?></b>
        </span>
      </h4>
	  <?php
         $result = mysqli_query($connect, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
		 
         if(mysqli_num_rows($result) > 0)
		 {
            while($row = mysqli_fetch_assoc($result))
			{
				$total_price = ($row['cart_price'] * $row['cart_quantity']);
				$grand_total = $total += $total_price;
      ?>
	 
      <p><?= $row['cart_name']; ?> (<?= $row['cart_quantity']; ?> quantity)<span class="price">RM <?php 
	  echo number_format($total_price,2);;?></span></p>
	  
	    <?php
			}
		 }
		 
		 else
		 {
			echo "<div class='display-order'><span>Your Cart Is Empty!</span></div>";
		 }
		 
      ?>
      <p>Delivery Fees<span class="delivery-fees" style="color:white">RM 10.00</span></p>
	  <hr>
      <p>Total <span class="price" style="color:white"><b>RM <?php echo number_format($grand_total + 10,2); ?></b></span></p>
    </div>
  </div>
  
<div class="row">
  <div class="col-75">
    <div class="container">
	<section class="checkout-form">
      <form action="" method="post" >
	  <div class="mess">
		<label style="font-size:18px;">Notes</label>
		 <textarea name="msg" cols = "156" rows = "3" placeholder = "Any Additional Notes?"></textarea>
		</div>
        <div class="row">
          <div class="col-50">
            <h3>Personal Details</h3>
            <label for="fname"><i class="user"></i> Full Name</label>
            <input type="text" id="fname" name="name" placeholder="John Cena" required>
			<label for="pnumber"><i class="phone-num"></i> Phone Number</label>
			<input type="tel" placeholder="enter your phone number" name="number" required>
            <label for="email"><i class="email-ad"></i> Email</label>
            <input type="text" id="Email" name="email" placeholder="johncena@example.com" required>
          </div>
          <div class="col-50">
            <h3>Payment & Billing Address</h3>
			<label for="ccnum" type="text" id="ccnum" name="cardnumber">Select Payment Type:</label>
			<select class="payment-type" name="method" id="type" required>
			  <option value="TNG-Ewallet">TNG-Ewallet</option>
			  <option value="Credit/Debit Card">Credit/Debit Card</option>
			  <option value="Cash on Delivery">Cash on Delivery</option>
			  <option value="Online Banking">Online Banking</option>
			</select>
			
			<label for="adr"><i class="address-card"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="No 6 lorong 60 Bandar Mabuk ">
            <label for="city"><i class="institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="Sungai Petani ">

            <div class="zip-state">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="Kedah">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input style="width: 185px" type="text" id="zip" name="zip" placeholder="08000">
              </div>
            </div>
			
          </div>

        </div>
        <input type="submit" value="Continue To Checkout" class="btn" name="order_button" class="delete-button" onclick="return confirm('Are You Sure You Want To Checkout');">
		
      </form>
	  <p><a href="rating.php"><button class="btn1">Rate For Us</button></a></p>
	  </section>
    </div>
  </div>
	
</div>
</body>
</html>