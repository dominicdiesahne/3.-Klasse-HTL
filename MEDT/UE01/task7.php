<?php
$item1 = "Apple";
$price1 = 1.20;
$item2 = "Banana";
$price2 = 0.80;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Task 7</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Items</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $item1 ?></td>
            <td><?php echo $price1 ?></td>
        </tr>
        <tr>
            <td><?php echo $item2 ?></td>
            <td><?php echo $price2 ?></td>
        </tr>
    </tbody>
</table>
</body>
</html>