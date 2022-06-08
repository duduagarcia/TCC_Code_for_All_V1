<?php
    require_once 'classes_php/usuarios.php';
    $user = new Usuario;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <title>Code for all</title>

        <!-- LINKS DAS FONTES USADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

    <!-- LINK DO CSS -->
    <link rel="stylesheet" href="css/style-cadastro.css">

</head>
<body>
    <main>
        <!-- CONTAINER DA IMAGEM -->
        <div class="container-img">
            <img src="img/cadastro.jpg" alt="Imagem de fundo">
        </div>
        <!-- CONTAINER DO FORMULÁRIO -->
        <div class="container-form">
            <h1>Code for All</h1>
            <h2>Cadastro</h2>
            <!-- FORMULÁRIO QUE FAZ A AÇÃO COM O PHP -->
            <form  method="POST">
                <label for="campo-nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" maxlength="40" minlength="4" required autocomplete="off">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                
                <label for="campo-email">E-mail:</label>
                <br>
                <input type="email" name="email" id="campo-email" placeholder="Digite seu E-mail" maxlength="40" minlength="10" required >
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-senha">Senha (5 letras ou números)</label>
                <br>
                <input type="password" name="senha" id="campo-senha" placeholder="Crie sua senha" maxlength="5" minlength="5" required >
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-confirmaSenha">Confirme sua senha:</label>
                <br>
                <input type="password" name="confirmaSenha" id="campo-confirmaSenha" maxlength="5" minlength="5" required placeholder="Confirme sua senha">
                <span></span>
                <br>
                <br>
                <input type="submit" value="CADASTRAR" class="botao-1">
                <br>
                <input type="reset" value="LIMPAR" class="botao-2">
            </form>
            <a href="index.php"><button>VOLTAR</button></a>
        </div>
    </main>
    <footer>
        <section class="copyright">
        Copyright © 2021 Eduardo Garcia. Todos direitos reservados
        </section>
    </footer>
    <div class="gradiente"></div> <!-- GRADIENTE SOBRE A IMAGEM-->

    <?php
        if(isset($_POST['nome']))
        {
            $nome  = addslashes($_POST['nome']);
            $email   = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confirmaSenha = addslashes($_POST['confirmaSenha']);

            $user->conectar("localhost","root","","tcc");
  
            if($senha == $confirmaSenha)
            {
                if($user->cadastrar($nome,$email,$senha))
                {
                    ?>
                    <script>
                       window.alert("DADOS CADASTRADOS COM SUCESSO!");
                       window.location.href = "http://localhost/code_for_all/";
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        window.alert("Esse E-mail já foi cadastrado no banco de dados");
                    </script> 
                    <?php
                }
            }
            else
            {
                ?> 
                <script>
                    window.alert("As senhas digitadas não coincidem!");
                </script>
                <?php
            }  
        }
    ?> 
</body>
</html>