<?php
//Done// If there is a user logged in, "Checkout" button needs to route to confirm order page.  Otherwise, it needs to route to customer registration.  Line 149 - 158
//update line 76 77

include_once 'includes/dbh.inc.php';


	// Start a session 
	
	session_start();

	
	
	//$_SESSION["user"] = "default";
	if(isset($_SESSION["user"])){
		$user = $_SESSION["user"];
	echo $user;
	}
	

	//until user logs in/creates an account, cart_id is for the default temporary user
	if(isset($_SESSION["cart_id"])){
		$_SESSION["cart_id"] = "temp_user";
	}
	if(isset($_SESSION["cart_contents"])){
		$_SESSION["cart_contents"] = $temp_cart;
	}
	

	

	//Calculate the subtotal
	//Loops through the cart array and adds the price of each book to the subtotal variable
	$subtotal = 0;
	// foreach ($_SESSION['cart'] as $isbn) {
	// 	$query = "SELECT price FROM book WHERE isbn = '$isbn'";

	// 	$result = mysqli_query($conn, $query);
	// 	while ($row = mysqli_fetch_assoc($result)) {
	// 	$subtotal += $row['price'];
	// 	}
		
	// }

	//Deleting from the cart
	if(isset($_GET['delIsbn'])){
		
		$isbnDel = $_GET['delIsbn'];

		//array with the elements to be delete 
		$array_del = array($isbnDel);

		//creating a new array without the ISBN
		$temp = array_values(array_diff($_SESSION['cart'],$array_del));
		
		$_SESSION['cart'] = $temp;
		
	}
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $_SESSION['cart_query'] = array_unique($_SESSION['cart']);
        $updated_cart = array();
        //print_r($_SESSION['cart_query']);
        foreach ($_SESSION['cart_query'] as $id){
             //echo $id;
        //print_r($_POST);
            if (array_key_exists($id, $_POST)) {
                $num = (int)$_POST[$id];
                for ($i = 0; $i < $num; $i++) {
					array_push($updated_cart, $id);
				}
            }
        }
        $_SESSION['cart'] = $updated_cart;


		//modified by Lu, updating number of items in shopping cart
		$cartSize = count($_SESSION['cart']);
		$_SESSION['cartSize'] = $cartSize;



    }
	

?>

<!DOCTYPE HTML>

<head>

	<title>Shopping Cart</title>

	<link rel="stylesheet" href="styles.css">

	<script>

	//remove from cart

	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}

	//updates the values in the quantity boxes and updates the 
	function recalculate(){
		var input = document.getElementById('quantity').value;
		console.log(input);
	}
	

	</script>

</head>

<body>
	
	<h1 align = "center">Shopping Cart</h1>

	<table align="center" style="border:2px solid blue;">



		<!-- Show user name on cart, if user is not logged in, username is "default" -->

		<?php
		if ($_SESSION['user_logged_in'] != null) {
			$user = $_SESSION['user_logged_in'];
			echo "<tr><td><b>User: </b>$user</td><td></td><td></td></tr>";
		}
		else{
			echo "<tr><td>User: unregistered user</td><td></td><td></td></tr>";
		}

		?>



		<tr>







		
			<td align="center">


				<?php
					if(isset($_SESSION["user_logged_in"])) {
						echo '<form id="checkout" action="confirm_order.php" method="get">';
						echo '<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">';
						echo '</form>';
					} else {
						echo '<form id="checkout" action="customer_registration.php" method="get">';
						echo '<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">';
						echo '</form>';
					}
				?>

				<!--<form id="checkout" action="confirm_order.php" method="get">-->
				<!-- <form id="checkout" action="customer_registration.php" method="get">

					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">

				</form> -->

			</td>

			<td align="center">

				<form id="new_search" action="screen2.php" method="post">

					<input type="submit" name="search" id="search" value="New Search">

				</form>								

			</td>

			<td align="center">

				<form id="exit" action="index.php" method="post">

					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">

				</form>					

			</td>

		</tr>

		<tr>

				<form id="recalculate" name="recalculate" action="" method="post">

			<td  colspan="3">

				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">

					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">

						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>

						<?php

						//get unique isbn

						$_SESSION['cart_query'] = array_unique($_SESSION['cart']);

						foreach($_SESSION['cart_query'] as $id){

							$query = "SELECT * FROM book WHERE isbn = '$id'";

							$result = mysqli_query($conn, $query);

							$count = 0;

							foreach ($_SESSION['cart'] as $value) {

								if ($value == $id) {

									$count++;

								}

							}


							// Display book information

							while ($row = mysqli_fetch_assoc($result)) {

								echo '<tr><td><button name=\'delete\' id=\'delete\' onClick=\'del("' . $row['isbn'] . '");return false;\'>Delete Item</button></td>';
								echo '<td>' .  $row['title'] . '</br><b>By </b>' . $row['author'] . '</br><b>Publisher: </b>' . $row['publisher'] . '</td><td><input id='. $row['isbn'] . ' name= '. $row['isbn'] . ' value =' . $count  . ' size=\'1\')/></td><td>$' . $count*$row['price'] . '</td></tr>';
								$subtotal += $count * $row['price'];
							}

						}
						
						?>
					</table>
				</div>

			</td>

		</tr>

		<tr>

			<td align="center">				

					<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment" onClick = "recalculate()">

				</form>

			</td>

			<td align="center">

				&nbsp;

			</td>

			<td align="center">Subtotal:  $<?php echo $subtotal?></td>

		</tr>

	</table>

</body>