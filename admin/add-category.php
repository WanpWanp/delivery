<?php include('./pacotes/menu.php'); ?>

<!--Inicio Seção content-main-->
<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar nova Categoria </h1>

        <br><br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //remove mensagem da seção
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); //remove mensagem da seção
        }
        ?>

        <br><br>

        <?php /*Inicio formulário de categória*/ ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class=" tbl-30 add_anything">
                <tr>
                    <td>Título:</td>
                    <td><input type="text" name="title" placeholder="Título da Categoria"></td>
                </tr>
                <tr>
                    <td>Selecione Imagem:</td>
                    <td><input type="file" name="image" id="image"></td>
                </tr>
                <tr>
                    <td>Destaque:</td>
                    <td class="resp">
                        <input type="radio" name="featured" value="yes" >Sim
                        <input type="radio" name="featured" value="no"  >Não
                    </td>
                </tr>
                <tr>
                    <td>Ativo:</td>
                    <td class="resp">
                        <input type="radio" name="active" value="yes" >Sim
                        <input type="radio" name="active" value="no"  >Não
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Categoria" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <div class="clearfix"></div>
    </div>
</div>
<!--Fim Seção content-main-->

<?php include('./pacotes/footer.php'); ?>

<?php /*Fim formulário de categória*/ ?>

<?php
    //Processar o Valor do Formulário e Salvá-lo no Banco de Dados

    //Checar se o botão foi clicado ou não

    if (isset($_POST['submit'])) {
        //botão clicado
        //echo "Botão Clicado.";

        //Obtendo os dados do formulário
        $title = $_POST['title'];

        //Para o input tipo radio, é necessário checar se uma das opções de cada input está marcado ou não
        if(isset($_POST['featured'])) {
            //Pegar o valor selecionado do formulario, aqui é se o a categoria está em destaque
            $featured = $_POST['featured'];
        } else {
            //Definir o valor padrão caso o usuario não tenha selecionado nenhuma das opções
            $featured = "No";
        }

        //Para o input tipo radio, é necessário checar se uma das opções de cada input está marcado ou não
        if(isset($_POST['active'])) {
            //Pegar o valor selecionado do formulario, aqui é se o a categoria está ativo
            $active = $_POST['active'];
        } else {
            //Definir o valor padrão caso o usuario não tenha selecionado nenhuma das opções
            $active = "No";
        }

        
        //print_r($_FILES['image']); //Para fins de teste
        //die();//Quebrando o código aqui, pois quero somente ver o arquivo selecionado(para fins de teste)

        //Checando se a imagem está selecinada ou não e definir o valor para o nome da imagem de acordo
        if (isset($_FILES['image']['name'])) {

            //Upload da imagem
            //Para pode realizar o upload da imagem é necessário saber o caminho de origem e de destino da mesma
            $image_name = $_FILES['image']['name'];

            //Carregar imagem apenas se a mesma for selecionada
            if($image_name != "") {

                //Auto renomear a imagem
                //Pegar a extensão da imagem a ser carregada (jpg, png e gif) ex: prato1.png
                $ext = end(explode('.', $image_name));
                //Renomear a imagem 
                $image_name = "Prato_Categoria_" . rand(000,999) . "." . $ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                //Agora é carregar a imagem
                $upload = move_uploaded_file($source_path, $destination_path);

                //Checar se a imagem foi carregada ou não
                //Se a imagem não foi carregada temos que parar o processo e redirecionar a mensagem de erro
                if ($upload == false) {

                    //Setando a mensagem
                    $_SESSION['upload'] = "<div class='error'>Falha no carregamento da imagem </div>";

                    //Redirecionando para a página de adicionar categoria
                    header ('location: ' . SITE_URL . 'admin/add-category.php');
                    die();
                }
            }
        } else {
            
            //Não ocorrerá o upload e setar o valor de nome como vazio
            $imagem_name = "";

        }

        //Testando se o categoria já existe ou se está inválido
        $sql = "SELECT titulo FROM tbl_categoria WHERE titulo ='$title'";

        //Executar a query e salvar no banco de dados
        $resp = mysqli_query($conn,$sql);

        $array = mysqli_fetch_assoc($resp);

        $logarray = $array['titulo'];

        if ($title == " " || $title == null) {

            $_SESSION['category-one'] = "<div class='error'> Categoria inválida. </div>";

            //Redirecionado para página manage category
            header("location: " . SITE_URL . 'admin/manage-category.php');
        } else if ($logarray == $title) {
            $_SESSION['category-one'] = "<div class='error'> Categoria já existe. </div>";
            
            //Redirecionado para página manage category
            header("location: " . SITE_URL . 'admin/manage-category.php');
        } else {

            //Criar uma consulta sql para adicionar uma categoria no banco de dados
            $sql = "INSERT INTO tbl_categoria SET
                titulo = '$title',
                nome_imagem = '$image_name',
                destaque = '$featured',
                ativo = '$active'
            ";

            //Executar a query e salvar no BD
            $res = mysqli_query($conn, $sql); //or die(mysqli_error($conn));

            //Checar se a query foi executada ou não, e se os dados fora adicionados
            if ($res == true) {
                //Query executada e dados adicionados
                $_SESSION['add'] = "<div class='success'>Categoria adicionado com sucesso</div>";

                //Redirecionando mensagem para a página de Categoria
                header('location: ' . SITE_URL . 'admin/manage-category.php');

            } else {
                //Falha ao adicionar os dados
                $_SESSION['add'] = "<div class='error'>Categoria não foi adicionada</div>";

                //Redirecionando mensagem para a página de Categoria
                header('location: ' . SITE_URL . 'admin/add-category.php');
            }
        }
    }
?>