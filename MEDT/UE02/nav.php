<?php
$seite = $_GET["seite"] ?? "";
 
if ($seite != "Link 1" && $seite != "Link 2" && $seite != "Link 3") {
    $seite = "";
}
?>
 
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
 
        <a class="navbar-brand" href="nav.php">Navbar</a>
 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
 
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
 
                <li class="nav-item">
                    <a class="nav-link" href="?seite=Link%201">Link 1</a>
                </li>
 
                <li class="nav-item">
                    <a class="nav-link" href="?seite=Link%202">Link 2</a>
                </li>
 
                <li class="nav-item">
                    <a class="nav-link" href="?seite=Link%203">Link 3</a>
                </li>
 
            </ul>
        </div>
    </div>
</nav>
 
<main class="container mt-4">
    <?php
    if ($seite != "") {
        echo "<h1>" . htmlspecialchars($seite) . "</h1>";
    }
    ?>
</main>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>
 