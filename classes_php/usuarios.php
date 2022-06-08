<?php

   class Usuario{

        private $pdo;
        public $msgErro = "";

        public function conectar($host,$usuario,$senha, $nomeBd){

            global $pdo;
            
            try {
                $pdo = new PDO("mysql:host=".$host.";dbname=".$nomeBd,$usuario,$senha);
            } catch (PDOException $ex) {
                $msgErro = $e->getMessage();
            }

        }

        public function cadastrar($nome,$email,$senha){

            global $pdo;

            //Verificar se já existe um usuário cadastrado

            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");

            $sql->bindValue(":e",$email);
            $sql->execute();

            if($sql->rowCount() > 0){
                return false;
            }else{
                $sql = $pdo->prepare("INSERT INTO usuarios (nome,email, senha) VALUES (:n,:e,:s)");

                $sql->bindValue(":n",$nome);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
        }

        public function logar($email,$senha)
        {
            global $pdo;

            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND  senha = :s");

            $sql->bindvalue(":e",$email);
            $sql->bindvalue(":s",md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $dado = $sql->fetch();
                session_start();
                $_SESSION['id'] = $dado['id'];
                return true;
            }
            else
            {
                return false;
            }
        }  
        
        public function redefinir($email,$novaSenha)
        {
            global $pdo;

            //Verificar se já existe um usuário cadastrado
            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");

            $sql->bindValue(":e",$email);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $sql = $pdo->prepare("UPDATE usuarios SET senha = :s WHERE email = :e");

                $sql->bindValue(":s",md5($novaSenha));
                $sql->bindValue(":e",$email);
                $sql->execute();
                return true;
            }
            else
            {
                return false;
            }
        }  
   }
?>