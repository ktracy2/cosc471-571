<!-- Edited by Lu -->
<?php
include_once 'includes/dbh.inc.php';

// Display error message if there is one
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'empty_credentials') {
        echo '<p class="error">Please fill in all the fields.</p>';
    } elseif ($_GET['error'] == 'invalid_credentials') {
        echo '<p class="error">Invalid credentials. Please try again.</p>';
    }
}


if (isset($_POST['login'])) {
    $adminname = $_POST['adminname'];
    $pin = $_POST['pin'];

    // Check if the adminname and pin fields are not empty
    if (!empty($adminname) && !empty($pin)) {
        // Query the database to check if the adminname and pin match
        $sql = "SELECT * FROM admin WHERE adminName='$adminname' AND pin='$pin'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // Credentials are correct, jump to admin_tasks.php
            header("Location: admin_tasks.php");
            exit();
        } else {
            // Credentials are incorrect, redirect back to login screen with an error message
            //header("Location: admin_login.php?error=invalid_credentials");
            //exit();
			echo "<script>alert('Invalid credentials. Please try again.')</script>";
        }
    } else {
        // Credentials are empty, redirect back to login screen with an error message
        //header("Location: admin_login.php?error=empty_credentials");
        //exit();
		echo "<script>alert('Please enter your admin name and PIN.')</script>";
    }
}

?>



<!DOCTYPE HTML>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<h1 align="center">Administrator Login</h1>
<table align="center" style="border:2px solid blue;">
		<!-- <form action="admin_tasks.php" method="post" id="adminlogin_screen"> -->
		<form action="admin_login.php" method="post" id="adminlogin_screen">

		<tr>
			<td align="right">
				New Admin Name<span style="color:red">*</span>:
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
				New PIN<span style="color:red">*</span>:
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