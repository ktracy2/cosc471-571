<!-- By Katie Tracy -->
<?php
include_once 'includes/dbh.inc.php';
// Check connection
/* 	if ($conn->connect_error) {
	//echo "MySQL connection failed.";
	} else {
	//echo "MySQL connection success!";
	} */
?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="styles.css">
<title> WARNING:  YOU MUST REGISTER TO COMPLETE TRANSACTION </title>
</head>
    <body>
        <h1 align="center">WARNING:  YOU MUST REGISTER TO COMPLETE TRANSACTION</h1>
        <hr align = "center" color = "darkolivegreen" width = 66%>
        <table align = "center">
        <tr><th><td></td><td><h3>In order to proceed with the payment, you need to register first.</h3></td><td></td></th></tr>
        <tr><td colspan="2" align="center"></td><td colspan="2" align="center">
            <form id="no_registration" action="index.php" method="post">
            <input type="submit" id="no" name="no" value="Okay" >
            </form>
        </td><td></td>
        </tr>
        
        </table>
        </body>

</html>
  