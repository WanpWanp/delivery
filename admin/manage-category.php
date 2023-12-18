<?php include('./pacotes/menu_saudacao.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
            <div class="wrapper">
                <h1>Gerenciar - Categorias</h1>

                <br>

                <?php
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //remove mensagem da seção
                    }
                    if (isset($_SESSION['category-one'])) {
                        echo $_SESSION['category-one'];
                        unset($_SESSION['category-one']);
                    }
                    if (isset($_SESSION['remove'])) {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if (isset($_SESSION['delete-category'])) {
                        echo $_SESSION['delete-category'];
                        unset($_SESSION['delete-category']);
                    }
                    if (isset($_SESSION['update-category'])) {
                        echo $_SESSION['update-category'];
                        unset($_SESSION['update-category']);
                    }
                    if (isset($_SESSION['no-category-found'])) {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }
                    if (isset($_SESSION['upload-image'])) {
                        echo $_SESSION['upload-image'];
                        unset($_SESSION['upload-image']);
                    }
                    if (isset($_SESSION['failed-remove'])) {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                ?>
                <br><br>

                <!-- Btn para adicionar Categoria -->
                <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add Categoria</a>

                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Código</th>
                        <th>Título Categoria</th>
                        <th>Imagem</th>
                        <th>Destaque</th>
                        <th>Ativo</th>
                        <th>Ação</th>
                    </tr>

                    <?php

                        //Query para pegar todos as informações no bando de dados
                        $sql = "SELECT id, titulo, nome_imagem, destaque, ativo FROM tbl_categoria";

                        //Executar a query
                        $resp = mysqli_query($conn, $sql);

                        //Criando o as linhas da tabela
                        $count = mysqli_num_rows($resp);

                        $nid = 1; //Criando a variavel para fazer o incremento de id na sequencia, pois no Banco de dados ao se excluir um dado de um id, o mesmo permanece sem receber outros novos dados, ou seja, o id no banco de dados irá permanecer vazio

                        //Checar se nós temos dados no banco de dados
                        if($count > 0) {
                            //Temos dados no banco de dados
                            //Obter os dados registrados no banco de dados e exibir
                            while($row = mysqli_fetch_assoc($resp)) {

                                $id = $row['id'];
                                $title = $row['titulo'];
                                $image_name = $row['nome_imagem'];
                                $featured = $row['destaque'];
                                $active = $row['ativo'];

                                ?>
                                <tr>
                                    <td><?php echo $nid++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php 
                                        
                                            //Checar se existe imagem disponivel ou não
                                            if($image_name != "") {
                                                //Mostrar a imagem disponivel
                                        ?>
                                        
                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name; ?>" width="90px" height="75px">

                                        <?php
                                            } else {
                                                //Exibir uma mensagem
                                                echo "<div class='error'>Não foi adicionada imagem</div>";
                                            }

                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Categoria</a>
                                        <a href="<?php echo SITE_URL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Deletar Categoria</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            //Não há dados no banco de dados
                            //Mostrar a mensagem dentro da tabela
                    ?>
                            <tr>
                                <td colspan="6"><div class="error">Sem Categoria registrada</div></td>
                            </tr>
                    <?php

                        }
                    ?>
                </table>

                <div class="clearfix"></div>


            </div>
        </div>
        <!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>