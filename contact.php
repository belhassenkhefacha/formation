<?php
session_start();
$title="Nous contacter";
require_once 'config.php';
require_once 'functions.php';
//recuperer l'heure d'aujourd'hui
$heure=(int)($_GET['heure'] ?? date('G'));
$jour=(int)($_GET['jour'] ?? date('N')-1);
//recuperer les creneaux d'ajourdh'hui
$creneaux=CRENEAUX[$jour];
//recuperer l'etat de l'ouverture du magasin
$ouvert=in_creneaux($heure,$creneaux);
$color=$ouvert ? 'green' : 'red';
require 'header.php';
?>
<div class="row">
    <div class="col md-8">
        <h2>Debug</h2>
        <pre>
            <? var_dump( $_SESSION); ?>
        </pre>
    </div>
    <div class="col-md-8">
        <h2>Nous contacter</h2>
        <form action="" method="GET">
            <div class="form-group">
                <select class="form-control">
                    <?php foreach(JOURS as $k => $jour):?>
                    <option value="<?= $k ?>"><?=$jour ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure?>">
            </div>
            <button class="btn btn-primary" type="submit">voir si le magasin est ouvert</button>
        </form>
    </div>
    <div class="col-md-4">
        <h2>Horaire d'ouverture</h2>
        <?php if($ouvert): ?>
        <div class="alert alert-success">
            Le magasin sera ouvert
        </div>
        <?php else :?>
        <div class="alert alert-danger">
            Le magasin sera fermé
        </div>
        <?php endif ?>
        <ul>
            <?php foreach (JOURS as $k => $jour): ?>
            <li <?php if ($k + 1 === (int)date('N')): ?> style="color:<?= $color ?>"<?php endif; ?>>
            <strong><?= $jour ?></strong>
            <?= creneaux_html(CRENEAUX[$k]); ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php require 'footer.php'; ?>