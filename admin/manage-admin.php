<?php include('./pacotes/menu_saudacao.php'); ?>
    <!--Inicio Seção content-main-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Gerenciador</h1>

            <br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']); //remove mensagem da seção
            }

            if (isset($_SESSION['delete-admin'])) {
                echo $_SESSION['delete-admin'];
                unset($_SESSION['delete-admin']);
            }

            if (isset($_SESSION['update-admin'])) {
                echo $_SESSION['update-admin'];
                unset($_SESSION['update-admin']);
            }

            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if (isset($_SESSION['update-password'])) {
                echo $_SESSION['update-password'];
                unset($_SESSION['update-password']);
            }

            if (isset($_SESSION['user-one'])) {
                echo $_SESSION['user-one'];
                unset($_SESSION['user-one']);
            }
            if (isset($_SESSION['no-admin-found'])) {
                echo $_SESSION['no-admin-found'];
                unset($_SESSION['no-admin-found']);
            } 
            ?>

            <br><br>

            <!-- Btn para adicionar Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>Código</th>
                    <th>Nome completo</th>
                    <th>Nome de usuário</th>
                    <th>Ação</th>
                    <th></th>
                </tr>

                <?php
                    //Query para mostrar tods admin
                    $sql = "SELECT id, nome_completo, nome_usuario, senha FROM tbl_admin";

                    //Execção da Query
                    $res = mysqli_query($conn, $sql);

                    //Checar se a query foi executada ou nao

                    if ($res == true) {
                        //Contar as linhas para verificar se temos dados no banco
                        $count = mysqli_num_rows($res); // Função que busca (pega) as linhas dentro do banco 

                        $nid = 1; //Criando a variavel para fazer o incremento de id na sequencia, pois no Banco de dados ao se excluir um dado de um id, o mesmo permanece sem receber outros novos dados, ou seja, o id no banco de dados irá permanecer vazio

                        //checar o de linhas
                        if ($count > 0) {
                            //Temos dados no banco
                            while ($row = mysqli_fetch_assoc($res)) {
                                //Usando o wilhe para buscar todos os dados dentro do banco
                                //E o wilhe irá rodar enquanto tiver dados dentro do banco

                                //Busca individual de dados
                                $id = $row['id'];
                                $fullname = $row['nome_completo'];
                                $username = $row['nome_usuario'];
                                $current_password = md5($row['senha']);

                                //Mostrar os valores obtidos em nossa tabela
                ?>

                            <tr>
                                <td><?= $nid++; ?></td>
                                <td><?= $fullname; ?></td>
                                <td><?= $username; ?></td>
                                <td>
                                    <a href="<?php echo SITE_URL ?>admin/update-password.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/external-those-icons-fill-those-icons/28/000000/external-password-internet-security-those-icons-fill-those-icons-4.png"/></a>
                                    <a href="<?php echo SITE_URL ?>admin/update-admin.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/cotton/30/000000/create-new--v1.png"/></a>
                                    <a href="<?php echo SITE_URL ?>admin/delete-admin.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/stickers/30/000000/filled-trash.png"/></a>
                                </td>
                            </tr>

                <?php

                            }
                        } else {
                            //Não há dados no banco

                        }
                    }
                ?>


            </table>



            <div class="clearfix"></div>


        </div>
    </div>
    <!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>