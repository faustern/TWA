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
       $namestr = $_POST["firstname"];
       $emailstr = $_POST["email"];
       $addrstr = $_POST["postaddr"];
       $eliststr = $_POST["emaillist"]; 
       
       //obtain the values for the other input devices here 
    
    ?>  
    <p>The following information was received from the form:</p> 
    <p><strong>name = </strong> <?php echo "$namestr"; ?></p>
    <p><strong>email = </strong> <?php echo "$emailstr"; ?></p>
    <p><strong>address = </strong> <?php echo "$addrstr"; ?></p>
    <p> 
      <?php 
        foreach($_POST["favsport"] as $sprtstr) {
          echo "<p><strong>sport =  $sprtstr </strong></p>";
        }
      ?>
    </p> 
    <p><strong>added to email list = </strong> <?php echo "$eliststr"; ?></p>
    <!--output the other form inputs here -->  
  </body> 
  </html>