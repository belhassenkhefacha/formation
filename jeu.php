<?php
//checkbox
$parfums=[
    'Fraise' => 4,
    'Chocolat'=>5,
    'Vanille'=>3
];
//radio
$cornets=[
    'Pot' => 2,
    'Cornet' => 3
];
//checkbox
$supplements=[
    'Pepite de chocolat' =>1,
    'Chantilly'=>0.5
];
$title="Composer votre glace";
$aDeviner = 150;
$erreur=null;
$success=null;
$value=null;
if (isset($_POST['chiffre'])) { 
    if ($_POST['chiffre'] > $aDeviner) {
        $erreur = "Votre chiffre est trop grand";
    } elseif ($_POST['chiffre'] < $aDeviner) {
        $erreur = "Votre chiffre est trop petit";
    } else {
        $success = "Bravo! Vous avez deviné le chiffre.";
    }
    $value=(int)$_POST['chiffre'];
}
require 'header.php';
?>

<?php if($erreur) :?>
<div class="alert alert-danger">
<?= $erreur ?>
</div>

<?php elseif($success) :?>
<div class="alert alert-success">
<?= $success ?>
</div>
<?php endif ?>



<h1>Composer votre glace</h1>
<hr>
<h2>Votre glace</h2>
<hr>
<h3>Choisissez vos parfums</h3>
<form action="/jeu.php" method="GET">
    <?php foreach ($parfums as $parf => $prix) : ?>
        <div class="checkbox">
            <label>
                <?= checkbox('parfum',$parf,$_GET)?>
                <?= $parf ?> - <?= $prix ?> $
            <label>
        </div>
    <?php endforeach; ?>
    <h3>Choisissez votre cornet</h3>
    <?php foreach ($cornets as $cornet => $prix) : ?>
        <div class="radio">
            <label>
                <?= radio('cornet',$cornet,$_GET)?>
                <?= $cornet ?> - <?= $prix ?> $
            <label>
        </div>
    <?php endforeach; ?>
    <h3>Choisissez votre supplements</h3>
    <?php foreach ($supplements as $supp => $prix) : ?>
        <div class="checkbox">
            <label>
                <?= checkbox('supplement',$supp,$_GET)?>
                <?= $supp ?> - <?= $prix ?> $
            <label>
        </div>
    <?php endforeach; ?>
    <input type="submit" value="Composer ma glace">

    <input type="number" class="form-control" name="chiffre" placeholder="entre 0 et 100" value="<?= $value ?>">

    <input type="text" name="domo[]">
    <input type="text" name="domo[]">

    <button type="submit" class="btn btn-primary">Deviner</button>
</form>

<?php require 'footer.php'; ?>
