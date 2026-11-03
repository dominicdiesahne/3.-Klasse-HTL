<?php
$points = 62;
$grade = "";

if($points <= 49){
    $grade .= "Nicht Genügend";
}else if($points <= 59){
    $grade .= "Genügend";
}else if($points <= 74){
    $grade .= "Befriedigend";
}else if($points <= 89){
    $grade .= "Gut";
}else if($points <= 100){
    $grade .= "Sehr Gut";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notenberechnung</title>
</head>
<body>
    <p><?php echo "Note: " . $grade; ?></p>
</body>
</html>