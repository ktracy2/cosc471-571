
<?php

include_once 'includes/dbh.inc.php';

$sql = "SELECT * FROM book";
$result = mysqli_query($conn, $sql);
$_SESSION['catalog'] = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$_SESSION['catalog'][] = $row;
	}
}

// Close database connection
mysqli_close($conn);

?>

<html>
<head>
	<title> Manage Bookstore Catalog - 3-B.com </title>
	<link rel="stylesheet" href="styles.css">

	<script>

	//remove from cart

	function del(isbn){
		window.location.href="manage_bookstorecatalog.php?delIsbn="+ isbn;
	}

	</script>
	
</head>
<body>
	<h1 align = "center">Catalog</h1>
	<table align="center" style="border:1px solid blue;">
		
		<tr>
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:360px;width:400px;border:1px solid black;background-color:LightBlue">
			<table>
			<?php

			// Display search results
			foreach ($_SESSION['catalog'] as $row) {
				echo "<tr>";
				echo "<td rowspan='2' align='left'>".$row['title']."<br>By ".$row['author']."<br><b>Publisher:</b> ".$row['publisher'].",<br><b>ISBN:</b> ".$row['isbn']." <b>Price:</b> ".$row['price']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "</tr>";
				echo "<tr><td colspan='2'><p>_______________________________________________</p></td></tr>";
			}

		?>
		    </table>
			</div>
		</td>
		</tr>
		<tr>
			<td align= "center">
				
			
			</td>
			<td align="center">
				
			
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>