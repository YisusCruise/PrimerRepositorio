<?php
include 'includes/database.php';
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
secure();


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
           <div class="display-1">DASHBOARD</div>
           <a href="users.php">Administracion Usuarios</a>|
           <a href="post.php">Administracion de contenido</a>
        </div>
    </div>
</div>

<?php

include 'includes/footer.php';
?>