<?php 
$title='Notre menu';
$lignes=file(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'menu.tsv');
require 'header.php';
foreach ($lignes as $k => $ligne) {
    $lignes[$k]= explode("\t", trim($ligne));
}

?>

<h1>Menu</h1>

<?php 
foreach($lignes as $ligne) :
    if(count($ligne)===1) : ?>
        <h2><?= $ligne[0] ?></h2>
    <?php else : ?>
        <div class="row">
            <div class="col-sm-8">
                <p>
                    <strong><?= $ligne[0] ?></strong><br>
                </p>
            </div>
        </div>
        <div class="col-sm-4">
            <?= number_format($ligne[2],2,',',' '); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?> 




<?php 
require 'footer.php';
?>