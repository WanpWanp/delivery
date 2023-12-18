<?php

    //Iniciando sessão
    session_start();

    //*Criando constantes para não armazenas valor repetidos

    define('SITE_URL', 'http://localhost/delivery_1.1/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order1.1');

    //Conexão com banco de dados
    //$conn = mysqli_connect('host', 'username', 'password') or die(mysqli_error());
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die('Erro: ' . mysqli_error($conn)); //Parametros feitos por conta propria

    //$db_select = mysqli_select_db($conn,'DBNAME') or die(mysqli_error()); Selecionando o Banco de dados
    $db_select = mysqli_select_db($conn, DB_NAME) or die('Erro: ' . mysqli_error($DB_NAME)); //Parametros feitos por conta propria
?>