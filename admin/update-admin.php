<?php include('./pacotes/menu.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Atualizar Admin </h1>

            <br><br>

            <?php 
            
                //Buscar o id do Admin selecionado
                $id = $_GET['id'];

                //Criar a query que busca ps detalhe
                $sql = "SELECT id, nome_completo, nome_usuario, senha from tbl_admin WHERE id = $id";

                //Executar a query
                $res = mysqli_query($conn,$sql);

                //Checando se a query foi execultada
                if($res == true) { 
                    //Se  consulta foi execultada
                    $count = mysqli_num_rows($res);

                    //Checar se temos dados do admin ou não
                    if($count == 1) {
                        //Buscar os detalhes
                        //echo "Admin disponível";
                        $row = mysqli_fetch_assoc($res);

                        $fullname = $row['nome_completo'];
                        $username = $row['nome_usuario'];
                        $id = $row['id'];
                    } else {
                        //Redirecionar para a página do administrator
                        $_SESSION['no-admin-found'] = "<div class='error'>Admin não encontrado</div>";
                        header('location: ' . SITE_URL . 'admin/manage-admin.php');
                    }   
                }
            
            ?>

            <form action="" method="POST">

                <table class=" tbl-30">
                    <tr>
                        <td>Nome Completo:</td>
                        <td><input type="text" name="full_name" value="<?php echo $fullname ?>"></td>
                    </tr>
                    <tr>
                        <td>Nome de usuário:</td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Atualizar Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <div class="clearfix"></div>
        </div>
    </div>
    <!--Fim Seção content-main-->

    <?php 
    
        //Checando se o botão foi clicado
        if(isset($_POST['submit'])) {
            // Se o botão foi clicado
            //echo "Botão clicado";

            //Buscar os dados do formulário para atualizar
            $id = $_POST['id'];
            $fullname = $_POST['full_name'];
            $username = $_POST['username'];
            

            //Criando a query que faz a atualiação do admin
            $sql2 = "UPDATE tbl_admin SET 
            nome_completo = '$fullname',
            nome_usuario = '$username' 
            WHERE id = $id
            ";

            //Executar a query
             $res = mysqli_query($conn, $sql2);

             //Checar se a query foi ou não executada
             if($res == true) {
                //Executada
                $_SESSION['update-admin'] = "<div class='success'>Admin Atualizado com Sucesso.</div>";
                 
                //redirecionando para a página de gerenciamento de admin
                header('location:' . SITE_URL . 'admin/manage-admin.php');

             } else {
                //Não executada
                $_SESSION['update-admin'] = "<div class='error'>Falha na atualização.</div>";

                //redirecionando para a página de gerenciamento de admin
                header('location:' . SITE_URL . 'admin/manage-admin.php');
             }
            
        } /*else {
            //Se o botão não foi clicado
            //echo "Não foi clicado";
        }*/

    ?>

<?php include('./pacotes/footer.php'); ?>