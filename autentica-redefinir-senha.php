<?php
    require_once 'classes_php/usuarios.php';
    require_once 'classes_php/professores.php';
    $user = new Usuario;
    $prof = new Professor;

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
<link rel="stylesheet" href="css/style-autentica-redefinir-senha.css">

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
            cadastrado e será enviado um e-mail com o link para redefinir sua senha.
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
                <input type="email" id="campo-email" name="email" placeholder="Digite seu email:" maxlength="40" minlength="6" required>
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
                <input type="submit" value="ENVIAR" class="botao" >
            </form>
            <a href="index.php"><button>VOLTAR</button></a>
            <?php
                if(isset($_POST['email']))
                {
                    $email   = addslashes($_POST['email']);
                    $tipoPessoa = addslashes($_POST['tipo']);
                    $data_envio = date('d/m/Y');
                    $hora_envio = date('H:i:s');

                    $mail = new PHPMailer();

                    session_start();
                    $_SESSION['email'] = $email;

                    if($tipoPessoa == 'aluno')
                    {
                        $conexao=mysqli_connect("localhost","root","","tcc");

                        $idAluno = '';

                        $emailAluno = mysqli_query($conexao,"SELECT id FROM usuarios WHERE email = '$email'");

                        while($row_idAluno = mysqli_fetch_assoc($emailAluno)){
                            $idAluno = $row_idAluno['id'];
                        }
                        if(strlen($idAluno)==1)
                        {
                            try {
                                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'codeforall.st@gmail.com';
                                $mail->Password = 'solonTavares';
                                $mail->Port = 587;
                 
                                $mail->setFrom('codeforall.st@gmail.com');
                                $mail->addAddress($email);
                 
                                $mail->isHTML(true);
                                $mail->Subject = 'Redefinir senha Code For All';
                                $mail->Body = 'Olá, para redefinir sua senha basta clicar no link abaixo <br><br> <a href="http://localhost/code_for_all/redefinirSenha.php">Redefinir Senha</a>';
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
                        else
                        {
                            ?>
                                <script>
                                    window.alert("O E-mail não está cadastrado na base de dados");
                                </script>
                            <?php
                        }
                        
                    }
                    else if($tipoPessoa == 'professor')
                    {
                        $conexao=mysqli_connect("localhost","root","","tcc");

                        $idProfessor = '';

                        $emailProfessor = mysqli_query($conexao,"SELECT id FROM professores WHERE email = '$email'");

                        while($row_idProfessor = mysqli_fetch_assoc($emailProfessor)){
                            $idProfessor = $row_idProfessor['id'];
                        }

                        if(strlen($idProfessor)>=1)
                        {
                            try {
                                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'codeforall.st@gmail.com';
                                $mail->Password = 'solonTavares';
                                $mail->Port = 587;
                 
                                $mail->setFrom('codeforall.st@gmail.com');
                                $mail->addAddress($email);
                 
                                $mail->isHTML(true);
                                $mail->Subject = 'Redefinir senha Code For All';
                                $mail->Body = 'Olá, para redefinir sua senha basta clicar no link abaixo <br><br> <a href="http://localhost/code_for_all/redefinirSenha.php">Redefinir Senha</a>';
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