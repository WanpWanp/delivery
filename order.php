<?php include('pacote-front/menu.php'); ?>

<?php

    //Checar se o id do prato está setado ou não
    if (isset($_GET['id_prato'])) {
        //Buscar o id do prato  eos detalhes do prato selecionado
        $id_food = $_GET['id_prato'];

        //Buscar os detalhes do prato
        $sql = "SELECT * FROM tbl_comida where  id = $id_food; ";

        //Executar a query 
        $res = mysqli_query($conn, $sql);

        //Contar as linhas do formulario
        $count = mysqli_num_rows($res);

        //Checar se os datos estão válidos ou não
        if ($count==1) {
            //há dados 
            //Buscar os dados no banco de dados
            $row = mysqli_fetch_assoc($res);

            $title = $row['titulo'];
            $price = $row['preco'];
            $image_name = $row['nome_imagem'];
        } else {
            //não há dados, não válido
            //Redirtecionao para home
            header('location' . SITE_URL);
        }
    } else {
        //Redirecionar para a página home
        header('location:' .  SITE_URL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Preencha este formulário para confirmar seu pedido.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Escolha seu Prato</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //Checar se a imagem é válida ou não
                            if($image_name == "") {
                                //Imagem não válida
                                echo "<div class='error'>Sem imagem</div>";
                            } else {
                                //imagem válida 
                                ?>

                                <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name;?>" alt="Imagem de <?php echo $title; ?>" class="img-responsive img-curve">

                                <?php

                            }
                        
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>" />

                        <p class="food-price"><?php echo "R$ " . number_format($price, 2, ',', '.'); ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>" />

                        <div class="order-label">Quantidade</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Detalhesm da Entrega</legend>
                    <div class="order-label">Nome Completo</div>
                    <input type="text" name="full-name" placeholder="Willian Axl Dos Santos" class="input-responsive" required>

                    <div class="order-label">Telefone</div>
                    <input type="tel" name="contact" placeholder="(31) 99999-9999" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="william.ac7@gmail.com" class="input-responsive" required>

                    <div class="order-label">Endereço</div>
                    <textarea name="address" rows="10" placeholder="Rua Serrra do Mar" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirmar Pedido" class="btn btn-primary" />
                </fieldset>

            </form>

            <?php 
            
            //Checar se o botão foi clicado ou não.
            if(isset($_POST['submit'])) {
                //Clicked
                //Buscar os detalhes do formulário.
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                        
                $total = $price * $qty;

                $order_date = date("Y-m-d h:i:sa");

                $status ="Encomendado"; //Pedido realizado, Em entrega, Entregue, Cancelado

                $customer_name = $_POST['full-name']; //Nome do cliente
                $customer_contact= $_POST['contact']; //Contato do cliente
                $customer_email = $_POST['email']; //Email do cliente
                $customer_address = $_POST['address'];  // Endereço do cliente

                //Salvar o pedido no banco de dados 
                $sql2 = "INSERT INTO tbl_pedido SET

                    prato = '$food',
                    preco = $price,
                    qtd = $qty,
                    total = $total,
                    data_pedido = '$order_date',
                    atual_status = '$status',
                    nome_cliente = '$customer_name',
                    contato_cliente = '$customer_contact',
                    email_cliente = '$customer_email',
                    endereco_cliente = '$customer_address'
                ";

                /*echo $sql2;*/
                /*die();*/

                //Execução da query.
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

                //Checar se a query foi executada corretamente.
                if($res2==true) {
                    //Query exectutada e salva.
                    $_SESSION['order'] = "<div class='success text-center'>Pedido realizado com sucesso</div>";
                    header('location:' . SITE_URL);
                    die();
                } else {
                    //Falaha ao salvar.
                    //Redirecionar para home page
                    $_SESSION['order'] = "<div class='error text-center'>Pedido não realizado</div>";
                    header('location:' . SITE_URL);
                    die();
                }

            }

        ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('pacote-front/footer.php'); ?>

