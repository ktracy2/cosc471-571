<!-- Figure 1: Welcome Screen by Alexander -->
<!-- External CSS Added By Katie Tracy -->
<html>
<link rel="stylesheet" href="styles.css">
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include_once 'includes/dbh.inc.php';
// Check connection
/* if ($conn->connect_error) {
echo "MySQL connection failed.";
} else {
echo "MySQL connection success!";
} */
?>
<title>Welcome to Best Book Buy Online Bookstore!</title>

<body>
<h1 align="center">Welcome to Best Book Buy Online Bookstore!</h1>
	<table align="center" style="border:1px solid blue;">
	<tr><td><h2>Best Book Buy (3-B.com)</h2></td></tr>
	<tr><td><h4>Online Bookstore</h4></td></tr>
	<tr><td><form action="" method="post">
		<input type="radio" name="group1" value="SearchCat.php" onclick="document.location.href='screen2.php'">Search Online<br/>
		<input type="radio" name="group1" value="customer_registration.php" onclick="document.location.href='customer_registration.php'">New Customer<br/>
		<input type="radio" name="group1" value="user_login.php" onclick="document.location.href='user_login.php'">Returning Customer<br/>
		<input type="radio" name="group1" value="admin_login.php" onclick="document.location.href='admin_login.php'">Administrator<br/>
		<input type="submit" name="submit" value="ENTER">
	</form></td></tr>
	</table>
</body>

</html>
