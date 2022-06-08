<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ÁREA ADMIN</title>

    <!-- LINKS DAS FONTES USADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

    <!-- LINK DO CSS -->    
    <link rel="stylesheet" href="css/style-adm.css">

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
        <div class="aviso">
            <p>
                Seja bem vindo Administrador
            </p>
        </div>
    </header>
    <main>
        <br><br>
        <h1>Usuarios cadastrados</h1>
        <br><br>
        <?php
        $conexao=mysqli_connect("localhost","root","","tcc");

        $lista_usuarios = mysqli_query($conexao,"SELECT * FROM usuarios");

        while($row_usuarios = mysqli_fetch_assoc($lista_usuarios)){

            echo "<br>ID : ".$row_usuarios['id']."<br><br>";
            echo "NOME : ".$row_usuarios['nome']."<br><br>";
            echo "EMAIL : ".$row_usuarios['email']."<br><br>";

            echo "<a href = 'excluir.php?id=".$row_usuarios['id']."'>Apagar</a><br><br><hr>";
        }
    ?>
    <h1>Professores cadastrados</h1>
    <br><br>
    <?php
        $conexao=mysqli_connect("localhost","root","","tcc");

        $lista_profs = mysqli_query($conexao,"SELECT * FROM professores");

        while($row_profs = mysqli_fetch_assoc($lista_profs)){

            echo "<br>ID : ".$row_profs['id']."<br><br>";
            echo "NOME : ".$row_profs['nome']."<br><br>";
            echo "EMAIL : ".$row_profs['email']."<br><br>";
            echo "TELEFONE : ".$row_profs['celular']."<br><br>";
            echo "MATÉRIA 1 : ".$row_profs['materia_1']."<br><br>";
            echo "MATÉRIA 2 : ".$row_profs['materia_2']."<br><br>";

            echo "<a href = 'excluir-professor.php?id=".$row_profs['id']."'>Apagar</a><br><br><hr>";
        }
    ?>
    </main>
</body>
</html>