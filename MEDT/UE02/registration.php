<?php
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
 
if ($submitted) {
    $anrede = $_POST['anrede'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $alter = $_POST['alter'];
    $email = $_POST['email'];
}
?>
 
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veranstaltungsanmeldung</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body class="bg-light">
 
<div class="container mt-5">
 
    <div class="card shadow mx-auto" style="max-width: 600px;">
 
        <div class="card-header bg-primary text-white text-center">
            <h3>Veranstaltungsanmeldung</h3>
            <p class="mb-0">Bitte fülle alle Felder aus.</p>
        </div>
 
        <div class="card-body">
 
            <form method="POST" action="ue02-task6-registration.php">
 
                <div class="mb-3">
                    <label for="anrede" class="form-label">Anrede *</label>
                    <select class="form-select" id="anrede" name="anrede" required>
                        <option value="" selected disabled>Bitte auswählen</option>
                        <option value="Herr">Herr</option>
                        <option value="Frau">Frau</option>
                        <option value="Divers">Divers</option>
                    </select>
                </div>
 
                <div class="mb-3">
                    <label for="vorname" class="form-label">Vorname *</label>
                    <input type="text" class="form-control" id="vorname" name="vorname" required>
                </div>
 
                <div class="mb-3">
                    <label for="nachname" class="form-label">Nachname *</label>
                    <input type="text" class="form-control" id="nachname" name="nachname" required>
                </div>
 
                <div class="mb-3">
                    <label for="alter" class="form-label">Alter *</label>
                    <input type="number" class="form-control" id="alter" name="alter"
                           min="18" max="99" step="1" required>
                    <div class="form-text">Erlaubter Wertebereich: 18 bis 99 Jahre.</div>
                </div>
 
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail-Adresse *</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
 
                <button type="submit" class="btn btn-primary w-100">
                    Anmeldung absenden
                </button>
 
            </form>
 
        </div>
    </div>
 
    <?php if ($submitted): ?>
 
        <div class="card shadow mx-auto mt-4 mb-5" style="max-width: 600px;">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Anmeldedaten</h4>
            </div>
 
            <div class="card-body">
 
                <p><strong>Anrede:</strong>
                    <?= htmlspecialchars($anrede, ENT_QUOTES, 'UTF-8') ?>
                </p>
 
                <p><strong>Vorname:</strong>
                    <?= htmlspecialchars($vorname, ENT_QUOTES, 'UTF-8') ?>
                </p>
 
                <p><strong>Nachname:</strong>
                    <?= htmlspecialchars($nachname, ENT_QUOTES, 'UTF-8') ?>
                </p>
 
                <p><strong>Alter:</strong>
                    <?= htmlspecialchars($alter, ENT_QUOTES, 'UTF-8') ?>
                </p>
 
                <p><strong>E-Mail:</strong>
                    <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
                </p>
 
            </div>
        </div>
 
    <?php endif; ?>
 
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>
 