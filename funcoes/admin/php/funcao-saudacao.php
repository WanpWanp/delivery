<?php include('../funcoes/admin/php/funcao-login.php'); ?>
<?php
    //Query para mostrar tods admin
    $sql = "SELECT id, nome_completo, nome_usuario, senha FROM tbl_admin";
    //Execção da Query
    $res = mysqli_query($conn, $sql);
    //Checar se a query foi executada ou nao
    if ($res == true) {
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $username = $row['nome_usuario'];

        }
?>