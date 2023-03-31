
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->

<?php

session_start();

include_once 'includes/dbh.inc.php';

// Check connection
/*
if ($conn->connect_error) {

echo "MySQL connection failed.";

} else {

echo "MySQL connection success!";

}
*/


$queryString = $_SERVER['QUERY_STRING'];
$_SESSION['queryString'] = $queryString;
$search = $_GET['searchfor']; //what was in the search text box
echo $search;
$category = $_GET['category']; //what category was selected, or all
echo $category;
//Get values saved in searchon[]
$refine = '';
foreach ($_GET['searchon'] as $option){
	//echo "you have selected " . $option; //Each option to refine search, or anywhere
	$refine .= '"'. $option . '"'. ',';
}
$refine = substr($refine, 0, strlen($refine) - 1);
echo $refine;
//IF THERE IS NO CATEGORY SELECTED AND SEARCH ANYWHERE IS SELECTED, LIST ALL BOOKS IN DB

if ($refine == "\"anywhere\"" && $category == 'all'){
		$search = $_GET['searchfor'];
		echo $search;
		$sql = "SELECT * FROM book WHERE title LIKE '%$search%'";
		$result = mysqli_query($conn, $sql);
		$_SESSION['search_results'] = array();

		if (mysqli_num_rows($result) > 0) {

			while ($row = mysqli_fetch_assoc($result)) {

				$_SESSION['search_results'][] = $row;
				
			}
		}

}

//if Category is selected, build query that refines search including category

else if ($category != 'all') {
		$sql = "SELECT * FROM book WHERE category = '$category';";
		$result = mysqli_query($conn, $sql);
		
		$_SESSION['search_results'] = array();

		if (mysqli_num_rows($result) > 0) {

			while ($row = mysqli_fetch_assoc($result)) {

				$_SESSION['search_results'][] = $row;
				
			}
		}

}

/*
// Get search term from GET request

$search = $_GET['searchfor'];

// Prepare SQL statement

$sql = "SELECT * FROM book WHERE title LIKE '%$search%'";

// Execute SQL statement

$result = mysqli_query($conn, $sql);

// Store search results in session variable

$_SESSION['search_results'] = array();

if (mysqli_num_rows($result) > 0) {

	
	while ($row = mysqli_fetch_assoc($result)) {

		$_SESSION['search_results'][] = $row;
		
	}

}
*/
// // Add item to cart --- i think this part should be in shopping_cart

// if (isset($_GET['cartisbn'])) {

//     $cart_item = array(

//         'isbn' => $_GET['cartisbn'],

//         'title' => $_GET['carttitle'],

//         'price' => $_GET['cartprice']

//     );

//     $_SESSION['cart'][] = $cart_item;

// }

// Close database connection

mysqli_close($conn);

?>

<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->

<html>

<head>

	<title> Search Result - 3-B.com </title>
	<link rel="stylesheet" href="styles.css">
	<script>

	//redirect to reviews page

	function review(isbn, title){

		window.location.href="screen4.php?isbn="+ isbn + "&title=" + title;

	}

	//add to cart

	function cart(isbn, searchfor, searchon, category){

		window.location.href="screen3.php?cartisbn="+ isbn + "&searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;

	}

	</script>

</head>

<body>

	<table align="center" style="border:1px solid blue;">

		<tr>

			<td align="left">

					<?php 
					// Get a count of all items in shopping cart and set equal to below 
					$_COOKIE['numItemsInCart'];
					
					?>

					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>

				

			</td>

			<td>

				&nbsp

			</td>

			<td align="right">

				<form action="shopping_cart.php" method="post">

					<input type="submit" value="Manage Shopping Cart">

				</form>

			</td>

		</tr>	

		<tr>

		<td style="width: 350px" colspan="3" align="center">

			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">

			<table>

			<?php

			// Display search results

			foreach ($_SESSION['search_results'] as $row) {
				
				echo "<tr>";

				echo "<td align='left'><button name='btnCart' id='btnCart' onClick='cart(\"".$row['isbn']."\", \"".$search."\", \"Array\", \"all\")'>Add to Cart</button></td>";

				echo "<td rowspan='2' align='left'>".$row['title']."<br>By ".$row['author']."<br><b>Publisher:</b> ".$row['publisher'].",<br><b>ISBN:</b> ".$row['isbn']." <b>Price:</b> ".$row['price']."</td>";

				echo "</tr>";

				echo "<tr>";

				echo "<td align='left'><button name='review' id='review' onClick='review(\"".$row['isbn']."\", \"".$row['title']."\")'>Reviews</button></td>";

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

				<form action="confirm_order.php" method="get">

					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">

				</form>

			</td>

			<td align="center">

				<form action="screen2.php" method="post">

					<input type="submit" value="New Search">

				</form>

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
