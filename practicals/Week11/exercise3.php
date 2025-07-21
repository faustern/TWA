<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 11 Exercise 3</title>
    <link rel="stylesheet" href="../css/week11Styles.css">
    
</head>
<body>
  <?php 
    if (isset($_POST["customerID"]) && !empty($_POST["customerID"])) {
        $custID = $_POST["customerID"]; 
        require_once("conn.php");  
        $custID = $dbConn->real_escape_string($custID);
        $sql = "SELECT firstName, lastName, suburb FROM customer WHERE customerID = '$custID'";
        $results = $dbConn->query($sql) 
            or die ('Problem with query: ' . $dbConn->error);
    
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            echo "<p>Customer $custID details</p>";
  ?>
    
    <form>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($row["firstName"]); ?>" readonly><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($row["lastName"]); ?>" readonly><br>

        <label for="suburb">Suburb:</label>
        <input type="text" id="suburb" name="suburb" value="<?php echo htmlspecialchars($row["suburb"]); ?>" readonly><br>
    </form>
    <?php
        } else {
            echo "<p>No orders found for customer ID: <strong>$custID</strong></p>";
        }
    } else {
        echo "<p>No customer ID provided.</p>";
    }
  ?>
</body>
</html>