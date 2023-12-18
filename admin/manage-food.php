<?php include('./pacotes/menu_saudacao.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
            <div class="wrapper">
                <h1>Gerenciar - Pratos</h1>

                <br>

                <?php 
                    if (isset($_SESSION['add-food'])) {
                        echo $_SESSION['add-food'];
                        unset($_SESSION['add-food']); //remove mensagem da seção
                    }
                    if (isset($_SESSION['remove-food'])) {
                        echo $_SESSION['remove-food'];
                        unset($_SESSION['remove-food']);
                    }
                    if (isset($_SESSION['delete-food'])) {
                        echo $_SESSION['delete-food'];
                        unset($_SESSION['delete-food']);
                    }
                    if (isset($_SESSION['update-food'])) {
                        echo $_SESSION['update-food'];
                        unset($_SESSION['update-food']); //remove mensagem da seção
                    }
                    if (isset($_SESSION['failed-remove-food'])) {
                        echo $_SESSION['failed-remove-food'];
                        unset($_SESSION['failed-remove-food']); //remove mensagem da seção
                    }
                    if (isset($_SESSION['no-food-found'])) {
                        echo $_SESSION['no-food-found'];
                        unset($_SESSION['no-food-found']); //remove mensagem da seção
                    }

                ?>

                <br><br>

                <!-- Btn para adicionar Prato -->
                <a href="<?php echo SITE_URL; ?>admin/add-food-2.php" class="btn-primary">Add Prato</a>


                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>Código</th>
                        <th>Nome Prato</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Imagem</th>
                        <th>Destaque</th>
                        <th>Ativo</th>
                        <th>Ação</th>
                    </tr>

                    <?php 
                    
                        //Criando a query para buscar todos os pratos
                        $sql = "SELECT id, titulo, descricao, preco, nome_imagem, categoria_id, destaque, ativo FROM tbl_comida";
                        
                        //Execução da query
                        $resp = mysqli_query($conn, $sql);

                        //Contagem das linhas para checar se há pratos cadastrados
                        $count = mysqli_num_rows($resp);

                        //Criando um valor padrão para ser exibido no código e definindo padrão como 1
                        $sn = 1;

                        if($count > 0) {
                            //Há pratos cadastrados no banco de dados
                            //Buscar os pratos no banco de dados e exibir
                            while($row = mysqli_fetch_assoc($resp)) {
                                //Buscar os valores individuais das colunas
                                $id = $row['id'];
                                $title = $row['titulo'];
                                $description = $row['descricao'];
                                $price = $row['preco'];
                                $image_name = $row['nome_imagem'];
                                $featured = $row['destaque'];
                                $active = $row['ativo'];
                                ?>

                                <tr>
                                    <td style="width: 7.5%;"><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td class="description"><?php echo $description;?></td>
                                    <td><?php echo "R$ " . number_format($price, 2, ',', '.');?></td>
                                    <td class="image">
                                        <?php 
                                            
                                            //Checar se existe imagem disponivel ou não
                                            if($image_name != "") {
                                                //Mostrar a imagem disponivel
                                        ?>
                                        
                                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" width="90px" height="75px">

                                        <?php
                                            } else {
                                                //Exibir uma mensagem
                                                echo "<div class='error'>Não foi adicionada imagem</div>";
                                            }

                                        ?>
                                    </td>
                                    <td class="radio"><?php echo $featured; ?></td>
                                    <td class="radio"><?php echo $active; ?></td>
                                    <td class="actions">
                                        <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/cotton/30/000000/create-new--v1.png"/></a>
                                        
                                        <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"><img src="https://img.icons8.com/stickers/30/000000/filled-trash.png"/></a>
                                    </td>
                                </tr>

                                <?php
                            }

                        } else {
                            //Não há pratos cadastrados no banco de dados
                            echo "
                                <tr>
                                    <td colspan='7' class='error'>
                                        Prato não adicionado
                                    </td>
                                </tr>
                                ";
                        }



                    
                    ?>

                </table>

                <div class="clearfix"></div>


            </div>
        </div>
        <!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>