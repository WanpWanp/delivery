<?php include('pacote-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php 
            $search = $_POST['search'];
            if($search == "") {
                $search = "Pesquisa Vazia!";
            } else {
                $search = $search;
            }
        ?>
            <h2>Alimentos em sua pesquisa <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center"> Menu</h2>

            <?php 
                //Buscar as palavras chaves da pesquisa
                $search = $_POST['search'];

                //Sql para buscar os pratos bases inserida na palavra chave
                $sql = "SELECT * FROM tbl_comida WHERE titulo like '%$search%' OR Descricao like '%$search%'";

                //Executar a query
                $res = mysqli_query($conn, $sql);

                //Contar as linhas 
                $count = mysqli_num_rows($res);

                //Checar se o prato está válido ou não
                if($count > 0) {
                    //Prato válido
                    while($row = mysqli_fetch_assoc($res)) {
                        //Buscar os detalhes
                        $id = $row['id'];
                        $title = $row['titulo'];
                        $price = $row['preco'];
                        $description = $row['descricao'];
                        $image_name = $row['nome_imagem'];
            ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">

            <?php
                //Checar se a imagem é válida ou não
                if($image_name == '') {
                    //Imagem não válida
                    echo "<div class='error'>Imagem não válida</div>";
                } else {
                    //Imagem válida
            ?>
                <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name;?>" alt=" <?php echo'Ilustração de ' . $title;?>" class="img-responsive img-curve">
            <?php
                }
            ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">R$ <?php echo '' . $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITE_URL; ?>order.php" class="btn btn-primary">Realizar Pedido </a>
                    </div>
                </div>

            <?php
                    }
                } else {
                    //Prato não válido
                    echo "<div class='error'> Prato não encontrado.</div>";
                }

            ?>

            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('pacote-front/footer.php'); ?>