<?php include('config/constant.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Foood TecGuilty</title>
</head>

<body>

    <!-- Navbar Starts here-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="./images/logo.png" alt="Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right ">
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>categories.php">Categorias</a></li>
                    <li><a href="<?php echo SITE_URL; ?>foods.php">Cardápio</a></li>
                    <li><a href="<?php echo SITE_URL; ?>">Contato</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Ends here-->