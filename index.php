<?php 
session_start();
unset($_SESSION['role']);
$_SESSION['user']=[
    'username' => 'john',
    'password' => '0000'
];
$title="Page d'acceuil";
require 'header.php'; ?>
<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
</div>

<?php require 'footer.php';

