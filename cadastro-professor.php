<?php
    require_once 'classes_php/professores.php';
    $prof = new Professor;
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
    <link rel="stylesheet" href="css/style-cadastro-professor.css">

    <script>
        function mascara_telefone(){
            var telefone = document.getElementById('campo-telefone');
           
            if(telefone.value.length == 2){
                telefone.value += "-";
            }
        }
    </script>
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
            <h2>Cadastro de Professores</h2>
            <!-- FORMULÁRIO QUE FAZ A AÇÃO COM O PHP -->
            <form  method="POST">
                <label for="campo-nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" placeholder="Digite seu nome" maxlength="40" minlength="4" required autocomplete="off" class="campo">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                
                <label for="campo-email">E-mail:</label>
                <br>
                <input type="email" name="email" id="campo-email" placeholder="Digite seu E-mail" maxlength="40" minlength="10" required class="campo">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-telefone">Telefone: (51-...) OPCIONAL</label>
                <br>
                <input type="text" name="telefone" id="campo-telefone" placeholder="Digite seu Telefone" maxlength="12" minlength="12" class="campo" onkeyup="mascara_telefone()">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label class="label-check um">Selecione sua matéria 1</label>
                <br>
                <br>
                <label class="label-check">Informática básica</label>
                <input type="radio"  name="materia1" required value="Informatica basica">
                <br>
                <label class="label-check">HTML e CSS</label>
                <input type="radio"  name="materia1" required value="HTML e CSS" class="rdBtn1">
                <br>
                <label class="label-check">Java</label>
                <input type="radio" value="Java" name="materia1" required class="rdBtn2">
                <br>
                <label class="label-check">C++</label>
                <input type="radio"  name="materia1" required value="C++" class="rdBtn3">
                <br>
                <label class="label-check">Banco de dados</label>
                <input type="radio"  name="materia1" required value="Banco de dados" class="rdBtn4">
                <br>
                <br>
                <label class="label-check dois">Selecione sua matéria 2</label>
                <br>
                <br>
                <label class="label-check">Informática básica</label>
                <input type="radio"  name="materia2" required value="Informatica basica">
                <br>
                <label class="label-check">HTML e CSS</label>
                <input type="radio"  name="materia2" required value="HTML e CSS" class="rdBtn1">
                <br>
                <label class="label-check">Java</label>
                <input type="radio" value="Java" name="materia2" required class="rdBtn2">
                <br>
                <label class="label-check">C++</label>
                <input type="radio"  name="materia2" required value="C++" class="rdBtn3">
                <br>
                <label class="label-check">Banco de dados</label>
                <input type="radio"  name="materia2" required value="Banco de dados" class="rdBtn4">
                <br>
                <br>
                <br>
                <label for="campo-senha">Senha (5 letras ou números)</label>
                <br>
                <input type="password" name="senha" id="campo-senha" placeholder="Crie sua senha" maxlength="5" minlength="5" required class="campo">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <label for="campo-confirmaSenha">Confirme sua senha:</label>
                <br>
                <input type="password" name="confirmaSenha" id="campo-confirmaSenha" maxlength="5" minlength="5" required placeholder="Confirme sua senha" class="campo">
                <span></span>
                <br>
                <br>
                <input type="submit" value="CADASTRAR" class="campo botao-1">
                <br>
                <input type="reset" value="LIMPAR" class="campo botao-2">
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
            $celular   = addslashes($_POST['telefone']);
            $materia1   = addslashes($_POST['materia1']);
            $materia2   = addslashes($_POST['materia2']);
            $senha = addslashes($_POST['senha']);
            $confirmaSenha = addslashes($_POST['confirmaSenha']);

            $prof->conectar("localhost","root","","tcc");
  
            if($senha == $confirmaSenha)
            {
                if($prof->cadastrar($nome,$email,$celular,$materia1,$materia2,$senha))
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