<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Flächenberechnung Rechteck</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<div class="container">
    <h1 class="mb-4">Rechteck-Fläche berechnen</h1>

    <?php
    // Verwende diese Variablen!
    $width = $height = $area = null;
    $showResult = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variablen zuweisen
        $width = floatval($_POST['width']);
        $height = floatval($_POST['height']);

        // @ToDo: Berechnung der Fläche
        // Your code...
        $area = $width * $height; 
    }
    ?>

    <!-- Formular -->
    <form method="post" class="mb-3">
        <div class="mb-3">
            <label for="width" class="form-label">Breite (in cm)</label>
            <input type="number" step="0.01" class="form-control" id="width" name="width" required value="<?php echo htmlspecialchars($width); ?>">
        </div>
        <div class="mb-3">
            <label for="height" class="form-label">Höhe (in cm)</label>
            <input type="number" step="0.01" class="form-control" id="height" name="height" required value="<?php echo htmlspecialchars($height); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Berechnen</button>
    </form>

    <div class="alert alert-success" role="alert">
        <?php echo "Die Fläche beträgt: " . $area . "cm^2" ?>
    </div>

</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>