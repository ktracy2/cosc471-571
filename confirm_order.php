<?php
include_once 'includes/dbh.inc.php';
// Check connection
/* if ($conn->connect_error) {
echo "MySQL connection failed.";
} else {
echo "MySQL connection success!";
} */
	session_start();

	if ($_SESSION['user_logged_in'] != null) {
		$username = $_SESSION['user_logged_in'];
		$db = mysqli_connect("localhost", "admin", "password", "3bdb");
		
		$query = "SELECT * FROM customer where username = '$username';";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);
		
		while($row = $result->fetch_assoc()) {
			$fname = $row['fname'];
			$lname = $row['lname'];
			$address = $row['address'];
			$city = $row['city'];
			$zip = (int)$row['zip'];
			$state = $row['state'];
			$cctype = $row['cctype'];
			$ccnum = $row['ccnum'];
			$expdate = $row['expdate'];
		}
	}



?>
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<link rel="stylesheet" href="styles.css">
	<header align="center">Confirm Order</header> 
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="proof_purchase.php" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2">
		<?php echo $fname . ' ' . $lname ?>	</td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br /><?php echo $cctype . ' - ' . $ccnum . ' - ' . $expdate ?><br />
		<input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
				<select id="credit_card" name="credit_card">
					<option selected disabled>Select a card type</option>
					<option>VISA</option>
					<option>MASTER</option>
					<option>DISCOVER</option>
				</select>
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
				<br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
	</td>
	<tr>
	<td colspan="2">
	<?php echo $address ?>	</td>		
	</tr>
	<tr>
	<td colspan="2">
	<?php echo $city ?>	</td>
	</tr>
	<tr>
	<td colspan="2">
	<?php echo $state . ', ' . $zip ?>	</td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>
		<th>Book Description</th><th>Qty</th><th>Price</th>
		<tr><td>iuhdf</br><b>By</b> Avi Silberschatz</br><b>Publisher:</b> McGraw-Hill</td><td>1</td><td>$12.99</td></tr>	</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		SubTotal:$12.99</br>Shipping & Handling: $2</br>_______</br>Total:$14.99	</div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="BUY IT!">
		</td>
		</form>
		<td align="right">
			<form id="update" action="update_customerprofile.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="Update Customer Profile">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="cancel" name="cancel" value="Cancel">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>

