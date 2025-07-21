<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html> 
<html lang="en"> 
  <head> 
    <meta charset="utf-8"> 
    <title>Week 9 Exercise 1</title> 
  </head> 
  <body>  
    <?php 
       //obtain the firstname input from the $_GET array 
       $namestr = $_GET["firstname"];
       $emailstr = $_GET["email"];
       $addrstr = $_GET["postaddr"];
       $sprtstr = $_GET["favsport"];
       $eliststr = $_GET["emaillist"]; 
       
       //obtain the values for the other input devices here 
    
    ?>  
    <p>The following information was received from the form:</p> 
    <p><strong>name = </strong> <?php echo "$namestr"; ?></p>
    <p><strong>email = </strong> <?php echo "$emailstr"; ?></p>
    <p><strong>address = </strong> <?php echo "$addrstr"; ?></p>
    <p><strong>sport = </strong> <?php echo "$sprtstr"; ?></p> 
    <p><strong>added to email list = </strong> <?php echo "$eliststr"; ?></p>
    <!--output the other form inputs here -->  
  </body> 
  </html>