<?php
$firstName = "Alice"; // String
$lastName = "Miller";
$age = 25; // Integer
$height = 1.75; // Float
$isStudent = true; // Boolean
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Example</title>
</head>
<body>
    <h1>Welcome!</h1>
    <p>Today's date is: <?php echo date("d.m.Y"); ?></p>
    <h2>Ausgabe der Variablen</h2>
    <p><strong>Name: </strong><?php echo $firstName. " " .$lastName ?></p>
    <p><strong>Age: </strong><?php echo $age ?></p>
    <p><strong>Height: </strong><?php echo $height ?></p>
    <p><strong>isStudent: </strong><?php echo $isStudent ?></p>
</body>
</html>