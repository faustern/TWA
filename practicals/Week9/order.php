<!-- 22120123 - Long Nguyen - Practical 15:00 -> 17:00 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Form</title>
</head>

<style> 
    body {
        margin: 20px;
    }
    .blue {
        color: #007bff;
    }
    table {
        width: 50%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        padding: 5px 10px;
    }
    th {
        border-bottom: 2px solid black;
        text-align: left;
    }
    td:last-child, th:last-child {
        text-align: right;
    }
    .summary {
        margin-top: 20px;
        width: 300px;
    }
    .summary td {
        padding: 4px 8px;
    }
</style>

<body>
    <?php
        // Quote Details
        $quoteDate = $_POST["quoteDate"];
        $staffno = $_POST["staffno"];
        $staffname = $_POST["staffname"];

        // Customer Details
        $title = $_POST["title"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];

        // Address Details
        $address = $_POST["address"];
        $suburb = $_POST["suburb"];
        $postcode = $_POST["postcode"];

        // Contact Details
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        // Product
        $products = [];
        for ($i = 1; $i <= 5; $i++) {
            $qty = floatval($_POST["product{$i}_qty"]);
            $price = floatval($_POST["product{$i}_price"]);
            $lineTotal = $qty * $price;

            $products[] = [
                "id" => $_POST["product{$i}_id"],
                "desc" => $_POST["product{$i}_desc"],
                "qty" => $qty,
                "price" => $price,
                "lineTotal" => $lineTotal
            ];
        }

        // Installation Details
        $installNotes = $_POST["installNotes"];
        $installDate = $_POST["installDate"];

        // Payment Details
        $subtotal = 0;
        foreach ($products as $product) {
            if ($product["qty"] > 0 && $product["price"] > 0) {
                $subtotal += $product["lineTotal"];
            }
        }
        $gst = $subtotal * 0.10;
        $total = $subtotal + $gst;

        if (isset($_POST["deposit"])) {
            $deposit = floatval($_POST["deposit"]);
        } else {
            $deposit = 0;
        }

        if ($deposit < 0) {
            $deposit = 0;
        }
        $totalDue = $total - $deposit;
    ?>

    <h1>Totally Wonderful Awnings</h1>
    <h2>Awning Order – Customer Copy</h2>
    <p>Thanks for ordering your awning with Totally Wonderful Awnings. Check the order details. Notify our reception staff if any corrections are needed. Note: 50% of Total Order amount is due at least two weeks prior to installation.</p>
    
    <h3><span class="blue">Quote Details</span></h3>
    <p>
    <table class="summary">
       <tr>
            <td>Quote Date:</td> 
            <td class="blue"><?php echo "$quoteDate"; ?></td> 
       </tr>
       <tr>
            <td>Quoted by:</td> 
            <td class="blue"><?php echo "$staffname"; ?></td> 
       </tr>
       <tr>
            <td>Customer:</td> 
            <td class="blue"><?php echo "$title" . " " . "$fname" . " " . "$lname"; ?></td> 
       </tr>
       <tr>
            <td>Address:</td> 
            <td class="blue"><?php echo nl2br("\n$address" . "\n" . "$suburb" . "\n" . "$postcode"); ?></td> 
       </tr>
       <tr>
            <td>Phone: </td> 
            <td class="blue"><?php echo "$phone"; ?></td> 
       </tr>
       <tr>
            <td>Email:</td> 
            <td class="blue"><?php echo "$email"; ?></td> 
       </tr>
    </table>
    </p>

    <h3>Products Ordered</h3>
    <p>
        <table>
            <tr class="blue">
                <th>Product ID</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Line Total</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <?php if ($product["qty"] > 0): ?>
                    <tr>
                        <td><?php echo $product["id"]; ?></td>
                        <td><?php echo $product["desc"]; ?></td>
                        <td><?php echo $product["qty"]; ?></td>
                        <td>$<?php echo $product["price"]; ?></td>
                        <td>$<?php echo $product["lineTotal"]; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </p>

    <h3>Installation Details</h3>
    <p>
        <table class="summary">
            <tr>
                <td>Installation Notes:</td><td class="blue"><?php echo "$installNotes"; ?></td> 
            </tr> 

            <tr>
                <td>Requested Installation Date:</td> 
                <td class="blue"><?php echo "$installDate"; ?></td> 
            </tr> 
        </table>   
    </p>

    <h3>Payment Details</h3>
    <p>
        <table class="summary">
            <tr>
                <td>Subtotal:</td>
                <td class="blue">$<?php echo $subtotal; ?></td>
            </tr>
            <tr>
                <td>GST:</td>
                <td class="blue">$<?php echo $gst; ?></td>
            </tr>
            <tr>
                <td>Total:</td>
                <td class="blue">$<?php echo $total; ?></td>
            </tr>
            <tr>
                <td>Deposit:</td>
                <td class="blue">$<?php echo $deposit; ?></td>
            </tr>
            <tr>
                <td><strong>Total Due:</strong></td>
                <td class="blue"><strong>$<?php echo $totalDue; ?></strong></td>
            </tr>
        </table>
    </p>
</body>
</html>