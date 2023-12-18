<?php include('./pacotes/menu_saudacao.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
            <div class="wrapper">
                <h1>Gerenciar - Pedidos</h1>
                
                <br>

                <?php 
                    if (isset($_SESSION['update-food'])) {
                        echo $_SESSION['update-food'];
                        unset($_SESSION['update-food']); //remove mensagem da seção
                    }
                ?>

                <br><br><br>

                <table class="tbl-full-order">
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Prato</th>
                        <th>Preço</th>
                        <th>Qtd</th>
                        <th>Total</th>
                        <!--<th>Data</th>-->
                        <th>Status</th>
                        <th>Contato</th>
                        <th>Email </th>
                        <th>Endereço</th>
                        <th>Ação</th>
                    </tr>

                    <?php 
                        //buscar os dados no banco. 
                        $sql  = "SELECT * FROM tbl_pedido";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if ($count > 0) {


                            while($row = mysqli_fetch_assoc($res)) {
                                //Buscar os valores individuais das colunas
                                $id = $row['id'];
                                $food = $row['prato'];
                                $price = $row['preco'];
                                $qtd = $row['qtd'];
                                $total = $row['total'];
                                $order_date = $row['data_pedido'];
                                $status = $row['atual_status'];
                                $customer_name = $row['nome_cliente'];
                                $customer_contact = $row['contato_cliente'];
                                $customer_email = $row['email_cliente'];
                                $customer_address = $row['endereco_cliente'];
                                ?>

                                <tr>
                                    <td style="width: 6.8%;"><?php echo $sn++;?></td>
                                    <td id="customer"><?php echo $customer_name; ?></td>
                                    <td id="food"><?php echo $food;?></td>
                                    <td style="width: 8.5%;"><?php echo "R$ " . number_format($price, 2, ',', '.');?></td>
                                    <td style="width: 4.9%;"><?php echo $qtd; ?></td>
                                    <td style="width: 8.5%;"><?php echo "R$ " . number_format($total, 2, ',', '.');?></td>
                                    <!--<td style="width: 7.5%;"><?php echo $order_date; ?></td>-->
                                    <!--<td id="status"><?php echo $status; ?></td>-->
                                    <td>
                                        <?php 
                                            // Ordered, On Delivery, Delivered, Cancelled
                                            if($status=="Encomendado") {

                                                echo "<label id='status' style= 'color: #6743a5;'>$status</label>";
                                            } else if($status=="Em entrega")
                                            {
                                                echo "<label id='status' style='color: #ffb43e;'>$status</label>";
                                            } else if($status=="Entregue") {

                                                echo "<label id='status' style='color: #44e84a;'>$status</label>";
                                            } else if($status=="Cancelado") {

                                                echo "<label id='status' style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    <td id="contact"><?php echo $customer_contact; ?></td>
                                    <td id="email"><?php echo $customer_email; ?></td>
                                    <td id="address"><?php echo $customer_address; ?></td>
                                    <td class="actions">
                                        <a href="<?php echo SITE_URL; ?>admin/update-order.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/cotton/30/000000/create-new--v1.png"/></a>
                                        
                                        <!--<a href="<?php echo SITE_URL; ?>admin/delete-order.php?id=<?php echo $id; ?>"><img src="https://img.icons8.com/stickers/30/000000/filled-trash.png"/></a>-->
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