<?php
include_once 'includes/dbh.inc.php';
// Check connection
// if ($conn->connect_error) {
// echo "MySQL connection failed.";
// } else {
// echo "MySQL connection success!";
// }

		//if the user enters a new credit card number, save it in the db
		$db = mysqli_connect("localhost", "admin", "password", "3bdb");
		session_start();
		if ($_SESSION['user_logged_in'] != null) {
			$username = $_SESSION['user_logged_in'];
			if ($_POST['cardgroup'] == 'new_card') {
				if (!empty($_POST['credit_card'])) {
					$type = $_POST['credit_card'];
					$num = $_POST['card_number'];
					$date = $_POST['card_expiration'];
					$query = "UPDATE customer SET cctype = '$type', ccnum = '$num' , expdate = '$date' where username = '$username';";
					$result = mysqli_query($db, $query);
				} 
			}
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
	<title>Proof of Purchase</title>
	<header align="center"><h1>Thank you for your order!</h1></header> 
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	<b>Shipping Address:</b>
	</td>
	</tr>
	<td colspan="2">
		<?php echo $fname . " " . $lname ?>	</td>
	<td rowspan="3" colspan="2">
		<b>UserID: </b><?php echo $username ?><br />
		<b>Date: </b><?php $username ?><br />
		<b>Time: </b><?php $username ?><br />
		<b>Card Info: </b><?php echo $cctype ?><br /><?php echo $expdate . " " . $ccnum ?>	</td>
	<tr>
	<td colspan="2">
		<?php echo $address ?>	</td>		
	</tr>
	<tr>
	<td colspan="2">
		<?php echo $city ?>		</td>
	</tr>
	<tr>
	<td colspan="2">
		<?php echo $state . ", " . $zip ?>	</td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1' width = '100%'>
		<th>Book Description</th><th>Qty</th><th>Price</th>
		<?php
		$_SESSION['cart_query'] = array_unique($_SESSION['cart']);

			foreach ($_SESSION['cart_query'] as $id) {

				$query = "SELECT * FROM book WHERE isbn = '$id'";

				$result = mysqli_query($conn, $query);

				$count = 0;

				foreach ($_SESSION['cart'] as $value) {

					if ($value == $id) {

						$count++;

					}

				}
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<tr><td width="66%">' .  $row['title'] . '</br><b>By </b>' . $row['author'] . '</br><b>Publisher: </b>' . $row['publisher'] . '</td><td align="center">' . $count . '</td><td align="center">$' . $count*$row['price'] . '</td></tr>';
					$subtotal += $count * $row['price'];
				}
			}
	
			//session_destroy();
		?>

	</table>
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
		SubTotal: $<?php echo $subtotal ?></br>Shipping & Handling: $2</br>_______</br>Total: $<?php echo $subtotal + 2 ?>	</div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>
		</td>
		</form>
		<td align="right">
			<form id="update" action="screen2.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
