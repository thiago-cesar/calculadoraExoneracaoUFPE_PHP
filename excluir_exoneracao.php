<?php



    if(isset($_POST['confirmar'])){

        include("conexao.php");
        
        $siape=intval($_GET['siape']);
        $sql_code="DELETE FROM servidor_exonerado WHERE siape='$siape'";
        $sql_query=$mysqli->query($sql_code) or die($mysqli->error);

        if($sql_query) { ?>

            <h1 style="font-family:System, monospace ;" >Exoneração EXCLUÍDA com sucesso!</h1>
            <p style="font-family:System, monospace ;" ><a href="servidores_exonerados.php">Clique aqui</a> para voltar para a lista de exonerações.</p>
            <?php

            die(); 

        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Exoneração</title>
</head>
<body style="font-family:System, monospace ;" >
    <h1>Tem certeza que deseja excluir exoneração?</h1>
    <form action="" method="POST">
    <a href="servidores_exonerados.php">Não</a>
    <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
</body>
</html>