<?PHP
    $sql = "SELECT id, nome_usuario, senha FROM tbl_admin Where nome_usuario = '$username'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
        
        if($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                //Usando o wilhe para buscar todos os dados dentro do banco
                //E o wilhe irá rodar enquanto tiver dados dentro do banco

                //Busca individual de dados
                $id = $row['id'];
                $username = $row['nome_usuario'];
                $current_password = md5($row['senha']);
            
            /*//Adquirir todos os dados
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $username = $row['nome_usuario'];*/
?> 
                    <div id='header_saudacao'>
                        <h5>Seja bem vindo, $username, $id | <a href='logout.php'> Sair </a> </h5>
                    </div>
                    <div id='novo-admin'>
                        <h5> <a href='add-admin.php'>Criar novo admin </a> </h5>
                    </div>
<?php
                }
            }
        

?>