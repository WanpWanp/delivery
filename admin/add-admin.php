<?php include('./pacotes/menu.php'); ?>
<?php include('../funcoes/admin/php/funcao-add-admin.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar novo Admin </h1>
        <br><br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //remove mensagem da seção
        }
        ?>
        <br><br>
        <form action="" method="POST">
            <table class=" tbl-30">
                <tr>
                    <td>Nome Completo:</td>
                    <td><input type="text" name="full_name" placeholder="Digite seu nome Completo"></td>
                </tr>
                <tr>
                    <td>Nome de usuário:</td>
                    <td><input type="text" name="username" placeholder="Digite seu nome de Usuário"></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="password" id="nova-senha" placeholder="Digite sua Senha"></td>
                    <td>
                        <button type="button" onclick="mostrarSenha()"><img src="https://img.icons8.com/material-outlined/30/000000/visible--v1.png" /></button>
                        <button type="button" onclick="ocultarSenha()"><img src="https://img.icons8.com/material-outlined/30/000000/closed-eye.png" /></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    function mostrarSenha() {
        var tipo = document.getElementById("nova-senha");
        if (tipo.type == 'password') {
            tipo.type = 'text';
        }
    }
    function ocultarSenha() {
        var tipo = document.getElementById("nova-senha");
        if (tipo.type == 'text') {
            tipo.type = 'password';
        }
    }
</script>
<?php include('./pacotes/footer.php'); ?>