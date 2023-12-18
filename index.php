<?php include('pacote-front/menu.php'); ?>

<!-- Food search Starts here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITE_URL; ?>food-search.php" method="post" enctype="multipart/form">
                <input type="search" name="search" placeholder="Pesquise aqui...">
                <input type="submit" name="submit" value="Pesquisar" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Food search Ends here-->

    <?php 
    
        if(isset($_SESSION["order"])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- Categories Starts here-->
    <section class="categories">
        <div class="container ">
            <h2 class="text-center">Explore</h2>

            <?php 
            
                //Criando a query sql que irá mostrar as categorias dentro do banco de dados
                $sql = "SELECT id, titulo, nome_imagem FROM tbl_categoria WHERE ativo = 'yes' AND destaque = 'yes' AND nome_imagem != '' Limit 6";
                $res = mysqli_query($conn, $sql);

                //Checar se há catgorias dentro do banco de dados válida ou não
                $count = mysqli_num_rows($res);

                if($count > 0) {
                    //Categorias válidas
                    while($row = mysqli_fetch_assoc($res)) {
                        //Buscar os valores como titulo, nome_imagem, id
                        $id = $row['id'];
                        $title = $row['titulo'];
                        $image_name = $row['nome_imagem'];

                        ?>

                        <a href="<?php echo SITE_URL;?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box float-container">
                                <?php 
                                
                                    //Checar se a imagem é válida
                                    if($image_name == "") {
                                        //Imagem inválida
                                        echo "<div class='error'>Imagem inválida</div>";
                                    } else {
                                        //Image Válida
                                        ?>

                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                
                                ?>
                                
                                <h3 class="float-text text-shadow-black"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php 
                    }

                } else {
                    //Não válidas
                    echo "<div class='error'>Não há categorias cadastradas</div>";
                }


            ?>

            <div class="clearfix"></div>

        </div>
    </section>
    <!-- Categories Ends here-->

    <!-- Food-menu Starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"> Menu</h2>

            <?php
            
                //Buscar os dados do banco de dados os pratos ativos e em destaque
                $sql2 = "SELECT * FROM tbl_comida WHERE ativo = 'yes' AND destaque = 'yes' AND nome_imagem != '' LIMIT 6";

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
                                <p class="food-price">R$ <?php echo $price; ?></p>
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
    
    <?php include('pacote-front/footer.php'); ?>