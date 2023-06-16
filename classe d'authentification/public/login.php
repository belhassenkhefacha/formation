<?php
require '../vendor/autoload.php';
require '../src/Auth.php';
use App\App;
session_start();
$pdo=new PDO('mysql:host=localhost;dbname=exercice','root','',
[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
$auth=App::getAuth();
$error=false;
/*
if($auth->user()!==null)
{
    header('Location:index.php');
    exit();
}
*/
if(!empty($_POST))
{

$user=$auth->login($_POST['username'],$_POST['password']);
if($user){
    header('Location:index.php?login=1');
    exit();
}
$error=true;
}

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
    <h1>Se Connecter</h1>
    <?php if($error) :?>
        <div class="alert alert-danger">
            Identifiant ou mot de passe Incorrect
        </div>
    <?php endif ?>
    <?php if(isset($_GET['forbid'])) :?>
        <div class="alert alert-danger">
            L'acces a la page est interdit
        </div>
    <?php endif ?>
    <form action="" method="POST"></form>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="pseudo">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="motdepasse">
        </div>
        <button class="btn btn-primary">Se Connecter</button>
    </form>
    <?= var_dump($_SESSION); ?>
</body>
</html>