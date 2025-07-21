<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>  
<html lang="en"> 
  <head> 
    <meta charset="utf-8"> 
    <title>Week 8 Exercise 4</title> 
    <link rel="stylesheet" href=" ../css/week10Styles.css"> 
  </head> 
  <body> 
  <?php
    $quantity = $_POST["quantity"]; 

    if (!is_numeric($quantity)) {
        echo "<p style='color:red;'>Error: The value entered for the quantity was not a number.</p>";
      } else {
        require_once("conn.php");  
        $sql = "SELECT name, quantityInStock, price FROM product WHERE quantityInStock > $quantity ORDER BY quantityInStock ASC";  
        $results = $dbConn->query($sql) 
          or die ('Problem with query: ' . $dbConn->error); 
        if ($results->num_rows > 0) {
  ?> 
 
  <h1> Products with stock > <?php echo $quantity?></h1> 
  <table> 
    <tr> 
      <th>Name </th> 
      <th>Quantity In Stock</th> 
      <th>Price</th> 
    </tr> 
  <?php 
    while ($row = $results->fetch_assoc()) { ?> 
    <tr> 
      <td><?php echo $row["name"]?></td>
      <td><?php echo $row["quantityInStock"]?></td>
      <td><?php echo $row["price"]?></td> 
    </tr> 
  <?php }?> 
  </table> 
  <?php
        } else {
            echo "<p style='color:red;'>There are no products that have more than $quantity in stock.</p>";
        }
        $dbConn->close();
    }
  ?>
</body> 
</html> 