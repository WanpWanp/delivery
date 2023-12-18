<?php
    //checando se o botão foi clicado ou não
    if(isset($_POST['submit'])) {
        //Se foi clicado
        //Processos do login
        //Pegar os dados do login no formulário
        //echo "Botão clicado";
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $id = $_POST['id'];
        //sql para verificar se o usuario e senha existe
        $sql = "SELECT id, nome_usuario, senha FROM tbl_admin WHERE nome_usuario = '$username' AND senha = '$password'";
        //Executar a query
        $res = mysqli_query($conn, $sql);
        //Verificar a contagem das linhas se o usuário existe ou não
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //Usuário disponivel e pode logar
            $_SESSION['login'] = "<div class='success'> Login com Sucesso </div>";
            $_SESSION['user'] = $username; //Checa se o usuario está logado ou não, e dai o logout desabilita tudo
            header("Location: " . SITE_URL . "admin/index.php?id=$id");
        } else {
            // não disponivel e não pode logar
            $_SESSION['login'] = "<div class='error text-center'> Login Sem Sucesso. Usuário ou Senha não Correspondem </div>";
            header("Location: " . SITE_URL . "admin/login.php");
        }
    } else {
        //Não foi clicado
        //echo "Não foi clicado.";
    }
?>