<?php include('./pacotes/menu.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
            <div class="wrapper">
                <h1>Atualizar Senha</h1>

                <br><br>

                <?php 

                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
            
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
                        $current_password = md5($row['senha']);
                        $id = $row['id'];
                    }
        
                }                  
            
            ?>

                <h3>Admin: <?php  echo $fullname;?></h3>
                <form action="" method="post">
                    <table class="tbl-30 tbl-newpassword">
                        <tr>
                            <td>Senha Atual:</td>
                            <td><input type="password" name="current-password" id="velha" placeholder="Digite Senha atual"></td>
                            <td><button type="button" onclick="mostrarSenhaVelha()"><img src="https://img.icons8.com/material-outlined/30/000000/visible--v1.png"/></button>

                            <button type="button" onclick="ocultarSenhaVelha()"><img src="https://img.icons8.com/material-outlined/30/000000/closed-eye.png"/></button></td>
                        </tr>
                        <tr>
                            <td>Senha Nova:</td>
                            <td><input type="password" name="new-password" id="nova" placeholder="Nova Senha"></td>
                            <td><button type="button" onclick="mostrarSenhaNova()"><img src="https://img.icons8.com/material-outlined/30/000000/visible--v1.png"/></button>
                            <button type="button" onclick="ocultarSenhaNova()"><img src="https://img.icons8.com/material-outlined/30/000000/closed-eye.png"/></button></td>
                        </tr>
                        <tr>
                            <td>Confirmar Senha Nova:</td>
                            <td><input type="password" name="confirm-password" id="nova2" placeholder="Confirmar Senha"></td>
                            <td><button type="button" onclick="mostrarSenhaNova2()"><img src="https://img.icons8.com/material-outlined/30/000000/visible--v1.png"/></button>

                            <button type="button" onclick="ocultarSenha2()"><img src="https://img.icons8.com/material-outlined/30/000000/closed-eye.png"/></button></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Atualizar Senha" class="btn-secondary">
                            </td>
                        </tr>

                    </table>
                </form>
                <div class="clearfix"></div>
            </div>
    </div>
    <!--Fim Seção content-main-->

    <?php 
    
        //Checando se o botão está sendo clicado ou não
    
    ?>

    <?php 
    
        //Checando se o botão foi clicado
        if(isset($_POST['submit'])) {
            // Se o botão foi clicado
            //echo "Botão clicado";

            //Buscar os dados do formulário para atualizar
            $id = $_POST['id'];
            $current_password = md5($_POST['current-password']);
            $new_password = md5($_POST['new-password']);
            $confirm_password = md5($_POST['confirm-password']);
            

            //Criando a query que faz a atualiação da senha
            $sql = "SELECT * FROM tbl_admin  WHERE id = $id AND senha='$current_password'";

            //Executar a query
             $res = mysqli_query($conn, $sql);

             //Checar se a query foi ou não executada
             if($res == true) {
                
                //checar se a dados válidos ou não
                $count = mysqli_num_rows($res);

                if($count == 1) {

                    // Usuário existe e a senha pode ser mudada
                    //echo "Usuário encontrado";

                    //Checar se a nova senha e a confirmação correspondem
                    if($new_password == $confirm_password) {
                        //Atualizar a senha. Mas uma vez que criamos uma consulta com o nome de sql, devemos criar uma novo nome para uma nova consulta
                        $sql2 = "UPDATE tbl_admin SET 
                                senha = '$new_password'
                                WHERE id = $id                        
                        ";

                        //Executar a query
                        $res2 = mysqli_query($conn, $sql2);

                        //Verificar se a query foi executada ou não
                        if ($res2 == true) {
                            //Executada
                            $_SESSION['update-password'] = "<div class='success'>Nova Senha Cadastrada com Sucesso</div>";

                            //Redirecionar para a página de admin
                            header('location:' . SITE_URL . 'admin/manage-admin.php');

                        } else {
                            //Não executada
                            $_SESSION['update-password'] = "<div class='error'>Nova não Senha Cadastrada</div>";

                            //Redirecionar para a página de admin
                            header('location:' . SITE_URL . 'admin/manage-admin.php');
                        }
                        //echo "Senha Atualizada";
                        

                    } else {
                        //Redirecionar para a página de admin
                        $_SESSION['pwd-not-match'] = "<div class='error'>Nova Senha não Combina na Confirmação</div>";
                        header('location:' . SITE_URL . 'admin/manage-admin.php');
                    }


                    //$_SESSION['update-admin'] = "<div class='success'>Admin Atualizado com Sucesso.</div>";
                 
                    //redirecionando para a página de gerenciamento de admin
                    //header('location:' . SITE_URL . 'admin/manage-admin.php');

                } else {
                    //Usuário não existe, daí enviaremos uma mensagem e redirecionar
                     $_SESSION['user-not-found'] = "<div class='error'>Usuário não encontrado.</div>";
                     header('location:' . SITE_URL . 'admin/manage-admin.php');
                }
             }
            
        } /*else {
            //Se o botão não foi clicado
            echo "Não foi clicado";
        }*/

    ?>
    <script>
        
        function mostrarSenhaVelha() {
            var tipo = document.getElementById ("velha");

            if (tipo.type == 'password') {
                tipo.type = 'text';
            }
        }

        function mostrarSenhaNova() {
            var tipo = document.getElementById ("nova");

            if (tipo.type == 'password') {
                tipo.type = 'text';
            }
        }

        function mostrarSenhaNova2() {
            var tipo = document.getElementById ("nova2");

            if (tipo.type == 'password') {
                tipo.type = 'text';
            }
        }

        function ocultarSenhaVelha() {
            var tipo = document.getElementById ("velha");

            if (tipo.type == 'text'){
                tipo.type = 'password';
            }
        }

        function ocultarSenhaNova() {
            var tipo = document.getElementById ("nova");

            if (tipo.type == 'text'){
                tipo.type = 'password';
            }
        }

        function ocultarSenhaNova2() {
            var tipo = document.getElementById ("nova2");

            if (tipo.type == 'text'){
                tipo.type = 'password';
            }
        }

    </script>

<?php include('./pacotes/footer.php'); ?>