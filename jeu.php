<?php
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




<form action="/jeu.php" method="POST">
    <div class="form-group">
        <input type="number"  class="form-control" name="chiffre" placeholder="entre 0 et 100" value="<?= $value ?>">
    </div>
    <button type="submit" class="btn btn-primary">Deviner</button>
</form>


<?php require 'footer.php'; ?>
