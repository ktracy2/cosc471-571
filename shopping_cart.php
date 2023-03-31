<?php
include_once 'includes/dbh.inc.php';
// Check connection
/* if ($conn->connect_error) {
echo "MySQL connection failed.";
} else {
echo "MySQL connection success!";
} */
	// Start a session 
	session_start();
	//$_SESSION["user"] = "default";
	$user = $_SESSION["user"];
	echo $user;
	//until user logs in/creates an account, cart_id is for the default temporary user
	$_SESSION["cart_id"] = "temp_user";
	$_SESSION["cart_contents"] = $temp_cart;
	echo $_SESSION['cartisbn'];
 	
	
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
	</script>
</head>
<body>
	<h1 align = "center">Shopping Cart</h1>
	<table align="center" style="border:2px solid blue;">

		<!-- Show user name on cart, if user is not logged in, username is "default" -->
		<?php
		print "<tr><td>User: $user</td><td></td><td></td></tr>";
		?>

		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
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
						<tr><td><button name='delete' id='delete' onClick='del("123441");return false;'>Delete Item</button></td><td><?php echo $title ?></br><b>By</b> <?php echo $author ?></br><b>Publisher:</b> <?php echo $publisher ?></td><td><input id='txt123441' name='txt123441' value='1' size='1' /></td><td><?php echo $price ?></td></tr>					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">				
					<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment">
				</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">Subtotal:  $12.99</td>
		</tr>
	</table>
</body>
