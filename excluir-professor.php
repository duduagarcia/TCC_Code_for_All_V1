<!DOCTYPE html>
<html lang="pt-br">
<body>
   
    <?php
        $conexao=mysqli_connect("localhost","root","","tcc");

        $id = filter_input(INPUT_GET,'id');

        if(!empty($id)){

            $lista_profs = mysqli_query($conexao,"DELETE FROM professores WHERE id = '$id'");

        }
    ?>
    <br><br>
    <script>
        window.alert("Professor excluído com sucesso");
        window.location.href = "http://localhost/code_for_all/areaAdmin.php";
    </script>
</body>
</html>