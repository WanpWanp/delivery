<?php include('./pacotes/menu_saudacao.php');?>
        
        <!--Inicio Seção content-main-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Painel de Controle</h1>

                <br><br>
            <?php 
        
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        
            ?>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql = "SELECT * FROM tbl_categoria";
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    <?php if($count == 1) {echo "Categoria";} else {echo "Categorias";}?>

                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql2 = "SELECT * FROM tbl_comida";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    <?php if($count2 == 1) {echo "Prato";} else {echo "Pratos";}?>

                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Sql Query 
                        $sql3 = "SELECT * FROM tbl_pedido";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br>
                    <?php if($count3 == 1) {echo "Pedido";} else {echo "Pedidos";}?>

                </div>

                <div class="col-4 text-center">

                    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_pedido WHERE atual_status='Encomendado'";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);
                        
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1><?php echo "R$ " . number_format($total_revenue, 2, ',', '.'); ?></h1>
                    <br />
                    Total Receita

                </div>

                <div class="clearfix"></div>


            </div>
        </div>
        <!--Fim Seção content-main-->

<?php include('./pacotes/footer.php');?>