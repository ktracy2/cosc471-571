<!-- By Katie Tracy -->
<?php
include_once 'includes/dbh.inc.php';
/* // Check connection
 	if ($conn->connect_error) {
	//echo "MySQL connection failed.";
	} else {
	//echo "MySQL connection success!";
	}  */
    
    $db = mysqli_connect("localhost", "admin", "password", "3bdb");
    $username = $_POST['username'];
    print $username;
    $pin = (int)$_POST['pin'];
    print $pin;
    //check if username exists in db
    $query = "SELECT * FROM customer where username = '$username';";
    $result = mysqli_query($db, $query);
    $num_rows = mysqli_num_rows($result);
    $inDB = false;
    $validPIN = false;
   
    if ($num_rows == 1) {
        $inDB = true;
        while($row = $result->fetch_assoc()) {
            if ($pin == (int)$row['pin']) {
                $validPIN = true;
            }
        }
    }
   
?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="styles.css">
<title> Login </title>
</head>
    <body>
        <h1 align="center">Login</h1>
        <hr align = "center" color = "darkolivegreen" width = 66%>
        <table align = "center">
        <tr><th><td></td><td>
            <?php
                if (!$validPIN || !$inDB){
                    echo '<h3>Login credentials are incorrect. Either the username or pin were entered incorrectly, or the user does not exist.</h3>';
                }
                else {
                    echo '<h2>Welcome back, ' . $username . '</h2>';
                    session_start();
                    $_SESSION["user_logged_in"] = $username;
                }
            ?>
        </td><td></td></th></tr>
        <tr><td colspan="2" align="center"></td><td colspan="2" align="center">
            <?php
            if (!$validPIN || !$inDB) {
                echo '<form id="back_to_login" action="user_login.php" method="post">';
                echo '<input type="submit" id="no" name="no" value="Back to User Login" ></form>';
            }
            else {
                echo '<form id="proceed_to_BBB" action="screen2.php" method="post">';
                echo '<input type="submit" id="submit" name="submit" value="Enter Site"></form>';
            }
            ?>
            
        </td><td></td>
        </tr>
        
        </table>
        </body>

</html>