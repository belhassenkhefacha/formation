<?php
require '../vendor/autoload.php';
use App\App;
App::getAuth()->requireRole('admin');
?>
Reservé a l'admin