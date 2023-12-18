<?php include('pacote-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore</h2>

            <?php 
            
                //Exibir todas as categorias que estão ativas
                //Sql query

                $sql = "SELECT * FROM tbl_categoria WHERE ativo = 'yes' AND nome_imagem != ''";

                //Executano a query 
                $res = mysqli_query($conn, $sql);

                //Contar as linhas
                $count = mysqli_num_rows($res);

                //Checar se as categorias estão válidas
                if($count > 0) {
                    //Categoria válida
                    while($row = mysqli_fetch_assoc($res)) {
                        //Buscar os valores como titulo, nome_imagem, id
                        $id = $row['id'];
                        $title = $row['titulo'];
                        $image_name = $row['nome_imagem'];

                        ?>

                        <a href="category-foods.php">
                            <div class="box float-container">
                                <?php 
                                
                                    //Checar se a imagem é válida
                                    if($image_name == "") {
                                        //Imagem inválida
                                        echo "<div class='error'>Imagem inválida</div>";
                                    } else {
                                        //Image Válida
                                        ?>

                                        <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name;?>" alt="Imagem de <?php echo $title; ?>" class="img-responsive img-curve">

                                        <?php
                                    }
                                
                                ?>
                                
                                <h3 class="float-text text-shadow-black"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php 
                    }

                } else {
                    //Categoria não válida
                    echo "<div class='error'>Não há categorias cadastradas</div>";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('pacote-front/footer.php'); ?>