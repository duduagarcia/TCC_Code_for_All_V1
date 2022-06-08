<?php
    
    $conexao=mysqli_connect("localhost","root","","tcc");
    $nomeProfessor = $_POST['nomeProfessor'];
    $nomeAluno = $_POST['nome-aluno'];
    $text = $_POST['text'];
    $assunto = $_POST['materia'];

    mysqli_query($conexao,"INSERT INTO mensagens (assunto, nome_professor, nome_aluno, texto) VALUES ('$assunto', '$nomeProfessor','$nomeAluno','$text')");

    ?>
        <script>
            window.alert("Mensagem enviada com sucesso");
            window.location.href = "http://localhost/code_for_all/duvidas.php";
        </script>
    <?php
?>