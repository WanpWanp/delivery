<?php include('./pacotes/menu.php'); ?>

<!--Inicio Seção content-main-->
<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar novo Prato </h1>

        <br>

        <?php
            if (isset($_SESSION['upload-food'])) {
                echo $_SESSION['upload-food'];
                unset($_SESSION['upload-food']); //remove mensagem da seção
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class=" tbl-30 add_anything">
                <tr>
                    <td>Nome Prato:</td>
                    <td><input type="text" name="title" placeholder="Digite nome do prato"></td>
                </tr>
                <tr>
                    <td>Descricao Prato:</td>
                    <td> 
                        <textarea name="description" id="" cols="68" rows="3"  maxlength="138" placeholder="Descrição do prato"></textarea> 
                    </td>
                </tr>
                <tr>
                    <td>Preço:</td>
                    <td><input type="number" step="0.01" name="price" min="0.01"placeholder="Digite o preço"></td>
                </tr>
                <tr>
                    <td>Imagem do Prato:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Categoria do Prato:</td>
                    <td>
                        <select name="category">

                        <?php
                            //Criando o código que irá mostrar as categorias do banco de dados
                            //Sql que ié buscar todas as categorias ativas do banco de dados

                            $sql = "SELECT id, titulo FROM tbl_categoria WHERE ativo='yes'";

                            //Execução da query
                            $resp = mysqli_query($conn, $sql);

                            //Contar linhas para verificar se temos categorias ou não
                            $count = mysqli_num_rows($resp);
                            //Se a contagem for maior que zero temos categorias, caso o contrário não temos
                            if ($count>0) {
                                //Há categorias
                                while($row=mysqli_fetch_assoc($resp)) {
                                    //Buscar os detalhes de categorias do banco de dados
                                    $id = $row['id'];
                                    $title = $row['titulo'];

                                    ?>

                                        <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>

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
                        <input type="radio" name="featured" value="yes"> Sim
                        <input type="radio" name="featured" value="no"> Não
                    </td>
                </tr>
                <tr>
                    <td>Ativo:</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Sim
                        <input type="radio" name="active" value="no"> Não
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Prato" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <div class="clearfix"></div>

        <?php 
        
            //Chedcar se o batão está clicado
            if(isset($_POST['submit'])) {
                //Add o prato no banco de dados
                //echo "Botão clicado";

                //Buscar os dados do formulario
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Checar se o botão radio esta selecionado ou não, tanto para o destaque quanto para o ativo
                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "no"; //Definindo o valor padrao para o radio
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "no"; //Definindo o valor padrao para o radio
                }


                //Realizar o upload da imagem caso ela esteja selecionada
                //Checar se a imagem foi selecionada ou não e atulizar somente se a imagem estiver selecionada
                if(isset($_FILES['image']['name'])) {
                    //Bucar os detalhes da imagem selecionada
                    $image_name = $_FILES['image']['name'];

                    //Checar se a imagem está selecionada ou não
                    if ($image_name != "") {
                        //image está selecionada
                        //Renomear a imagem
                        //Obter a extensao da imagem selecionada (jpg, pnh, gif)
                        $ext = end(explode('.', $image_name));

                        //Criando um novo nome para a imagem.
                        $image_name = "Nome_prato_" . rand(0000,9999) . "." . $ext;

                       //Atualizar a imagem
                       //Buscar o caminho inicial e depois definir o destino para a imagem

                       //Localização inicial da imagem
                       $src = $_FILES['image']['tmp_name'];

                       //Destino da imagem
                       $dst = "../images/food/" . $image_name;

                       //Finalização de aualização da imagem do prato
                       $upload = move_uploaded_file($src, $dst);

                       //Checar se a imagem foi carregada ou não
                       if($upload == false) {
                           //Falha na atuaização da imagem
                           //Redireciando para de add com mensagem de erro
                           //Interrompendo o processo.
                           $_SESSION["upload-food"] = "<div class = 'error'>Falha ao atualizar imagem</div>";
                           header ('location: ' . SITE_URL . 'admin/add-food.php');
                           die();
                       }
                    }
                } else {
                    $image_name = ""; //Definindo o valor padrao para o nome da imagem 
                }

                //Inserir os dados no banco de dados

                //Criando a query para salvar os dados no Banco
                //Para um valor numero não usamos as aspas simples.  Basta colocar o valor assim como esta em preço e em categoria_id. No banco estes estão como numericos
                $sql2 = "INSERT INTO tbl_comida SET 
                    titulo = '$title',
                    descricao = '$description',
                    preco = $price,
                    nome_imagem = '$image_name',
                    categoria_id = $category,
                    destaque = '$featured',
                    ativo = '$active'
                ";

                //Executar a query
                $resp2 = mysqli_query($conn, $sql2);

                //Checar se os dados foram inseridos ou não
                if($resp2  == true) {
                    //Dados inseridos com Sucesso
                    $_SESSION['add-food'] = "<div class='success'>Prato adicionado com sucesso</div>";
                    header('location: ' . SITE_URL . 'admin/manage-food.php');
                } else {
                    //Falha ao adicionar os dados
                    $_SESSION['add-food'] = "<div class='error'>Prato não foi adicionado</div>";

                    //Redirecionando mensagem para a página de prato
                    header('location: ' . SITE_URL . 'admin/manage-food.php');

                }

            }

        ?>

    </div>
</div>
<!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>