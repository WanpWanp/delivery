<?php 

    //incluindo os arquivos constants.php
    include('../config/constant.php');

    //Pegar o id do admin a ser deletado
    $id = $_GET['id'];

    //Cria uma query sql para deletar o admin
    $sql = "DELETE FROM tbl_admin where id=$id";

    //Execução da query
    $res = mysqli_query($conn, $sql);

    //Checar se a query foi executada
    if($res == TRUE) {
        //Se a query foi executada com sucesso
        //echo "Admin Deletado";

        //Criando a sessão da variavel para aparecer a mensagem
        $_SESSION["delete-admin"] = "<div class='success'>Admin Excluido com Sucesso.</div>"; 

        //redirecionando para a página de gerenciamento de admin
        header('location:' . SITE_URL . 'admin/manage-admin.php');
    } else {
        //Se a query não foi executada com sucesso
        //echo "Falha na exclusão";

        //Criando a sessão da variavel para aparecer a mensagem
        $_SESSION["delete-admin"] = "<div class='error'>Falha ao Tentar Excluir o Admin. Tente outra vez.</div>";

        //redirecionando para a página de gerenciamento de admin
        header('location:' . SITE_URL . 'admin/manage-admin.php');
    }

    //Redirecionar para a página admin com a mensagem de (sucesso ou erro)



?>