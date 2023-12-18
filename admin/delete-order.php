<?php 

    //incluindo os arquivos constants.php
    include('../config/constant.php');

    //Verificar se o id e a imagem estão com valor setados ou não
    if(isset($_GET['id'])) {
        //Pegar o valor e delatar
        //echo "Buscar valores e deletar";
        $id = $_GET['id'];
        //$image_name = $_GET['image_name'];

        //Remover a imagem fisica caso esteja disponivel
        /*if($image_name != "") {
            //Imagem disponovel. apenas remove-la
            $patch = "../images/food/" .  $image_name;
            //Remover a imagem.
            $remove = unlink($patch);

            //Se houver falha na remoção da imagem, irá retornar uma mensagem de erro e para o processo
            if($remove ==  false) {
                //Setar a mensagem de erro
                $_SESSION['remove-order'] = "<div class='error'>Falha ao remover imagem do pedido</div>";
                //Redirecionar para página pratos
                header('location: ' . SITE_URL . 'admin/manage-order.php');
                //Parar o processo
                die();
            }
        }*/


        //Deletar o dados do banco de dados
        //query sql para deletar dados do Banco
        $sql = "DELETE FROM tbl_pedido WHERE id = $id";

        //Executa a query para realizar o delete
        $res =  mysqli_query($conn, $sql);

        //Checar se os dados foram deletados ou não do banco
        if($res == true) {
            //Setar a mensagem de sucesso ao deletar a categoria e redirecionar 
            $_SESSION['delete-order'] = "<div class='success'>Pedido deletado com sucesso</div>";

            header("Location:" . SITE_URL . "admin/manage-order.php");
        } else {
            //Setar a mensagem de erro
            $_SESSION['delete-order'] = "<div class='error'>Falha ao deletar pedido</div>";

            header("Location:" . SITE_URL . "admin/manage-order.php");
        }


        //Redirecionar para a pagina de pratos com mensagem
    } else {
        //Redirecionar para a página do prato
        header('location:' . SITE_URL . 'admin/manage-order.php');
    }



?>