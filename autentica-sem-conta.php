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
    <link rel="stylesheet" href="css/style-no-account.css">
</head>
<body>
    <!-- CABEÇALHO DA PÁGINA COM AS INTRUÇÕES -->
    <header>
        <div class="nome-site">
            <p>Code for All</p>
        </div>
        <div class="aviso">
            <p>
                Para acessar o formulário e criar sua conta, é preciso antes do código de autorização. Você pode pegar ele na secretaria da escola.
            </p>
        </div>
    </header>
    <main>
        <!-- CONTAINER DO FORMULÁRIO -->
        <div class="container-form">
            <h1>
                Insira a chave de acesso para proseguir seu cadastro
            </h1>
            <!-- FORMULÁRIO COM AÇÃO PARA PÁGINA DE CADASTRO -->
            <form method="POST">
                <br>
                <br>
                <label for="campo-chave">Chave de acesso</label>
                <br>
                <input type="text" id="campo-chave" placeholder="Insira a chave de acesso" maxlength="6" minlength="6" required name="chave">
                <span></span> <!-- SPAN = ÍCONES DE ERRO/ACERTO -->
                <br>
                <br>
                <!-- ATIVAÇÃO DA FUNÇÃO JS AO CLICLAR NO BOTÃO -->
                <input type="submit" value="Verificar" class="botao">
            </form>
            <a href="index.php"><button>VOLTAR</button></a>
        </div>
        <?php
            if(isset($_POST['chave']))
            {
                $chave = addslashes($_POST['chave']);

                if($chave == '111111')
                {
                    header("location: cadastro.php");
                }
                else
                if($chave == '222222')
                {
                    header("location: cadastro-professor.php");
                }
                else
                {
                    ?>
                        <script>
                            window.alert("A chave digitada está incorreta");
                        </script>
                        <?php
                }
            }
        ?>
    </main>
    <footer>
        <section class="copyright">
            Copyright © 2021 Eduardo Garcia. Todos direitos reservados
            <br>
        </section>
    </footer>
</body>
</html>