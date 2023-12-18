<?php include('../config/constant.php') ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="./assets/css/admin.css">
	<title>Login - Restaurante admin</title>
</head>
<body>
    <?php include('../funcoes/admin/php/funcao-login.php'); ?>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php 
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br><br>
        <!--Começo do formulário de login aqui-->
        <form action="" method="POST" class="text-center">
            Usuário admin: <br>
            <input type="text" name="username" placeholder="Nome de Usuário" class="cent-45">
            <br><br>
            Senha: <br>
            <input type="password" name="password" id="nova" placeholder="Senha" clas="cent-45">
            <div class="right-up">
                <img onclick="mostrarSenha()" src="../img/icons8-visível-30.png" alt="">
                <img onclick="ocultarSenha()" src="../img/icons8-olho-fechado-30.png" alt="">
            </div>
            <input type="submit" name="submit" value="Login" class="btn-login btn-primary">
        </form>
        <!--Fim do formulário de login aqui-->
    </div>
    <script>
        function mostrarSenha() {
            var tipo = document.getElementById ("nova");
            if (tipo.type == 'password'){
                tipo.type = 'text';
            }
        }
        function ocultarSenha() {
            var tipo = document.getElementById ("nova");
            if (tipo.type == 'text'){
                tipo.type = 'password';
            }
        }
    </script>
	<?php include('./pacotes/footer.php') ?>