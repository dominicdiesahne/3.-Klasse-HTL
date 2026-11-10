<?php
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$pflichtfelder = [
    'vorname'  => 'Vorname',
    'nachname' => 'Nachname',
    'email'    => 'E-Mail',
];

$optionaleFelder = [
    'nachricht' => 'Nachricht',
];

$alleFelder = $pflichtfelder + $optionaleFelder;

$speicherdatei = __DIR__ . '/daten.csv';

$werte = array_fill_keys(array_keys($alleFelder), '');
$fehlendeFelder = [];

$formularAbgeschickt = ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['absenden']));

if ($formularAbgeschickt) {
    foreach ($alleFelder as $feld => $label) {
        $werte[$feld] = trim($_POST[$feld] ?? '');
    }

    foreach ($pflichtfelder as $feld => $label) {
        if ($werte[$feld] === '') {
            $fehlendeFelder[] = $label;
        }
    }

    if ($werte['email'] !== '' && !filter_var($werte['email'], FILTER_VALIDATE_EMAIL)) {
        $fehlendeFelder[] = 'E-Mail (ungültiges Format)';
    }
}

$allesAusgefuellt = $formularAbgeschickt && empty($fehlendeFelder);

$speicherFehler = false;
if ($allesAusgefuellt) {
    $neueDatei = !file_exists($speicherdatei);
    $handle = @fopen($speicherdatei, 'a');

    if ($handle !== false) {
        flock($handle, LOCK_EX);
        if ($neueDatei) {
            fputcsv($handle, array_merge(['Zeitpunkt'], array_values($alleFelder)), ';');
        }
        fputcsv($handle, array_merge([date('Y-m-d H:i:s')], array_values($werte)), ';');
        flock($handle, LOCK_UN);
        fclose($handle);
    } else {
        $speicherFehler = true;
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktformular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 mb-4">Kontaktformular</h1>

<?php if ($allesAusgefuellt): ?>

    <?php if ($speicherFehler): ?>
                    <div class="alert alert-danger">Die Daten konnten nicht gespeichert werden.</div>
    <?php else: ?>
                    <div class="alert alert-success">Vielen Dank! Ihre Daten wurden gespeichert.</div>
    <?php endif; ?>

                    <table class="table table-bordered">
                        <tbody>
        <?php foreach ($alleFelder as $feld => $label): ?>
                            <tr>
                                <th class="table-light w-25"><?= e($label) ?></th>
                                <td><?= nl2br(e($werte[$feld])) ?></td>
                            </tr>
        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <a class="btn btn-outline-primary" href="<?= e($_SERVER['PHP_SELF']) ?>">Neues Formular ausfüllen</a>

<?php else: ?>

    <?php if ($formularAbgeschickt): ?>
                    <div class="alert alert-danger">
                        <strong>Bitte füllen Sie alle Pflichtfelder aus:</strong>
                        <ul class="mb-0 mt-2">
            <?php foreach ($fehlendeFelder as $label): ?>
                            <li><?= e($label) ?></li>
            <?php endforeach; ?>
                        </ul>
                    </div>
    <?php endif; ?>

                    <form method="post" action="<?= e($_SERVER['PHP_SELF']) ?>" novalidate>
    <?php foreach ($alleFelder as $feld => $label):
        $istPflicht = isset($pflichtfelder[$feld]);
        $hatFehler  = $formularAbgeschickt && (
            ($istPflicht && $werte[$feld] === '') ||
            ($feld === 'email' && $werte[$feld] !== '' && !filter_var($werte[$feld], FILTER_VALIDATE_EMAIL))
        );
        $klasse = 'form-control' . ($hatFehler ? ' is-invalid' : '');
    ?>
                        <div class="mb-3">
                            <label for="<?= e($feld) ?>" class="form-label">
                                <?= e($label) ?><?php if ($istPflicht): ?> <span class="text-danger">*</span><?php endif; ?>
                            </label>
        <?php if ($feld === 'nachricht'): ?>
                            <textarea class="<?= $klasse ?>" id="<?= e($feld) ?>" name="<?= e($feld) ?>" rows="5"><?= e($werte[$feld]) ?></textarea>
        <?php else: ?>
                            <input type="<?= $feld === 'email' ? 'email' : 'text' ?>" class="<?= $klasse ?>"
                                   id="<?= e($feld) ?>" name="<?= e($feld) ?>" value="<?= e($werte[$feld]) ?>">
        <?php endif; ?>
                        </div>
    <?php endforeach; ?>

                        <button type="submit" name="absenden" value="1" class="btn btn-primary">Absenden</button>
                        <p class="form-text mt-3 mb-0"><span class="text-danger">*</span> Pflichtfeld</p>
                    </form>

<?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>