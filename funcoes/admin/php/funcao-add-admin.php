<?php
//Processar o Valor do Formulário e Salvá-lo no Banco de Dados
//Checar se o botão foi clicado ou não
if (isset($_POST['submit'])) {
    //botão clicado
    //echo "Botão Clicado.";
    //Obtendo os dados do formulário
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5(): metodo de criptografia de senha, não pode ser quebrada
    //Testando se o nome de usuario já existe ou se está inválido
    $sql = "SELECT nome_usuario FROM tbl_admin WHERE nome_usuario ='$username'";
    $resp = mysqli_query($conn, $sql);
    $array = mysqli_fetch_assoc($resp);
    $logarray = $array['nome_usuario'];
    //echo $full_name . "<br>" . $username . "<br>" . $password . "<br>";]
    if ($username == " " || $username == null) {
        $_SESSION['user-one'] = "<div class='error'> Usuário Inválido. </div>";
        //Redirecionado para página manage admin
        header("location: " . SITE_URL . 'admin/manage-admin.php');
    }
    else if ($logarray == $username) {
        $_SESSION['user-one'] = "<div class='error'> Usuário já Existe. </div>";
        //Redirecionado para página manage admin
        header("location: " . SITE_URL . 'admin/manage-admin.php');
    } 
    else {
        //Consulta SQL para salvar os dados no Banco
        $sql = "INSERT INTO tbl_admin SET
            nome_completo = '$full_name',
            nome_usuario = '$username',
            senha = '$password'
        ";
        //echo $sql;
        //Executar a query e salvar no BD
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //Checar se os dados (query executada), estão inseridos ou não, e mostra a mensagem apropriada
            if ($res == true) {
                //Dados inseridos 
                //echo "Dados inseridos";
                //Criando variavel para mostrar mensagem
                $_SESSION['add'] = "<div class='success'>Admin adicionado com sucesso</div>";
                //Redirecionado para página manage admin
                header("location: " . SITE_URL . 'admin/manage-admin.php');
            } 
            else {
                //Falaha na inserçaõ
                //echo "Falaha na inserção";
                //Criando variavel para mostrar mensagem
                $_SESSION['add'] = "<div class='error'>Admin não foi adicionado</div>";
                //Redirecionado para página add admin
                header("location: " . SITE_URL . 'admin/add-admin.php');
            }
    }
}
?>