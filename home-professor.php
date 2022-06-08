<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("location: index.php");
        exit;
    }
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
    <link rel="stylesheet" href="css/style-home-professor.css">

    <script>
        function avisoFeature(){
            window.alert("Essa funcionalidade está disponível apenas para estudantes da Escola Dr Solon Tavares");
        }
    </script>
</head>
<body>
    <header>
        <!-- NAV -->
        <nav>
            <div class="nome-site">
                Code For All
            </div>
            <div class="links-nav">
                <a href="home-professor.php">HOME</a>
                <a href="#" onclick="return avisoFeature()">DÚVIDAS</a>
                <a href="contato-professor.php">CONTATO</a>
                <a href="autentica-adm.html">ADMINISTAÇÃO</a>
                <a href="sair.php">SAIR</a>
            </div>
        </nav>
    </header>
    <main>
        <section class="nomePHP">
            <?php
                $conexao=mysqli_connect("localhost","root","","tcc");

                $idProfessor = $_SESSION['id'];

                $nomeProfessor = mysqli_query($conexao,"SELECT nome,email FROM professores WHERE id = '$idProfessor'");

                $nome = '';
                $email = '';

                while($row_professores = mysqli_fetch_assoc($nomeProfessor)){

                    $nome = $row_professores['nome'];
                    $email = $row_professores['email'];
                    ?>
                        <div class="container-titulo">
                            <h1>Olá <span><?php echo $nome ?></span></h1>
                            <h2>Veja suas mensagens abaixo</h2>
                            <button class="btn1"><a href="#mensagemPHP">Mensagens</a></button>
                        </div>
                        <div class="hello">
                            <span>Hello World_</span>
                        </div>
                    <?php 
                }
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
            ?>
            <div class="custom-shape-divider-bottom-1635601720">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
        </section>
        
        <section class="mensagemPHP" id="mensagemPHP">
            <hr><br>
            <h2>MENSAGENS</h2>
            <br><br><br>
            <?php
                $conexao=mysqli_connect("localhost","root","","tcc");

                $lista_mensagens = mysqli_query($conexao,"SELECT * FROM mensagens WHERE nome_professor = '$nome' ");

                $nomeAluno = '';
                $assunto = '';
                $texto = '';
                $idMensagem = '';

                while($row_mensagens = mysqli_fetch_assoc($lista_mensagens)){

                    $nomeAluno = $row_mensagens['nome_aluno'];
                    $assunto = $row_mensagens['assunto'];
                    $texto = $row_mensagens['texto'];
                    $idMensagem = $row_mensagens['id'];

                    ?>
                    <div class="container-form">
                        <form  method="post">
                            <div class="container-assunto">
                                <label>Assunto: </label>
                                <input type="text" name="assunto" value="<?php   echo $assunto;?>" readonly="true" class="inputText">
                                <br><br>
                            </div>
                            <div class="dados-aluno">
                                <label>De:</label>
                                <input type="text" name="nomeAluno" value="<?php   echo $nomeAluno;?>" readonly="true" class="inputText">
                                <br>
                                <br>
                            </div>
                            <div class="container-mensagem">
                                <label>Mensagem:</label><br>
                                <textarea name="perguntaAluno" cols="60" rows="10" maxlength="400" placeholder=" <?php echo $texto;?>" readonly="true"></textarea>
                                <br>
                            </div>
                            <br><br><br>
                            <div class="container-text-area">
                                <label>Resposta</label>
                                <br>
                                <textarea name="resposta" id="" cols="60" rows="10" maxlength="400"></textarea>
                                <br>
                            </div>
                            <div class="container-btns">
                                <input type="submit" value="ENVIAR" class="btn-submit"><br><br>
                                <input type="reset" value="LIMPAR" class="btn-reset">
                            </div>
                            <br><br>
                            <hr>
                        </form>
                    </div> 
                    <?php
                }
                ?>

                <?php

                    if(isset($_POST['resposta']))
                    {
                        $conexao=mysqli_connect("localhost","root","","tcc");

                        $nomeAluno = $_POST['nomeAluno'];
                        $text = $_POST['resposta'];
                        $assunto = $_POST['assunto'];
                        $textoPergunta = $_POST['perguntaAluno'];

                        mysqli_query($conexao,"INSERT INTO respostas (assunto, nome_aluno, nome_professor,texto, texto_pergunta) VALUES ('$assunto', '$nomeAluno','$nome','$text', '$texto')");

                        mysqli_query($conexao,"DELETE FROM mensagens WHERE id = '$idMensagem'");

                        ?>
                        <script>
                            window.alert("RESPOSTA enviada com sucesso");
                            window.location.href = "http://localhost/code_for_all/home-professor.php";
                        </script>
                        <?php
                    }
                ?>
                
                 
        </section>
        <section class="capitulos" id="capitulos">

            <!-- CARD 1 -->
            <div class="card">
                <div class="card-img">
                    <img src="img/card1.png" alt="" class="img-card-1">
                </div>
                <h2>Capítulo 1</h2>
                <p>Neste capítulo você irá aprender sobre o que é a informática, suas áreas, o que um técnico em infomrática faz e muitos outros conceitos.</p>
                <br><br>
                <a href="capitulo1-professor.html" class="a-1">Acesse já</a>
            </div>

            <!-- CARD 2 -->
            <div class="card">
                <div class="card-img">
                    <img src="img/card2.png" alt="" class="img-card-2">
                </div>
                <h2>Capítulo 2</h2>
                <p>Neste capítulo você irá aprender sobre HTML5 e, dará seu primeiro passo na construção de páginas web.</p>
                <br>
                <br>
                <br>
                <a href="#" class="a-2" onclick="return aviso()">Acesse já</a>
            </div>

            <!-- CARD 3 -->
            <div class="card">
                <div class="card-img">
                    <img src="img/card3.png" alt="" class="img-card-3">
                </div>
                <h2>Capítulo 3</h2>
                <p>Neste capítulo você irá aprender sobre CSS3, uma ferramenta de estilização de HMTL5 e, começará a estilizar suas páginas web.</p>
                <br><br><br>
                <a href="#" class="a-3" onclick="return aviso()">Acesse já</a>
            </div>

            <!-- CARD 4 -->
            <div class="card">
                <div class="card-img">
                    <img src="img/card4.jpeg" alt="" class="img-card-4">
                </div>
                <h2>Em breve</h2>
                <p>A ferramenta Code For All não é estática, isso significa que ela estará sempre se atualizando para entregar conteúdos diversificados para você estudante.</p>
                <br>
                <br>
                <div class="link-container">
                    <a href="#" class="a-4" onclick="return aviso()">Acesse já</a>
                </div>
            </div>
        </section>
    </main>
    <!-- FOOTER DA PÁGINA -->
    <footer>
        <section class="copyright">
        Copyright © 2021 Eduardo Garcia. Todos direitos reservados
            <br>
        </section>
    </footer>
    </main>
</body>
</html>