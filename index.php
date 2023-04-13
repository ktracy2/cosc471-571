<!-- Figure 1: Welcome Screen by Alexander -->
<!-- External CSS Added By Katie Tracy -->
<!-- Edited by Katie Tracy-->
<!-- Added reset session on home page for unregistered users ----Line 26 - 34  -->

<html>
<link rel="stylesheet" href="styles.css">
<?php

include_once 'includes/dbh.inc.php';
//Reset session on home page



 // Start the session

if (isset($_POST['exit'])) {
  // User clicked the "EXIT 3-B.com" button, so end the session
  //unset($_SESSION['user_logged_in']);
  session_destroy();
  header('Location: index.php'); // Redirect to the home page
  exit;
}


// if (isset($_POST['exit'])) {
// 	// User clicked the "EXIT 3-B.com" button, so end the session
// 	if(!isset($_SESSION['user_logged_in'])){
// 		session_destroy();
// 		header('Location: index.php'); // Redirect to the home page
// 		exit;
// 	}
	
//   }






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
