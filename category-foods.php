<?php include('pacote-front/menu.php'); ?>

        <?php 
            if(isset($_GET['category_id'])) {
                // Catgeoria esta válida, buscar o id
                $category_id = $_GET['category_id'];
                // Buscando o titulo da categoria
                $sql = "SELECT * FROM tbl_categoria WHERE id = $category_id";

                $res = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($res);

                $category_title = $row['titulo'];
                
                
            } else {
                //Categoria não existe
                //Redirecionar para home
                echo '<div class="error">Não existe essa categoria</div>';

                header('Location: ' . SITE_URL);
            }

        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Alimentos em <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_comida WHERE categoria_id = $category_id";
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0) {
                    //Prato válido
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['titulo'];
                        $price = $row2['preco'];
                        $description = $row2['descricao'];
                        $image_name = $row2['nome_imagem'];

            ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
            <?php
                        if($image_name == '') {
                            //Imagem não válida
                            echo "<div class='error'>Imagem inválida.</div>";
                        } else {
                            //Imagem válida
            ?>
                            <img src="<?php echo SITE_URL ?>images/food/<?php echo $image_name; ?>" alt=" <?php echo 'Ilustração de ' . $title; ?>" class="img-responsive img-curve">
            <?php
                        }
            ?>
    
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">R$ <?php echo ' ' . $price; ?></p>
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
                    //Prato não válido
                    echo "<div class='error'> Não existe prato </div>";
                }
            ?>
            
            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('pacote-front/footer.php'); ?>