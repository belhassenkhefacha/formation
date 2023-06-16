<?php
require '../vendor/autoload.php';
use App\App;
App::getAuth()->requireRole('user','admin');
?>
Reservé a l'utilisateur