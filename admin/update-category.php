<?php include('./pacotes/menu.php'); ?>

    <!--Inicio Seção content-main-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Atualizar Categoria </h1>

            <br><br>


            <?php 
            
                //checar se o id estar ou não setado
                if(isset($_GET['id'])) {
                    //Pegar o id e outros detalhes
                    //echo "Adiquirindo os dados";
                    $id = $_GET['id'];
                    //Query sql para adquirir todos os detalhes
                    $sql = "SELECT id, titulo, nome_imagem, destaque, ativo FROM tbl_categoria WHERE id = $id";

                    //Executar a query acima
                    $res = mysqli_query($conn, $sql);

                    //Contar as linhas e checar se o id é válido ou não
                    $count = mysqli_num_rows($res);

                    if($count == 1) {
                        //Adquirir todos os dados
                        $row = mysqli_fetch_assoc($res);
                        $id = $row['id'];
                        $title = $row['titulo'];
                        $current_image = $row['nome_imagem'];
                        $featured = $row['destaque'];
                        $active = $row['ativo'];

                    } else {
                        //Redirecionar para a página de categoria com mensagem
                        $_SESSION['no-category-found'] = "<div class='error'>Categoria não encontrada</div>";
                        header('location:' . SITE_URL . 'admin/manage-category.php');
                    }

                } else {
                    //Redirecionar para a página categoria
                    header('location:' . SITE_URL . 'admin/manage-category.php');
                }
            
            ?>

            <h3>Categoria: <?php  echo $title;?></h3>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class=" tbl-30 add_anything">
                    <tr>
                        <td>Título:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Imagem Atual:</td>
                        <td>
                        <?php
                            if($current_image != "") {
                        ?>
                            <img src="<?php echo SITE_URL; ?>images/category/<?php echo $current_image; ?>" width="150px;" height="100px" alt="Imagem da Categoria">
                    
                        <?php
                            } else {
                                echo "<div class='error'>Não há imagem para esta categoria</div>";
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nova Imagem:</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Destaque:</td>
                        <td>
                            <input <?php if($featured == "yes") {echo "checked";} ?> type="radio" name="featured" value="yes">Sim

                            <input <?php if($featured == "no" || $featured == "") {echo "checked";} ?> type="radio" name="featured" value="no" >Não
                        </td>
                    </tr>
                    <tr>
                        <td>Ativo:</td>
                        <td class="resp">
                            <input <?php if($active == "yes") {echo "checked";} ?> type="radio" name="active" value="yes">Sim

                            <input <?php if($active == "no" || $active == "") {echo "checked";} ?> type="radio" name="active" value="no" >Não
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Atualizar Categoria" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
            <div class="clearfix"></div>
        </div>
    </div>
    <!--Fim Seção content-main-->

    <?php 
    
        //Checando se o botão foi clicado
        if(isset($_POST['submit'])) {
            // Se o botão foi clicado
            //echo "Botão clicado";

            //Buscar os dados do formulário para atualizar
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //Atulizando a imagem na categoria
            //Checar se a imagem esta selecionada ou não
            //print_r($_FILES['image']);
            //die();
            if(isset($_FILES['image']['name'])) {
                //Adquirir detalhes da imagem
                $image_name = $_FILES['image']['name'];

                //checar se a imagem é válida ou não
                if($image_name != "") {
                    //Imagem válida
                    //Secção A - Atulizar a imagem para a nova imagem
                    //Auto renomear a imagem
                    //Pegar a extensão da imagem a ser carregada (jpg, png e gif) ex: prato1.png
                    $ext = end(explode('.', $image_name));
                    //Renomear a imagem 
                    $image_name = "Prato_Categoria_atualizado_" . rand(000,999) . "." . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    //Agora é carregar a imagem
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //Checar se a imagem foi carregada ou não
                    //Se a imagem não foi carregada temos que parar o processo e redirecionar a mensagem de erro
                    if($upload != true) {

                        //Setando a mensagem
                        $_SESSION['upload-image'] = "<div class='error'>Falha no carregamento da imagem </div>";

                        //Redirecionando para a página de adicionar categoria
                        header ('location: ' . SITE_URL . 'admin/manage-category.php');
                        
                    }
                    //Secção B - Remover a imagem anterior
                    if($current_image != "") {
                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);

                        //Checar se a imagem foi removida ou não 
                        //Se teve falha ao tentar remover a imagem mostra mensagem e parar o processo
                        if($remove == false) {
                            //Falha ao tentar remover a imagem
                            $_SESSION['failed-remove'] = "<div class='error'>Falha ao tentar remover a imagem</div>";
                            header('location:' . SITE_URL . 'admin/manage-category.php');
                            
                        }
                    }
                } else {
                    $image_name = $current_image;
                }

            } else {
                $image_name = $current_image;
            }


            //Criando a query que faz a atualiação da categoria no banco de dados
            $sql2 = "UPDATE tbl_categoria SET 
            titulo = '$title',
            nome_imagem = '$image_name',
            destaque = '$featured',
            ativo = '$active'
            WHERE id = $id
            ";

            //Executar a query
             $res2 = mysqli_query($conn, $sql2);

            //Checar se a query foi ou não executada
            if($res2 == true) {
                //Executada, categoria executada
                $_SESSION['update-category'] = "<div class='success'>Categoria Atualizado com Sucesso</div>";
                 
                //redirecionando para a página de gerenciamento de categoria
                header('location:' . SITE_URL . 'admin/manage-category.php');

            } else {
                //Não executada
                $_SESSION['update-category'] = "<div class='error'>Falha na atualização da Categoria</div>";

                //redirecionando para a página de gerenciamento de categoria
                header('location:' . SITE_URL . 'admin/manage-category.php');
            }
            
        } else {
            //Se o botão não foi clicado
            //echo "Não foi clicado";
        }

    ?>

<?php include('./pacotes/footer.php'); ?>