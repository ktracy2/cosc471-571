<!-- Figure 2: Search Screen by Alexander -->

<?php

include_once 'includes/dbh.inc.php';
session_start();
if ($_SESSION['user_logged_in'] != null) {
	echo $_SESSION['user_logged_in'];
}


?>

<html>

<head>

	<title>SEARCH - 3-B.com</title>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
<h1 align = "center">Search</h1>
	<table align="center" style="border:1px solid blue;">

		<tr>

			<td>Search for: </td>

			<form action="screen3.php" method="get">

                <td><input type="text" name="searchfor" /></td>

				<td><input type="submit" name="search" value="Search" /></td>

		</tr>

		<tr>

			<td>Search In: </td>

				<td>

					<select name="searchon[]" multiple>

						<option value="anywhere" selected='selected'>Keyword anywhere</option>

						<option value="title">Title</option>

						<option value="author">Author</option>

						<option value="publisher">Publisher</option>

						<option value="isbn">ISBN</option>				

					</select>

				</td>

				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>

		</tr>

		<tr>

			<td>Category: </td>

				<td>

					<select name="category">

						<option value='all'>All Categories</option>

						<option value='Fantasy'>Fantasy</option>

                        <option value='Adventure'>Adventure</option>

                        <option value='Fiction'>Fiction</option>

                        <option value='Horror'>Horror</option>				

					</select>

				</td>

				</form>

	            <form action="index.php" method="post">	

				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>

			</form>

		</tr>

	</table>

</body>

</html>
