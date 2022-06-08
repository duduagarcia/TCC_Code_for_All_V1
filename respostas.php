<?php
session_start();
$nomeAluno = $_SESSION['nome'];
$emailAluno = $_SESSION['email'];

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
    <link rel="stylesheet" href="css/style-respostas.css">
</head>
<body>
    <header>
        <!-- NAV -->
        <nav>
            <div class="nome-site">
                Code For All
            </div>
            <div class="links-nav">
                <a href="home.php">HOME</a>
                <a href="duvidas.php">DÚVIDAS</a>
                <a href="contato.php">CONTATO</a>
                <a href="respostas.php">RESPOSTAS</a>
                <a href="sair.php">SAIR</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="nomePHP">
            <div class="container-titulo">
                <h1>Olá <span><?php echo $nomeAluno ?></span></h1>
                <h2>Veja suas respostas abaixo</h2>
                <button class="btn1"><a href="#mensagemPHP">Respostas</a></button>
            </div>
            <div class="hello">
                <span>Hello World_</span>
            </div>
            <div class="custom-shape-divider-bottom-1635601720">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>          
        </section>
        <br><br><br>
        <section class="mensagemPHP" id="mensagemPHP">
            <h2>RESPOSTAS</h2>
            <br>
            <?php
                $conexao=mysqli_connect("localhost","root","","tcc");

                $lista_respostas = mysqli_query($conexao,"SELECT * FROM respostas WHERE nome_aluno = '$nomeAluno' ");

                $nomeProfessor = '';
                $assunto = '';
                $texto = '';
                $idResposta = '';
                $textoPergunta = '';

                while($row_respostas = mysqli_fetch_assoc($lista_respostas)){

                    $nomeProfessor = $row_respostas['nome_professor'];
                    $assunto = $row_respostas['assunto'];
                    $texto = $row_respostas['texto'];
                    $idResposta = $row_respostas['id'];
                    $textoPergunta = $row_respostas['texto_pergunta']

                    ?>
                    <div class="container-form">
                        <form  method="post">
                            <div class="container-assunto">
                                <br><br>
                                <label>Assunto: </label>
                                <input type="text" name="assunto" value="<?php   echo $assunto;?>" readonly="true" class="inputText">
                                <br><br>
                            </div>
                            <div class="dados-aluno">
                                <label>De: </label>
                                <input type="text" name="nomeAluno" value="<?php   echo $nomeProfessor;?>" readonly="true" class="inputText">
                                <br>
                                <br>
                            </div>
                            <div class="container-mensagem">
                                <label>Pergunta:</label><br>
                                <textarea name="perguntaAluno" cols="60" rows="10" maxlength="400" placeholder=" <?php echo $textoPergunta;?>" readonly="true"></textarea>
                                <br>
                            </div>
                            <br><br><br>
                            <div class="container-text-area">
                                <label>Resposta</label>
                                <br>
                                <textarea name="resposta" id="" cols="60" rows="10" maxlength="400" placeholder=" <?php echo $texto;?>" readonly="true"></textarea>
                                <br>
                            </div>
                            <br><br>
                            <div class="container-btns">
                                <input type="submit" value="VISTA" class="btn-submit"><br><br>
                            </div>
                            <br><br>
                            <hr>
                        </form>
                    </div> 
                    <?php
                }
                ?>

                <?php

                    if(isset($_POST['nomeAluno']))
                    {
                        $conexao=mysqli_connect("localhost","root","","tcc");

                        mysqli_query($conexao,"DELETE FROM respostas WHERE id = '$idResposta'");

                        ?>
                        <script>
                            window.alert("resposta visualizada com sucesso");
                            window.location.href = "http://localhost/code_for_all/respostas.php";
                        </script>
                        <?php

                    }
                ?>      
        </section>
    </main>
</body>
</html>