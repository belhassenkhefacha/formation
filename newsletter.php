<?php
$error=null;
$success=null;
$email=null;
if(!empty($_POST['email'])){
    $email=$_POST['email'];
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $file=__DIR__.DIRECTORY_SEPARATOR.'emails'.DIRECTORY_SEPARATOR.date('Y-m-d');
        file_put_contents($file,$email.PHP_EOL,FILE_APPEND);
        $success="Votre mail a été bien enregistré";
        $email=null;
    }else{
        $error="Email invalide";
    }
}

require 'header.php';
?>
<h1>S'inscrire a la newsletter</h1>
<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, nulla iure perferendis ex cum similique fugit esse dolore, saepe, quidem est? Quis, eligendi magnam non quo quasi ipsam laboriosam suscipit.
</p>
<?php if ($error) : ?>
    <div class="alert alert-danger">
        <h2><?= $error ?></h2>
    </div>
<?php else : ?>
    <div class="alert alert-success">
        <h2><?= $success ?></h2>
    </div>
<?php endif ?>
<form action="\newsletter.php" method="POST" class="form-inline">
    <div class="form-group">
        <input type="email" required>
    </div>
    <button type="submit" class="btn btn-primary" value="S'inscrire">Submit</button>
</form>








<?php
require 'footer.php';
?>

?>