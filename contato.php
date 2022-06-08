<?php
session_start();
$nomeAluno = $_SESSION['nome'];
$emailAluno = $_SESSION['email'];

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <!-- LINKS DAS FONTES USADAS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    
    <title>Code for All</title>

    <link rel="stylesheet" href="css/style-contato.css">

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
    </header>
    <main>
        <div class="container-title">
            <h1>TALK WITH US</h1>
        </div>
        <div class="container-form">
            <form  method="post">
                <div class="textfields-container">
                    <label for="campo-nome">Digite seu nome:</label>
                    <input type="text" name="nome" id="campo-nome" placeholder="Digite seu nome" required value="<?php   echo $nomeAluno;?>" readonly="true">
                    <label for="campo-email">Digite seu e-mail:</label>
                    <input type="email" name="email" id="campo-email" placeholder="Digite seu email" required value="<?php   echo $emailAluno;?>" readonly="true">
                    <input type="submit" value="ENVIAR" class="botao-submit">
                    <input type="reset" value="LIMPAR" class="botao-reset">
                </div>
                <div class="textarea-container">
                    <label for="textarea">Deixe sua mensagem:</label>
                    <textarea name="mensagem" id="textarea" cols="22" rows="14" required></textarea>
                </div>
            </form>
        </div>
    </main>
    
    <footer>
        <section class="copyright">
        Copyright © 2021 Eduardo Garcia. Todos direitos reservados
            <br>
        </section>
    </footer>

    <?php
        if(isset($_POST['email']))
        {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $mensagem = $_POST['mensagem'];
            $data_envio = date('d/m/Y');
            $hora_envio = date('H:i:s');

 
            $mail = new PHPMailer();
 
            try {
	            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	            $mail->isSMTP();
	            $mail->Host = 'smtp.gmail.com';
	            $mail->SMTPAuth = true;
	            $mail->Username = 'codeforall.st@gmail.com';
	            $mail->Password = 'solonTavares';
	            $mail->Port = 587;
 
	            $mail->setFrom($email);
	            $mail->addAddress('codeforall.st@gmail.com');
 
	            $mail->isHTML(true);
	            $mail->Subject = 'Contato pelo site Code For All';
	            $mail->Body = 'Nome: '.$nome.'<br><br> E-mail: '.$email.'<br><br> <strong>Mensagem:</strong> <br>'.$mensagem;
	            $mail->AltBody = 'Chegou o email';
 
	            if($mail->send()) {
                    ?>
                    <script>
                        window.alert('Email enviado com sucesso!');
                    </script>
                    <?php	  
	            } else {
		            echo 'Email nao enviado';
	            }
            } catch (Exception $e) {
	            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
        }
    ?>
</body>
</html>