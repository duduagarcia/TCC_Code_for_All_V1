<?php

   class Professor{

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

        public function cadastrar($nome,$email,$celular,$materia1,$materia2,$senha){

            global $pdo;

            //Verificar se já existe um usuário cadastrado

            $sql = $pdo->prepare("SELECT id FROM professores WHERE email = :e");

            $sql->bindValue(":e",$email);
            $sql->execute();

            if($sql->rowCount() > 0){
                return false;
            }else{
                $sql = $pdo->prepare("INSERT INTO professores (nome,email, celular,materia_1, materia_2, senha) VALUES (:n,:e, :c, :m1, :m2, :s)");

                $sql->bindValue(":n",$nome);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":c",$celular);
                $sql->bindValue(":m1",$materia1);
                $sql->bindValue(":m2",$materia2);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }
        }

        public function logar($email,$senha)
        {
            global $pdo;

            $sql = $pdo->prepare("SELECT id FROM professores WHERE email = :e AND  senha = :s");

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
            $sql = $pdo->prepare("SELECT id FROM professores WHERE email = :e");

            $sql->bindValue(":e",$email);
            $sql->execute();

            if($sql->rowCount() > 0)
            {
                $sql = $pdo->prepare("UPDATE professores SET senha = :s WHERE email = :e");

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