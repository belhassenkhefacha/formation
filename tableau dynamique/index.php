<?php
//require 'vendor/autoload.php';
require_once 'src/NumberHelper.php';
require_once 'src/TableHelper.php';
require_once 'src/URLHelper.php';

use App\NumberHelper;
use App\TableHelper;
use App\URLHelper;

define('PER_PAGE',20);
$pdo=new PDO('mysql:host=localhost;dbname=exercice','root','',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
$query="SELECT * FROM products";
$querycount="SELECT count(id) as count FROM products";
$params=[];
$sortable=["id","name","price","address","vity"];

//Recherche par ville
if(!empty($_GET['q']))
{
    $query .=" WHERE city LIKE :city";
    $querycount .=" WHERE city LIKE :city";
    $params['city']='%' . $_GET['q'] . '%' ;
}

//Organisation
if(!empty($_GET['sort']) && in_array($_GET['sort'],$sortable))
{
    $direction=$_GET['dir'] ?? 'asc';
    if(!in_array($direction,['asc','desc']))
    {
        $direction='asc';
    }
    $query .= " ORDER BY ". $_GET['sort'].$direction;
}


//Pagination
$page=(int)$_GET['p'] ?? 1;
$offset=0;
if($page>1)
{
    $offset= ($page-1)*PER_PAGE;
}
$query.= " LIMIT ".PER_PAGE. " OFFSET $offset";
$statement =$pdo->prepare($query);
$statement->execute($params);
$products=$statement->fetchAll();

$statement =$pdo->prepare($querycount);
$statement->execute($params);
$count=(int)$statement->fetch()['count'];
$pages=ceil($count/PER_PAGE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Biens immobiliers</title>
</head>
<body class="p-4">
    <h1>Les bien immobiliers</h1>
    <form action="" class="m-4">
        <div class="form-group">
            <input type="text" class="form-control" name="q" placeholder="Rechercher par Ville" value="<?= htmlentities($_GET['q'] ?? null ) ?>">
        </div>
        <button class="btn btn-primary">Rechercher</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= TableHelper::sort('id','ID',$_GET) ?></th>
                <th><?= TableHelper::sort('name','Nom',$_GET) ?></th>
                <th><?= TableHelper::sort('price','Prix',$_GET) ?></th>
                <th><?= TableHelper::sort('City','Ville',$_GET) ?></th>
                <th><?= TableHelper::sort('Address','Adresse',$_GET) ?></th>
            </tr>
            
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
            <tr>
                <td>#<?= $product['id'] ?></td>
                <td><?= htmlentities($product['name']) ?></td>
                <td><?= NumberHelper::price($product['price']) ?></td>
                <td><?= htmlentities($product['address']) ?></td>
                <td><?= htmlentities($product['city']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if($pages>1 && $page<1):?>
        <a href="?p=<?= URLHelper::withParam($_GET['p'],"p",$page - 1)?>" class="btn btn-primary">Page Precedente</a>
    <?php endif ?>
    <?php if($pages>1 && $page<$pages):?>
        <a href="?p=<?= URLHelper::withParam($_GET['p'],"p",$page + 1)?>" class="btn btn-primary">Page Suivante</a>
    <?php endif ?>
</body>
</html>