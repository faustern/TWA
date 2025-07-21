<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <style>
      input[type="text"] {border: 1px solid black;}
    </style>
    <link rel="stylesheet" href="../css/week10Styles.css">
    <title>Week 10 Exercise 5 Form</title>
  </head>
  <body>
    <?php
        $quantity = '';
        $error = '';
        $results = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $quantity = $_POST["quantity"]; 

            if (!is_numeric($quantity)) {
                $error = "The value entered for the quantity was not a number.";
            } else {
                require_once("conn.php");  
                $sql = "SELECT name, quantityInStock, price FROM product WHERE quantityInStock > $quantity ORDER BY quantityInStock ASC";  
                $results = $dbConn->query($sql) 
                  or die ('Problem with query: ' . $dbConn->error); 
            }
        }
    ?>
    <form id="exercise4Form" method="post">
      <h1>Quantity in Stock</h1>
      <p>Please enter the quantity to check against stock levels</p>
      <p style="white-space: nowrap;">
        <label for="quantity">Quantity: </label>
        <input type="text" name="quantity" size="10" id="quantity" maxlength="6" value="<?php echo $quantity; ?>" style="display: inline-block; vertical-align: middle;">
        <?php if (!empty($error)) {
            echo "<span style='color:red; margin-left: 10px; vertical-align: middle;'>$error</span>";
        }?>
      </p>
      <p><input type="submit" name="submit"></p>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <section id="output">
        <?php if (!empty($error)) {
                echo '';
            } else if ($results->num_rows > 0) {
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
                echo "<strong style='color:red;'>There are no products that have more than $quantity in stock.</strong>";
            }
        ?>
    </section>
    <?php endif; ?>
  </body>
</html>