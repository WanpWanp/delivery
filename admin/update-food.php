<?php include('./pacotes/menu.php'); ?>
<?php

//checar se o id estar ou não setado
if (isset($_GET['id'])) {
    //Pegar o id e outros detalhes
    //echo "Adiquirindo os dados";
    $id = $_GET['id'];
    //Query sql para adquirir todos os detalhes
    $sql2 = "SELECT * FROM tbl_comida WHERE id = $id";

    //Executar a query acima
    $resp2 = mysqli_query($conn, $sql2);

    //Buscar os valores com base na consulta
    $row2 = mysqli_fetch_assoc($resp2);

    //Buscar os valores individuais do prato selecionado
    $title = $row2['titulo'];
    $id = $row2['id'];
    $description = $row2['descricao'];
    $price = $row2['preco'];
    $current_image = $row2['nome_imagem'];
    $current_category = $row2['categoria_id'];
    $featured = $row2['destaque'];
    $active = $row2['ativo'];
} else {
    //Redirecionar para a página categoria
    header('location:' . SITE_URL . 'admin/manage-food.php');
}

?>

<!--Inicio Seção content-main-->
<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Prato </h1>

        <br><br>


        <h3>Categoria: <?php echo $title; ?></h3>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class=" tbl-30 add_anything">
                <tr>
                    <td>Nome Prato:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Descrição:</td>
                    <td><textarea name="description" cols="68" rows="3"
                            maxlength="138"> <?php echo $description; ?> </textarea></td>
                </tr>
                <tr>
                    <td>Preço:</td>
                    <td><input type="number" step="0.01" name="price" min="0.01" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Imagem Atual do Prato:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                        <img src="<?php echo SITE_URL; ?>images/food/<?php echo $current_image; ?>" width="150px;"
                            height="100px" alt="Imagem do Prato">

                        <?php
                        } else {
                            echo "<div class='error'>Não há imagem para este prato</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Nova Imagem do Prato:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Categoria do Prato:</td>
                    <td>
                        <select name="category">

                            <?php
                            //Criando o código que irá mostrar as categorias do banco de dados
                            //Sql que ié buscar todas as categorias ativas do banco de dados

                            $sql = "SELECT id, titulo FROM tbl_categoria WHERE ativo ='yes'";

                            //Execução da query
                            $resp = mysqli_query($conn, $sql);

                            //Contar linhas para verificar se temos categorias ou não
                            $count = mysqli_num_rows($resp);
                            //Se a contagem for maior que zero temos categorias, caso o contrário não temos
                            if ($count > 0) {
                                //Há categorias
                                while ($row = mysqli_fetch_assoc($resp)) {
                                    //Buscar os detalhes de categorias do banco de dados
                                    $category_title = $row['titulo'];
                                    $category_id = $row['id'];
                            ?>

                            <option <?php
                                            if ($current_category == $category_id) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?>
                            </option>

                            <?php

                                }
                            } else {
                                //Não há categorias
                                ?>
                            <option value="0">Categorias não econtradas</option>
                            <?php


                            }
                            //Exibir no menu suspenso
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Destaque:</td>
                    <td>
                        <input <?php if ($featured == "yes") {echo "checked"; } ?> type="radio" name="featured" value="yes">Sim

                        <input <?php if ($featured == "no" || $featured == "") {echo "checked"; } ?> type="radio" name="featured" value="no">Não
                    </td>
                </tr>
                <tr>
                    <td>Ativo:</td>
                    <td class="resp">
                        <input <?php if ($active == "yes") {echo "checked"; } ?> type="radio" name="active" value="yes">Sim

                        <input <?php if ($active == "no" || $active == "") {echo "checked"; }?> type="radio" name="active" value="no">Não
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Atualizar Prato" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        //Checando se o botão foi clicado
        if (isset($_POST['submit'])) {
            // Se o botão foi clicado
            //echo "Botão clicado";

            //Buscar os dados do formulário para atualizar
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //Atulizando a imagem do prato
            //Checar se a imagem esta selecionada ou não
            //print_r($_FILES['image']);

            if (isset($_FILES['image']['name'])) {
                //Adquirir detalhes da imagem
                $image_name = $_FILES['image']['name'];

                //checar se a imagem é válida ou não
                if ($image_name != "") {
                    //Imagem válida
                    //SeAtulizar a imagem para a nova imagem
                    //Auto renomear a imagem
                    //Pegar a extensão da imagem a ser carregada (jpg, png e gif) ex: prato1.png
                    $ext = end(explode('.', $image_name));
                    //Renomear a imagem 
                    $image_name = "Nome_Prato_atualizado_" . rand(0000, 9999) . "." . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    //Agora é carregar a imagem
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Checar se a imagem foi carregada ou não
                    //Se a imagem não foi carregada temos que parar o processo e redirecionar a mensagem de erro
                    if ($upload == false) {

                        //Setando a mensagem
                        $_SESSION['upload-image'] = "<div class='error'>Falha no carregamento da imagem </div>";

                        //Redirecionando para a página de adicionar prato
                        header('location: ' . SITE_URL . 'admin/manage-food.php');
    
                    }
                    //SeRemover a imagem anterior
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //Checar se a imagem foi removida ou não 
                        //Se teve falha ao tentar remover a imagem mostra mensagem e parar o processo
                        if ($remove == false) {
                            //Falha ao tentar remover a imagem
                            $_SESSION['failed-remove-food'] = "<div class='error'>Falha ao tentar remover a imagem</div>";
                            header('location:' . SITE_URL . 'admin/manage-food.php');
        
                        }
                    }
                } else {
                    $image_name = $current_image; // Imagem padrão para quando a imagem não foi selecionada
                }
            } else {
                $image_name = $current_image; // Imagem padrão para quando o botão não é clicado
            }


            //Criando a query que faz a atualiação do prato no banco de dados
            $sql3 = "UPDATE tbl_comida SET 
            titulo = '$title',
            descricao = '$description',
            preco = $price,
            nome_imagem = '$image_name',
            categoria_id = '$category',
            destaque = '$featured',
            ativo = '$active'
            WHERE id=$id
            ";

            //Executar a query
            $res3 = mysqli_query($conn, $sql3);

            //Checar se a query foi ou não executada
            if ($res3==true) {
                //Executada, categoria executada
                $_SESSION['update-food'] = "<div class='success'>Prato Atualizado com Sucesso</div>";

                //redirecionando para a página de gerenciamento do prato
                //header('location:' . SITE_URL . '/admin/manage-food.php');
                echo "<script>
                        window.location.href='http://localhost/cursos_geral/delivery/admin/manage-food.php'
                      </script>";
            } else {
                //Não executada
                $_SESSION['update-food'] = "<div class='error'>Falha na atualização do Prato</div>";

                //redirecionando para a página de gerenciamento do prato
                //header('location:' . SITE_URL . 'admin/manage-food.php');
                echo "<script>
                        window.location.href='http://localhost/cursos_geral/delivery/admin/manage-food.php'
                      </script>";
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