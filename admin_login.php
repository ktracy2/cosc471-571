<?php
include_once 'includes/dbh.inc.php';
// Check connection
/* if ($conn->connect_error) {
echo "MySQL connection failed.";
} else {
echo "MySQL connection success!";
} */
?>
<!DOCTYPE HTML>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<h1 align="center">Administrator Login</h1>
<table align="center" style="border:2px solid blue;">
		<form action="admin_tasks.php" method="post" id="adminlogin_screen">
		<tr>
			<td align="right">
				Admin Name<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="adminname" id="adminname">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
			</form>
			<form action="index.php" method="post" id="login_screen">
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>



</html>


