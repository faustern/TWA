<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 11 Exercise 2</title>
    <link rel="stylesheet" href="../css/week11Styles.css">
    
</head>
<body>
    <p>Click a link to find orders placed by the staff member:</p>

    <?php
    require_once("conn.php"); 
    
    if (!$dbConn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT staffID, staffName FROM staff ORDER BY staffName ASC";

    $result = $dbConn->query($sql);

    if (!$result) {
        die("SQL query failed: " . $dbConn->error);
    }
        
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $staffID = urlencode($row["staffID"]);
            $staffName = $row["staffName"];

            echo "<p><a href='exercise1.php?staffID=$staffID'>$staffName</a></p>";
        }
    } else {
        echo "<p>No staff members found.</p>";
    }
    ?>
</body>
</html>

<!-- correctly passed the staff id to exercise1 and displayed the expected results -->