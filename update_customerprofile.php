<?php
include_once 'includes/dbh.inc.php';
// Check connection
// if ($conn->connect_error) {
// echo "MySQL connection failed.";
// } else {
// echo "MySQL connection success!";
// }
session_start();
if ($_SESSION['user_logged_in'] != null) {
	$username = $_SESSION['user_logged_in'];
	
	$db = mysqli_connect("localhost", "admin", "password", "3bdb");
}
?>
<script>alert('Please enter all values')</script>
<!DOCTYPE HTML>
<head>
<title>UPDATE CUSTOMER PROFILE</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
	<form id="update_profile" action="" method="post">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Username: <?php echo $username ?>
			</td>
			<td colspan="3" align="center">
							</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname">
			</td>
		</tr>
		<tr>
			<td align="right"> 
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
		<form id="cancel" action="index.php" method="post">	
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
	</table>
	</form>

	<?php

	if (!empty($_POST)) {
		//Get variables from user input
		$newPIN = (int)$_POST["new_pin"];
		$retype_pin = (int)$_POST["retypenew_pin"];
		$fname = $_POST["firstname"];
		$lname = $_POST["lastname"];
		$address = $_POST["address"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$zip = (int)$_POST["zip"];
		$cctype = $_POST["credit_card"];
		$ccnum = $_POST["card_number"];
		$expdate = $_POST["expiration_date"];

		if ($newPIN == $retype_pin){
			$query = "UPDATE customer 
				SET pin = '$newPIN', 
				fname = '$fname', 
				lname = '$lname',
				address = '$address', 
				city = '$city', 
				state = '$state', 
				zip = '$zip', 
				cctype = '$cctype', 
				ccnum = '$ccnum', 
				expdate = '$expdate'
				WHERE username = '$username';";
			mysqli_query($db, $query);
		}

		header("Location: http://142.93.240.246/successful_update.php");
		exit();
		
	}
	
	?>
</body>
</html>