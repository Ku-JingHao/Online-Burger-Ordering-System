<?php include("dataconnection.php");

if(isset($_POST['add_product_button']))
{
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_description = $_POST['p_description'];
   $p_category = $_POST['p_category'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'image/'.$p_image;

   $insert_query = mysqli_query($connect, "INSERT INTO `items`(items_name, items_price, items_description, items_category, items_image) 
   VALUES('$p_name', '$p_price', '$p_description', '$p_category', '$p_image')");

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Item Added Succesfully';
   }else{
      $message[] = 'This Item Could Not Be Added';
   }
};

if(isset($_GET['deleted']))
{
   $delete_items = $_GET['deleted'];
   $delete_query = mysqli_query($connect, "DELETE FROM `items` WHERE items_id = $delete_items");
   
   header("Location: manage_product.php");
};

if(isset($_POST['edit_product'])){
   $edit_p_id = $_POST['edit_p_id'];
   $edit_p_name = $_POST['edit_p_name'];
   $edit_p_price = $_POST['edit_p_price'];
   $edit_p_description = $_POST['edit_p_description'];
   $edit_p_category = $_POST['edit_p_category'];
   $edit_p_image = $_FILES['edit_p_image']['name'];
   $edit_p_image_tmp_name = $_FILES['edit_p_image']['tmp_name'];
   $edit_p_image_folder = 'image/'.$edit_p_image;

   $update_query = mysqli_query($connect, "UPDATE `items` SET items_name = '$edit_p_name', items_price = '$edit_p_price', items_description = '$edit_p_description', 
   items_category= '$edit_p_category', items_image = '$edit_p_image' WHERE items_id = '$edit_p_id'");

    header("Location: manage_product.php");
};


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

.container{
   max-width: 1200px;
   margin:0 auto;
   padding-bottom: 5rem; 
}

section{
   padding:2rem;
}

.add-product{
   max-width: 50rem;
   background-color: #708090;;
   border-radius: .5rem;
   padding:2rem;
   margin:0 auto;
   margin-top: 2rem;
}

.add-product h3{
   font-size: 2.8rem;
   margin-bottom: 1rem;
   color:#d1d5db;
   text-transform: uppercase;
   text-align: center;
}

.add-product .row{
   text-transform: none;
   padding:1.2rem 1.4rem;
   font-size: 1.7rem;
   color:black;
   border-radius: .5rem;
   background-color: white;
   margin:1rem 0;
   width: 95%;
}

.button,.option-button,.delete-button{
   display: block;
   width: 100%;
   text-align: center;
   background-color: #2E8B57;
   color:white;
   font-size: 1.7rem;
   padding:1.2rem 3rem;
   border-radius: 0.5rem;
   cursor: pointer;
   margin-top: 1rem;
   text-decoration: none;
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

.message{
   background-color: blue;
   position: sticky;
   top:0; 
   left:0;
   z-index: 10000;
   border-radius: .5rem;
   background-color: white;
   padding:1.5rem 2rem;
   margin:0 auto;
   max-width: 1200px;
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap:1.5rem;
 }

.message span{
   font-size: 2rem;
   color:black;
   font-family: Comic Sans MS;
}

.message i{
   font-size: 2.5rem;
   color:black;
   cursor: pointer;
}

.message i:hover{
   color:red;
}

.product-table table{
   width: 100%;
   text-align: center;
   background-color: #F3F3F3;
}

.product-table table thead th{
   padding:1.5rem;
   font-size: 2rem;
   background-color: black;
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
   background-color: #CCCCCC;
}

.product-table .empty{
   margin-bottom: 2rem;
   text-align: center;
   background-color: #CCCCCC;
   color:black;
   font-size: 2rem;
   padding:1.5rem;
}

.edit-container{
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

.edit-container form{
   width: 50rem;
   border-radius: .5rem;
   background-color: white;
   text-align: center;
   padding:2rem;
}

.edit-container form .row{
   width: 95%;
   background-color: white;
   border-radius: .5rem;
   margin:1rem 0;
   font-size: 1.7rem;
   color:black;
   padding:1.2rem 1.4rem;
   text-transform: none;
}

.cross-icon{
	width:50px;
	height:50px;
	cursor:pointer;
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
<section>
	<form action="" method="post" class="add-product" enctype="multipart/form-data">
	   <h3>add a new product</h3>
	   <input type="text" name="p_name" placeholder="enter the product name" class="row" required>
	   <input type="number" step="0.01" name="p_price" min="0" placeholder="enter the product price" class="row" required>
	   <input type="text" name="p_description" placeholder="enter the product description" class="row" style="height: 50px;" required>
	   <input type="text" name="p_category" placeholder="enter the product categories" class="row" required>
	   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="row" required>
	   <input type="submit" value="Add Product" name="add_product_button" class="button">
	</form>
</section>

<section class="product-table">

   <table>

      <thead>
         <th>Product Image</th>
         <th>Product Name</th>
         <th>Product Price</th>
		 <th>Product Description</th>
		 <th>Product Categories</th>
         <th>Action</th>
      </thead>

      <tbody>
         <?php
         
            $results = mysqli_query($connect, "SELECT * FROM `items`");
            if(mysqli_num_rows($results) > 0){
               while($row = mysqli_fetch_assoc($results)){
         ?>

         <tr>
            <td><img src="image/<?php echo $row['items_image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['items_name']; ?></td>
            <td>RM<?php echo $row['items_price']; ?></td>
			<td><?php echo $row['items_description']; ?></td>
			<td><?php echo $row['items_category']; ?></td>
            <td>
               <a href="manage_product.php ?deleted=<?php echo $row['items_id']; ?>" class="delete-button" onclick="return confirm('are your sure you want to delete this?');">Delete </a>
               <a href="manage_product.php ?edited=<?php echo $row['items_id']; ?>" class="option-button"> Edit </a>
            </td>
         </tr>

         <?php
				};    
            }
			else
			{
               echo "<div class='empty'>No Product Added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-container">

   <?php
   
   if(isset($_GET['edited'])){
      $edit_items = $_GET['edited'];
      $edit_query = mysqli_query($connect, "SELECT * FROM `items` WHERE items_id = $edit_items");
      if(mysqli_num_rows($edit_query) > 0)
	  {
         while($row_edit = mysqli_fetch_assoc($edit_query))
		 {
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="image/<?php echo $row_edit['items_image']; ?>" height="200" alt="">
      <input type="hidden" name="edit_p_id" value="<?php echo $row_edit['items_id']; ?>">
      <input type="text" class="row" required name="edit_p_name" value="<?php echo $row_edit['items_name']; ?>">
      <input type="number" step="0.01" min="0" class="row" required name="edit_p_price" value="<?php echo $row_edit['items_price']; ?>"> 
	  <input type="text" required name="edit_p_description"  class="row" style="height: 50px;" value="<?php echo $row_edit['items_description']; ?>">
	  <input type="text" required name="edit_p_category" class="row" value="<?php echo $row_edit['items_category']; ?>">
      <input type="file" class="row" required name="edit_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="Update The Prodcut" name="edit_product" class="button">
      <input style="width:100%;" type="reset" value="Cancel" id="close-edit" class="option-button">
   </form>

   <?php
            };
         };
         echo "
		 <script>
		document.querySelector('.edit-container').style.display = 'flex';
		document.querySelector('#close-edit').onclick = () =>{
		document.querySelector('.edit-container').style.display = 'none';
		window.location.href = 'manage_product.php';
};		 </script>";
      };
   ?>

</section>

</div>
</body>
</html>