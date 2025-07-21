<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['personName']) && $_POST['personName'] != "") {
            $_SESSION['personName'] = $_POST['personName'];
        } else {
            $_SESSION['personName'] = "No name entered";
        }

        if (isset($_POST['hobby']) && $_POST['hobby'] != "") {
            $_SESSION['hobby'] = $_POST['hobby'];
        } else {
            $_SESSION['hobby'] = "No hobby selected";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Submitted</title>
</head>
<body>
  <p><a href="exercise6a.php">Let's visit the second page</a></p>
</body>
</html>