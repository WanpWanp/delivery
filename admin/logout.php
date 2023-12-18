<?php 

    //incluir a constants para o site
    include('../config/constant.php');

    //Destruin o sistema de Login
    session_destroy(); //derruba a $_SESSION['user]

    //Redeirecionar para login
    header('Location:' . SITE_URL . 'admin/login.php');

?>