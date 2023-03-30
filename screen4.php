

<!-- screen 4: Book Reviews by Dianlu He
Last edited by Katie Tracy 3/30/2023 @ 2:35

23 Winter COSC 571

based on Prithviraj Narahari, Alexander Martens-->

<!--

Edited by Katie Tracy

Added database connectivity.

-->



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



// Fetch reviews for the given book title
$isbn = $_GET['isbn'];
$title = $_GET['title'];

//echo $title;
//echo $_SESSION["authorOfBookForReivew"];
//$authorName = $_SESSION["authorOfBookForReivew"];

$sql = "SELECT review, author, bookTitle FROM reviews WHERE bookTitle = '$title';";


$result = mysqli_query($conn, $sql);
$reviews = array();

if ($result->num_rows > 0) {

    // Output data of each row

    while($row = $result->fetch_assoc()) {

        $reviews[] = $row['review'];

        $bookTitle = $row['bookTitle'];

        $authorName = $row['author'];

    }

}

// Join the reviews into a single string separated by line breaks

$reviews_str = implode("<br>", $reviews);

?>

<!DOCTYPE html>

<html>

<head>

    <title>Book Reviews - 3-B.com</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        .field_set

        {

            border-style: inset;

            border-width:4px;

        }



		/* setup textarea and scroll bar background color */

        .light-gray {

            background-color: #f2f2f2;

        }

		

		/* define bookdetails's background and scroll bar features */

        #bookdetails {

            border: 1px solid #ddd;

            padding: 5px;

            margin: 10px;

            max-height: 200px;

            overflow-y: scroll;

            background-color: #f2f2f2;

        }



        #bookdetails::-webkit-scrollbar {

            width: 8px;

        }



        #bookdetails::-webkit-scrollbar-track {

            background: #f2f2f2;

        }



        #bookdetails::-webkit-scrollbar-thumb {

            background-color: #999;

        }



        #bookdetails::-webkit-scrollbar-button {

            background-color: #ddd;

        }



        #bookdetails::-webkit-scrollbar-button:start:decrement,

        #bookdetails::-webkit-scrollbar-button:end:increment {

            display: block;

            height: 10px;

            width: 8px;

        }



        #bookdetails::-webkit-scrollbar-button:start:increment,

        #bookdetails::-webkit-scrollbar-button:end:decrement {

            display: block;

            height: 10px;

            width: 8px;

        }



        #bookdetails::-webkit-scrollbar-button:vertical:start:decrement {

            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='10' viewBox='0 0 8 10'%3E%3Cpath fill='%23999' d='M0 8h8L4 2z'/%3E%3C/svg%3E");

        }



        #bookdetails::-webkit-scrollbar-button:vertical:end:increment {

            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='10' viewBox='0 0 8 10'%3E%3Cpath fill='%23999' d='M0 2h8L4 8z'/%3E%3C/svg%3E");

        }







		/* define textarea  */

        #bookdetails textarea {

            border: 1px solid #ccc;

            padding: 5px;

            margin-bottom: 10px;

            width: 100%;

            box-sizing: border-box;

        }



		/* formatting first row */

		td.reviews-heading {

		  padding-top: 30px;

          padding-left: 15px;

		  padding-bottom: 0px;

		  width:18%;

		  font-size:20px;

		  

	  }



	   	/* create character background */

		.container {

			display: flex;

			justify-content: left;

		}



		h1 {

			display: block;

			padding: 8px;

			font-size: 16px;

			font-weight: normal;

			background-color: #f2f2f2;

			color: #000;

		}



    </style>

</head>


<body>

<table align="center" style="border:1px solid blue;">

    <tr>

		<td align="left" class="reviews-heading">

                <h5>Reviews for</h5>

		</td>

        <!-- display book title and author name -->

		<td align="left" style="padding: 20px 0px 0px 8px;">

			<div class="container">

			<h1><?php echo $bookTitle ?> </br> <span style="font-weight: bold;">By</span> <?php echo $authorName  ?></h1>

			</div>

		</td>

    </tr>



    <tr>

        <td colspan="2">

            <div id="bookdetails">

                <?php

                // Loop through and display multiple individual textareas

                foreach($reviews as $review) {

					echo "<textarea rows='3' cols='8'>" . $review . "</textarea>";

				}

                ?>

            </div>

        </td>

    </tr>

    <tr>

        <td colspan="2" align="center">

            <form action="screen2.php" method="post">

                <input type="submit" value="Done" style="font-family: Arial, sans-serif; font-size: 16px; padding: 10px 30px; background-color: #f2f2f2; color: #000; border: 1px solid; border-radius: 4px; cursor: pointer;">

            </form>

        </td>

    </tr>

</table>



</body>

</html>
