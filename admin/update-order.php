<?php include('./pacotes/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Atualizar Pedido </h1>

            <br><br>

            <?php
                //checar se o id estar ou não setado
                if (isset($_GET['id'])) {
                    //Pegar o id e outros detalhes
                    //echo "Adiquirindo os dados";
                    $id = $_GET['id'];
                    //Query sql para adquirir todos os detalhes
                    $sql2 = "SELECT * FROM tbl_pedido WHERE id = $id";

                    //Executar a query acima
                    $resp2 = mysqli_query($conn, $sql2);

                    //Buscar os valores com base na consulta
                    $row2 = mysqli_fetch_assoc($resp2);

                    //Buscar os valores individuais do prato selecionado
                    $id = $row2['id'];
                    $food = $row2['prato'];
                    $price = $row2['preco'];
                    $qtd = $row2['qtd'];
                    $total = $row2['total'];
                    $order_date = $row2['data_pedido'];
                    $status = $row2['atual_status'];
                    $custumer_name = $row2['nome_cliente'];
                    $custumer_contact = $row2['contato_cliente'];
                    $custumer_email = $row2['email_cliente'];
                    $custumer_address = $row2['endereco_cliente'];
                } else {
                    //Redirecionar para a página categoria
                    header('location:' . SITE_URL . 'admin/manage-order.php');
                    die();
                }

            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <Tr>
                        <td>Nome Prato</td>
                        <td><?php echo $food; ?></td>
                    </Tr>
                    <Tr>
                        <td>Quantity</td>
                        <td><?php echo $qtd; ?></td>
                    </Tr>

                    <Tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if($status=="Encomendado"){echo "selected";} ?> value="Encomendado">Encomendado</option>
                                <option <?php if($status=="Em entrega"){echo "selected";} ?> value="Em entrega">Em entrega</option>
                                <option <?php if($status=="Entregue"){echo "selected";} ?> value="Entregue">Entregue</option>
                                <option <?php if($status=="Cancelado"){echo "selected";} ?> value="Cancelado">Cancelado</option>
                            </select>
                        </td>
                        <!--<td>
                            <select name="status" id="status">
                                <option class="text-center" value="Ordered">Encomendado</option>
                                <option class="text-center" value="On Delivery">Em entrega</option>
                                <option class="text-center" value="Delivered">Entregue</option>
                                <option class="text-center" value="Cancelled">Cancelado</option>
                            </select>
                        </td>-->
                    </Tr>
                    <tr>
                        <td clospan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                    </tr>

                    <Tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Atualizar Pedido" class="btn-secondary">
                        </td>
                        <td></td>
                    </Tr>
                </table>
                
            </form>

            <?php

                //Checando se o botão foi clicado
                if (isset($_POST['submit'])) {
                    // Se o botão foi clicado
                    //echo "Botão clicado";

                    //Buscar os dados do formulário para atualizar
                    $id = $_POST['id'];
                    //$price = $_POST['price'];
                    //$qty = $_POST['qty'];

                    //$total = $price * $qty;

                    $status = $_POST['status'];


                    //Criando a query que faz a atualiação do prato no banco de dados
                    $sql3 = "UPDATE tbl_pedido SET 
                    atual_status = '$status'
                    WHERE id = $id
                    ";

                    //Executar a query
                    $res3 = mysqli_query($conn, $sql3);

                    //Checar se a query foi ou não executada
                    if ($res3 == true) {
                        //Executada, categoria executada
                        $_SESSION['update-food'] = "<div class='success'>Pedido Atualizado com Sucesso</div>";

                        //redirecionando para a página de gerenciamento do pedido
                        header('location:' . SITE_URL. '/admin/manage-order.php');
                        die();
                    } else {
                        //Não executada
                        $_SESSION['update-food'] = "<div class='error'>Falha na atualização do pedido</div>";

                        //redirecionando para a página de gerenciamento do prato
                        header('location:' . SITE_URL. 'admin/manage-order.php');
                        die();
                    }
                } else {
                    //Se o botão não foi clicado
                    //echo "Não foi clicado";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </div>
    <!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>