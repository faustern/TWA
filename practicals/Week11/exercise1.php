<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 11 Exercise 1</title>
    <link rel="stylesheet" href="../css/week11Styles.css">
    
</head>
<body>
  <?php 
    if (isset($_GET["staffID"]) && !empty($_GET["staffID"])) {
        $staffID = $_GET["staffID"]; 
        require_once("conn.php");  
        $staffID = $dbConn->real_escape_string($staffID);
        $sql = "SELECT p.orderID, p.orderDate, p.shippingDate, s.staffName FROM purchase p INNER JOIN staff s ON p.staffID = s.staffID WHERE p.staffID = '$staffID' ORDER BY p.orderDate ASC";
        $results = $dbConn->query($sql) 
            or die ('Problem with query: ' . $dbConn->error);
    
        if ($results->num_rows > 0) { 
  ?>
    <table>
        <tr> 
            <th>orderID</th> 
            <th>orderDate</th> 
            <th>shippingDate</th> 
            <th>staffName</th> 
        </tr>
    <?php 
        while ($row = $results->fetch_assoc()) { ?> 
        <tr>
            <td><?php echo $row["orderID"]?></td>
            <td><?php echo $row["orderDate"]?></td>
            <td><?php echo $row["shippingDate"]?></td>
            <td><?php echo $row["staffName"]?></td>
        </tr>
    <?php }?> 
    </table>
    <?php
        } else {
            echo "<p>No orders found for staff ID: <strong>$staffID</strong></p>";
        }
    } else {
        echo "<p>No staff ID provided.</p>";
    }
  ?>
</body>
</html>