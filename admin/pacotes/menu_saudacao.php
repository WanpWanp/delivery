<?php include('../config/constant.php'); ?>
<?php include('login-check.php'); ?>
<html>
<head>
    <title>Site de Pedidos de Comida - Página Inicial</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
</head>
<body>
    <?PHP
            
    ?>
    <?php include('../funcoes/admin/php/funcao-saudacao.php'); ?>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-category.php">Categorias</a></li>
                <li><a href="manage-food.php">Cardápio</a></li>
                <li><a href="manage-order.php">Pedido</a></li>
            </ul>
        </div>
        <?php 
            if (isset($_SESSION['user']) & $username == "Wanp") {
        ?>     
                <div id='header_saudacao'>
                    <h5>Seja bem vindo, <?php echo $_SESSION['user'];?> | <a href='logout.php'> Sair </a> </h5>
                </div>
                <div id='novo-admin'>
                    <h5> <a href='add-admin.php'>Criar novo admin </a> </h5>
                </div>
        <?php        
            } 
            if (isset($_SESSION['user']) & ($username) != "Wanp"){
        ?>
                <div id='header_saudacao'>
                    <h5>Seja bem vindo, <?php echo $_SESSION['user'];?> | <a href='logout.php'> Sair </a> </h5>
                </div>
        <?php
            }
        ?>
    </div>