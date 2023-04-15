<?php
include_once 'includes/dbh.inc.php';
    //Gets current time of report
    date_default_timezone_set('America/Detroit');
    $time=time();
    $time = date("y-m-d h:ia",$time);
    $year = (int)date('Y');
?>

<!DOCTYPE HTML>
<head>
<title>Admin Reports</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<h1 align="center">Reports</h1>
<h2>Total Registered Customers as of <?php echo $time?></h2>
<table align="left" style="border:2px solid blue;">
        <!-- Total num registered customers -->
        <tr style="border:2px solid blue;">
            <td style="border:1px solid blue; width:66%;"><b>Total Registered Customers</b></td>
            <td style="border:1px solid blue; width:33%;  text-align:right;">
                <?php 
                    $db = mysqli_connect("localhost", "admin", "password", "3bdb");
                       
                    $query = "SELECT * FROM customer;";
                    $result = mysqli_query($db, $query);
                    $num_rows = mysqli_num_rows($result);
            
                    echo $num_rows;
                ?>
            </td>
        </tr>
</table>

<!-- Total num of book titles available in each category, in descending order -->
<br>
<br>
<h2 style="margin-top:30px;">Book Titles By Category (DESC)</h2>
<table align="left" style="border:2px solid blue; width:400px;">
        <th><tr style="border:2px solid blue;">
            <td style="border:1px solid blue; "><b>Category</b></td>
            <td style="border:1px solid blue; "><b>Number of Titles (in descending order)</b></td></tr>
        </th>
        
            <?php

                $query = "SELECT category, COUNT(title) AS \"total\" FROM book  GROUP BY Category ORDER BY total DESC;";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                for ($i; $i < $num_rows; $i++){
                    $row = mysqli_fetch_assoc($result);
                    $category = $row["category"];
                    $total = $row["total"];
                    echo '<tr style = "border:1px solid blue;">
                        <td style = "border:1px solid blue;">' . $category . '</td><td style = "border:1px solid blue; text-align:right;  width:33%; ">' . $total . '</td></tr>';
                }   
            ?>
        
</table>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<h2 style="margin-top:30px;">Average Monthly Sales for <?php echo date("Y");?></h2>
<!-- Average monthly sales for the current year, ordered by month -->
<table align="left" style="border:2px solid blue;">
        <th><tr style="border:2px solid blue;">
            <td style="border:1px solid blue; "><b>Month</b></td>
            <td style="border:1px solid blue; "><b>Average Sales Amount</b></td></tr>
        </th>
        <?php

                $query = "SELECT month, round(avg(total),2) AS \"avg\" FROM orders WHERE year = '$year' GROUP BY month ORDER BY month;";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
                echo $num_rows;
                for ($i; $i < $num_rows; $i++){
            
                    $row = mysqli_fetch_assoc($result);
                    $month = (int)$row["month"];
            
                    $total = (float)$row["avg"];
           
                    echo '<tr style = "border:1px solid blue;">
                        <td style = "border:1px solid blue;">' . $month . '</td><td style = "border:1px solid blue; text-align:right;  width:33%;">$' . $total . '</td></tr>';
                }   
        ?>
        
</table>

<br>
<br>
<h2 style="margin-top:30px;">Reviews Per Book</h2>
<!-- All book titles and the number of reviews for each book -->
<table align="left" style="border:2px solid blue;">
        <th><tr style="border:2px solid blue;">
            <td style="border:1px solid blue; "><b>Book Title</b></td>
            <td style="border:1px solid blue; "><b>Number of Reviews</b></td></tr>
        </th>
        
            <?php

                $query = "SELECT bookTitle, COUNT(review) AS \"reviews\" FROM reviews GROUP BY bookTitle;";
                $result = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($result);
            echo $num_rows;
                for ($i; $i < $num_rows; $i++){
                    $row = mysqli_fetch_assoc($result);
                    $title = $row["bookTitle"];
                    echo $title;
                    
                    $total = $row["reviews"];
                    //echo $total;
                    echo '<tr style = "border:1px solid blue;">
                        <td style = "border:1px solid blue;">' . $title . '</td><td style = "border:1px solid blue; text-align:right;  width:33%; ">' . $total . '</td></tr>';
                }   
            ?>
</table>
		
<br>
<br>
<br>
<br>
<br>
<br>
<br>

	<table>
        <tr>
            <td>
            </td>
            <td align="right">
                    <form id="index" action="index.php" method="post">
                    <input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
                    </form>
            </td>
        </tr>
    </table>
</body>



</html>
