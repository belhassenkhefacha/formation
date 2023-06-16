<?php
require '../vendor/autoload.php';
use App\App;
$users=App::getPDO()->query('SELECT * FROM users')->fetchAll();
$user->App::getAuth()->user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="p-4">
    <h1>Acceder aux pages</h1>
    <?php if (isset($_GET['login'])) :?>
        <div class="alert alert-success">
            Vous etes bien identifié
        </div>
    <?php endif ?>

    <?php if ($user) :?>
        <p>Vous etes connecté en tant que <?= $user->username ?>-
        <a href="logout.php">Se deconnecter</a>
    </p>
    <?php endif ?>
    <ul>
        <li><a href="admin.php">Page Reservé a l'administrateur</a></li>
        <li><a href="user.php">Page Reservé a l'utilisateur</a></li>
    </ul>
</body>
</html>