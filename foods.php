<?php include('pacote-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITE_URL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Pesquise aqui..." required>
                <input type="submit" name="submit" value="Pesquisar" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"> Menu</h2>


            <?php
            
                //Buscar os dados do banco de dados os pratos ativos e em destaque
                $sql2 = "SELECT * FROM tbl_comida WHERE ativo = 'yes' AND nome_imagem != '' ";

                //Executar a query
                $res2 = mysqli_query($conn, $sql2);

                //contar as linhas
                $count2 = mysqli_num_rows($res2);

                //Checar se o prato esta válido
                if($count2 > 0) {
                    //O prato está válido
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        //Prato válido
                        //Buscar os dados do prato
                         $id = $row2['id'];
                         $title = $row2['titulo'];
                         $price = $row2['preco'];
                         $description = $row2['descricao'];
                         $image_name = $row2['nome_imagem'];
            
            ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
            <?php

                        if($image_name == "") {
                            //Imagem não é válida
                            echo "<div class='error'>Imagem inválida</div>";
                        } else {
                            //Imagem é válida
            ?>
            
                            <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo 'Ilustração de ' . $title; ?>" class="img-responsive img-curve">

            <?php
                        }

            ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">R$  <?php echo '' . $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITE_URL; ?>order.php?id_prato=<?php echo $id;?>" class="btn btn-primary">Realizar Pedido </a>
                            </div>
                        </div>

            <?php

                    }
                } else {
                    //Prato inválido
                    echo "<div class='error'>Prato inválido</div>";
                }
            
            ?>


            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('pacote-front/footer.php'); ?>