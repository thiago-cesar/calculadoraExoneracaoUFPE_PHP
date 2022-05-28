<?php

    include('conexao.php');

    //Query de consultas-gerar consulta:
    $sql_servidores="SELECT *FROM servidor_exonerado ";
    //Executa a query para executar a consulta:
    $query_servidores=$mysqli->query($sql_servidores) or die($mysqli->error);
    //Verifica quantos servidores existem através de um num_rows:
    $num_servidores=$query_servidores->num_rows;

    


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exonerações Cadastradas</title>
</head>
<body style="font-family:System, monospace ;" >
    <h1>Lista de Exonerações</h1>
    <p>Exonerações Cadastradas:</p>
    <table border="1" cellpadding="10">

        <thead>
            <th>Siape</th>
            <th>Servidor</th>
            <th>Data Início de Exercício</th>
            <th>Data da Exoneração</th>
            <th>Remuneração</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php 
            if($num_servidores>0){
                
                    while($servidor=$query_servidores->fetch_assoc()){

                        $exercicio=formata_data($servidor['exercicio']);
                        $exoneracao=formata_data($servidor['exoneracao']);
                        $remuneracao=str_replace('.',',',$servidor['remuneracao']);  
                        ?>       
                        <tr>
                            <td><?php echo $servidor['siape'] ?> </td>
                            <td><?php echo $servidor['nome'] ?> </td>
                            <td><?php echo $exercicio ?> </td>
                            <td><?php echo $exoneracao?> </td>
                            <td><?php echo $remuneracao ?> </td>
                            <td>
                                <a href="editar_exoneracao.php?siape=<?php echo $servidor['siape'];?> ">Editar</a>
                                <a href="acertar_exoneracao.php?siape=<?php echo $servidor['siape'];?> "> Acertos</a>
                                <a href="excluir_exoneracao.php?siape=<?php echo $servidor['siape'];?> ">Excluir</a>
                            </td>

                        </tr>
                <?php } 
          
            }else{?>
                <tr>
                    <td colspan="7">Nenhum Servidor(exoneração) cadastrada!</td>
                </tr>       
            <?php
            }
            ?>
            
        </tbody>

    </table>

</body>
</html>