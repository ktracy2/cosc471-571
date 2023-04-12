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
<title> Customer Information Update Successful! </title>
</head>
    <body>
        <h1 align="center">Your information was updated successfully!</h1>
        <hr align = "center" color = "darkolivegreen" width = 66%>
        <table align = "center">
        <tr><th><td></td><td><h3>Proceed to the home page...</h3></td><td></td></th></tr>
        <tr><td colspan="2" align="center"></td><td colspan="2" align="center">
            <form id="success" action="index.php" method="post">
            <input type="submit" id="ok" name="ok" value="Okay" >
            </form>
        </td><td></td>
        </tr>
        
        </table>
        </body>

</html>
  