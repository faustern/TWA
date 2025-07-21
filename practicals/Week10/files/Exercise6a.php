<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<?php
    session_start();

    if (isset($_SESSION['personName'])) {
        $personName = $_SESSION['personName'];
    } else {
        $personName = "Name not found";
    }

    if (isset($_SESSION['hobby'])) {
        $hobby = $_SESSION['hobby'];
    } else {
        $hobby = "Hobby not found";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submitted Info</title>
</head>
<body>
  <p>Hello <?php echo $personName; ?>. Your hobby is<?php echo $hobby; ?></p>
  <p><a href="exercise6a.html">Go to the starting form</a></p>
</body>
</html>