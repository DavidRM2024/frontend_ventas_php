<?php 
require_once 'partials/security/auth.php';
public_routes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestión de Productos</title>
    <?php require_once 'partials/header.php' ?>
    <?php require_once 'partials/security/auth.php'; ?>
</head>

<body>
    <?php require_once 'partials/navbar.php'; ?>
    <div class="container mt-5" id="content">
    
            Bienvenido al sistema de Gestión de Productos
       
    </div>
    <?php require_once 'partials/footer.php'; ?>
</body>

</html>