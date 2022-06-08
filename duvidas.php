<?php
    session_start();
    $nomeAluno = $_SESSION['nome'];
    require_once 'classes_php/professores.php';
    $prof = new Professor;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dúvidas TESTE</title>

    <!-- LINKS DAS FONTES USADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

    <!-- LINK DO CSS -->
    <link rel="stylesheet" href="css/style-duvidas.css">

    <script>
        function avisoFeature(){
            window.alert("Alunos não possuem acesso à essa funcionalidade");
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
                <a href="home.php">HOME</a>
                <a href="duvidas.php">DÚVIDAS</a>
                <a href="contato.php">CONTATO</a>
                <a href="respostas.php">RESPOSTAS</a>
                <a href="sair.php">SAIR</a>
            </div>
        </nav>
        <div class="aviso">
            <p>Por favor pedimos que respeite os horários dos professores, evite mensagens em horários inadequados</p>
        </div>
    </header>
    <main>
        <div class="main-container">
            <div class="title-container">
                <h1>Dúvidas_</h1>
                <p>Selecione o assunto referente a sua dúvida e clique no botão. Em seguida aparecerão os professores referentes à matéria e os meios para contato</p>
            </div>
            <div class="btn-container">
                <form method="POST">
                    <span>Selecione a Matéria</span>
                    <br>
                    <br>
                    <label class="label-check">Informática básica</label>
                    <input type="radio"  name="materia" required value="Informatica basica">
                    <br><br>
                    <label class="label-check">HTML e CSS</label>
                    <input type="radio"  name="materia" required value="HTML e CSS" class="rdBtn1">
                    <br><br>
                    <label class="label-check">Java</label>
                    <input type="radio" value="Java" name="materia" required class="rdBtn2">
                    <br><br>
                    <label class="label-check">C++</label>
                    <input type="radio"  name="materia" required value="C++" class="rdBtn3">
                    <br><br>
                    <label class="label-check">Banco de dados</label>
                    <input type="radio"  name="materia" required value="Banco de dados" class="rdBtn4">
                    <br>
                    <br>
                    <input type="submit" value="MOSTRAR PROFESSORES" class="btn-submit">
                </form>
            </div>
        </div>
        <section class="php-section">
            <?php
                if(isset($_POST['materia']))
                {
                    $materia = addslashes($_POST['materia']);

                    $conexao=mysqli_connect("localhost","root","","tcc");

                    $dbh = new PDO('mysql:host=localhost;dbname=tcc','root','');

                    $sth = $dbh->prepare('SELECT * FROM professores WHERE materia_1 LIKE :m OR materia_2 LIKE :m');

                    $sth->bindParam(':m',$materia,PDO::PARAM_STR);
                    $sth->execute();

                    $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

                    if(count($resultados))
                    {
                        foreach($resultados as $Resultado)
                        {
                            ?>
                            <div class="container-form">
                                <form action="mensagem.php" method="post">
                                    <br><br>
                                    <h1>DADOS DO PROFESSOR</h1>
                                    <br><br>
                                    <label class="label-nome">NOME:</label> <input type="text" name="nomeProfessor" value="<?php echo $Resultado['nome'];?>" class="inputText nome" readonly="true">
                                    <br><br>
                                    <label class="label-telefone">TELEFONE:</label> <a href="https://web.whatsapp.com/send?phone= <?php echo $Resultado['celular'];?>" target="_blank"><?php echo $Resultado['celular']; ?></a>
                                    <br><br>
                                    <label class="label-email">E-MAIL: </label> <input type="email" name="emailProfessor" value="<?php   echo $Resultado['email'];?>" class="inputText email" disabled>
                                    <br><br>
                                    <div class="dados-aluno">
                                        <div class="campos-aluno">
                                            <input type="text" name="materia" value="<?php   echo $materia;?>" readonly="true">
                                            <br><br>
                                            <input type="text" name="nome-aluno" required value="<?php   echo $nomeAluno;?>" readonly="true">
                                            <br><br>
                                        </div>
                                        <div class="container-text">
                                            <label>Deixe Sua mensagem:</label>
                                            <br>
                                            <textarea name="text" id="" cols="50" rows="7" required></textarea>
                                            <br><br>
                                        </div>
                                    </div>
                                    <input type="submit" value="CONTACTAR" class="btn">
                                    <br><br>
                                    <hr>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <script>
                                window.alert("Desculpe mas no momento não temos professores para essa matéria");
                            </script>
                        <?php
                    }
                   
                }
            ?>
        </section>
    </main>
    <!-- FOOTER DA PÁGINA -->
    <footer>
        <section class="copyright">
        Copyright © 2021 Eduardo Garcia. Todos direitos reservados
            <br>
        </section>
    </footer>
</body>
</html>