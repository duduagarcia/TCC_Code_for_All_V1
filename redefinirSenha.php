<?php
    session_start();
    $email = $_SESSION['email'];
    require_once 'classes_php/usuarios.php';
    require_once 'classes_php/professores.php';
    $user = new Usuario;
    $prof = new Professor;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Code For All</title>

    <!-- LINKS DAS FONTES USADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

<!-- LINK DO CSS -->
<link rel="stylesheet" href="css/style-redefinirSenha.css">

</head>
<body>
   <!-- CABEÇALHO DA PÁGINA COM AS INTRUÇÕES -->
   <header>
        <div class="nome-site">
            <p>Code for All</p>
        </div>
        <div class="aviso">
            <p>
            Para redefinir sua senha, digite seu email já
            cadastrado e digite sua nova senha duas vezes
            </p>
        </div>
    </header> 
    <main>
        <div class="container-form">
            <h1>
                Redefinir sua senha
            </h1>
            <!-- FORMULÁRIO COM AÇÃO PARA PÁGINA DE CADASTRO -->
            <form method="POST">
                <br>
                <label for="campo-email" class="label-email">E-mail</label>
                <br>
                <input type="email" id="campo-email" name="email"  maxlength="40" minlength="6" required value="<?php echo $email; ?>" readonly="true">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-new-senha" class="label-new-senha">Nova senha</label>
                <br>
                <input type="password" id="campo-new-senha" name="novaSenha" placeholder="Digite sua nova senha:" maxlength="5" minlength="5" required>
                <span></span>
                <!-- ATIVAÇÃO DA FUNÇÃO JS AO CLICLAR NO BOTÃO -->
                <br>
                <br>
                <label for="campo-confirma-senha" >Confirmar senha</label>
                <br>
                <input type="password" id="campo-confirma-senha" name="confirmaSenha" placeholder="Confirme sua nova senha:" maxlength="5" minlength="5" required>
                <span></span>
                <br>
                <br>
                <label class="teste1">Você é professor ou aluno?</label>
                <br><br>
                <input type="radio" name="tipo" required value="professor" class="radioP">
                <label class="professor">Professor</label>
                <input type="radio" name="tipo" required value="aluno" class="radioA">
                <label class="professor">Aluno</label>
                <br>
                <input type="submit" value="REDEFINIR" class="botao" onclick="return validar_chave()">
            </form>
            <a href="index.php"><button>VOLTAR</button></a>
            <?php
                if(isset($_POST['email']))
                {
                    $email   = addslashes($_POST['email']);
                    $novaSenha = addslashes($_POST['novaSenha']);
                    $confirmaSenha = addslashes($_POST['confirmaSenha']);
                    $tipoPessoa = addslashes($_POST['tipo']);

                    if($tipoPessoa == 'aluno')
                    {
                        $user->conectar("localhost","root","","tcc");

                        if($novaSenha == $confirmaSenha)
                        {
                            if($user->msgErro == "")
                            {
                                if($user->redefinir($email,$novaSenha))
                                {
                                    ?>
                                        <script>
                                            window.alert("SENHA ALTERADA COM SUCESSO");
                                            window.location.href = "http://localhost/code_for_all/index.php";
                                        </script>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <script>
                                            window.alert("O E-mail não está cadastrado na base de dados");
                                        </script>
                                    <?php
                                }
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
                    else
                    {
                        $prof->conectar("localhost","root","","tcc");
                        if($novaSenha == $confirmaSenha)
                    {
                        if($prof->msgErro == "")
                        {
                            if($prof->redefinir($email,$novaSenha))
                            {
                                ?>
                                <script>
                                    window.alert("SENHA ALTERADA COM SUCESSO");
                                    window.location.href = "http://localhost/code_for_all/index.php";
                                </script>
                                <?php
                            }
                            else
                            {
                                ?>
                                <script>
                                    window.alert("O E-mail não está cadastrado na base de dados");
                                </script>
                                <?php
                            }
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
                    
                }
            ?>
        </div>
     
    </main>
    <footer>    
        <section class="copyright">
            Copyright © 2021 Eduardo Garcia. Todos direitos reservados
            <br>
        </section>
    </footer>
</body>
</html>