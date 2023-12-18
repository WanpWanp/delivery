<?php 

    //Autorizado - CPntrole de a

    //checando se o usuario está logado ou não
    if(!$_SESSION['user'])/*Se a sessão de usuário está setada */{
        //Usuario não logado
        //Redirecionar para página de login
        $_SESSION['no-login-message'] = "<div class='error text-center'> Por favor faça o login para acessar esta área. </div>";
        header("Location:" . SITE_URL . "admin/login.php");
    }

?>