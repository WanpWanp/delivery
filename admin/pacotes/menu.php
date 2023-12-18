<?php include('../config/constant.php');?>
<?php include('login-check.php'); ?>

<html>

    <head>
        <title>Site de Pedidos de Comida - Página Inicial</title>
        <link rel="stylesheet" href="./assets/css/admin.css">
    </head>
    <body>
    
        <!--Inicio Seção menu-->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <!--<li><a href="manage-admin.php">Admin</a></li>-->
                    <li><a href="manage-category.php">Categorias</a></li>
                    <li><a href="manage-food.php">Cardápio</a></li>
                    <li><a href="manage-order.php">Pedido</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>
        <!--Fim Seção menu-->
