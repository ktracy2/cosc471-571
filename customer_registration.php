<!-- Edited by Katie Tracy -->
<?php
include_once 'includes/dbh.inc.php';
// Check connection
	if ($conn->connect_error) {
	//echo "MySQL connection failed.";
	} else {
	//echo "MySQL connection success!";
	}

	if (!empty($_POST)){
		//Set connection to a variable
		$db = mysqli_connect("localhost", "admin", "password", "3bdb");

		//Get variables from user input
		$username = $_POST["username"];
		$pin = (int)$_POST["pin"];
		$retype_pin = (int)$_POST["retype_pin"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$address = $_POST["address"];
		$city = $_POST["city"];
		$state = $_POST["state"];
		$zip = (int)$_POST["zip"];
		$cctype = $_POST["credit_card"];
		$ccnum = $_POST["card_number"];
		$expdate = $_POST["expiration"];

		//check if username exists in db
		$query = "SELECT * FROM customer where username = '$username';";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows > 0) {
			echo 'User already exists.  Choose a new username.';
		}
		else {
			if ($pin == $retype_pin){
				$query = "INSERT INTO customer(username, pin, fname, lname, address, city, zip, state, cctype ,ccnum, expdate) VALUES ('$username', $pin, '$firstname', '$lastname', '$address', '$city', $zip, '$state', '$cctype', '$ccnum', '$expdate');";
        		mysqli_query($db, $query);
			}
		}
	
	}
	//came from index.php or redirected from a checkout 

	//is username exists in db, alert that username exists
	
	//if username does not exist, build the sql statement to save the information and forcibly redirect to the search page
	//TO DOredirect to checkout page (see if shopping cart is populated) 
?>
<script>alert('Please enter all values')</script><!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title> CUSTOMER REGISTRATION </title>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin">
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
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
			<td align="left">
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<form id="no_registration" action="index.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register">
			</td>
			</form>
		</tr>
	</table>

</body>
</HTML>
