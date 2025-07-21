<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<?php 
    $dbConn = new mysqli("localhost", "TWA_student", "TWA_2025_Autumn", "electrical"); 
    if($dbConn->connect_error) { 
      die("Failed to connect to database " . $dbConn->connect_error); 
    } 
?>