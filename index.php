<?php
    require_once 'classes_php/usuarios.php';
    require_once 'classes_php/professores.php';
    $user = new Usuario;
    $prof = new Professor;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <title>Code for All</title>
    
        <!-- LINKS DAS FONTES USADAS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

    <!-- LINK DO CSS -->
    <link rel="stylesheet" href="css/style-index.css">
    
</head>
<body>
    <header>
        <div class="nome-site">
            <p>Code for All</p>
        </div>
    </header>
    <main>
        <!-- CONTAINER DA IMAGEM -->
        <div class="container-img">
            <img src="img/index.jpg" alt="backGround-1">
        </div>
        <!-- CONTAINER DO FORMULÁRIO -->
        <div class="container-form">
            <h1>Log In</h1>
            <!-- FORMULÁRIO QUE FAZ A AÇÃO COM O PHP -->
            <form  method="POST">
                <label for="campo-email">E-Mail:</label>
                <br>
                <input type="email" name="email" id="campo-email" placeholder="Digite seu email" maxlength="40" minlength="10" required autocomplete="off">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-senha">Senha (5 letras ou números)</label>
                <br>
                <input type="password" name="senha" id="campo-senha" placeholder="Crie sua senha" maxlength="5" minlength="5" required >
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label class="teste1">Você é professor ou aluno?</label>
                <br><br>
                <input type="radio" name="tipo" required value="professor" class="radioP">
                <label class="professor">Professor</label>
                <input type="radio" name="tipo" required value="aluno" class="radioA">
                <label class="professor">Aluno</label>
                <br>
                <br>
                <a href="free-home.html" class="semConta">Entrar sem conta</a>
                <br><br>
                <input type="submit" value="ENTRAR" class="botao-submit">
                <br>
            </form>
            <a href="autentica-redefinir-senha.php"><button>Esqueceu sua senha?</button></a><br>
            <a href="autentica-sem-conta.php"><button>Não possui conta ainda?</button></a>
        </div>
    </main>
    <footer>
        <!-- 1° SESSÃO SOBRE O SITE -->
        <section class="sec1">
            <div class="tittle-sec1">
                <h2>O que é Code for All</h2>
            </div>
            <div class="text-sec1">
                <p>Code For All é uma plataforma de auxílio estudantil para alunos do curso técnico em informática da Escola Dr Solon Tavares.</p>
            </div>
        </section>
        <!-- 2° SESSÃO SOBRE O SITE -->
        <section class="sec2">
            <div class="tittle-sec2">
                <h2>Como acesso Code for All?</h2>
            </div>
            <div class="text-sec2">
                <p>Se você já possui uma conta, basta entrar com seus dados, para obter acesso completo à plataforma. Caso não possua conta, clique no botão " Não possui uma conta ainda? " e siga as instruções.</p>
            </div>
        </section>      
        <!-- SESSÃO DE COPYRIGHT -->
        <section class="copyright">
        Copyright © 2021 Eduardo Garcia. Todos direitos reservados
        </section>
    </footer>
    <div class="gradiente"></div><!-- GRADIENTE DA IMAGEM -->

    <?php
        if(isset($_POST['email']))
        {
            $email   = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $tipoPessoa = addslashes($_POST['tipo']);

            if($tipoPessoa == 'aluno')
            {
                $user->conectar("localhost","root","","tcc");
                if($user->msgErro == "")
                {
                    if($user->logar($email,$senha))
                    {
                        header("location: home.php");
                    }   
                    else
                    {   
                        ?>
                        <script>
                            window.alert("O E-mail e/ou a senha estão incorretos");
                        </script>
                        <?php
                    }
                }
            }
            else
            {
                $prof->conectar("localhost","root","","tcc");
                if($prof->msgErro == "")
                {
                    if($prof->logar($email,$senha))
                    {
                        header("location: home-professor.php");
                    }   
                    else
                    {   
                        ?>
                        <script>
                            window.alert("O E-mail e/ou a senha estão incorretos");
                        </script>
                        <?php
                    }
                }
            }
            
        }         
    ?>
</body>
</html>