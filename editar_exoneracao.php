<?php

    include('conexao.php');
    $siape=intval($_GET['siape']);



    if(count($_POST)>0){



        $erro=false;  //Para controlar o retonro ou não de mensagem de erro.
        
        
        
        $nome=$_POST['nome'];
        $exercicio=$_POST['exercicio'];
        $exoneracao=$_POST['exoneracao'];
        $remuneracao=$_POST['remuneracao'];

        //Verificação para campos obrigatórios-campos vazios ou preenchidos.


     

        if(empty($nome)){
            $erro="Informe o NOME!";
        }

        if(empty($remuneracao)){
            $erro="Informe a remuneração!";
        }

        if(!empty($exercicio)){

            $pedacos=explode('/',$exercicio);
            if(count($pedacos)==3){
                
                $exercicio=implode('-', array_reverse($pedacos)); //Transformar data no padrão americano para o BD.
            }else{
                $erro="A data do exercício deve ser no padrão dia/mês/ano.";
            }

        }


        if(!empty($exoneracao)){

            $pedacos=explode('/',$exoneracao);
            if(count($pedacos)==3){
                
                $exoneracao=implode('-', array_reverse($pedacos)); //Transformar data no padrão americano para o BD.
            }else{
                $erro="A data da exoneração deve ser no padrão dia/mês/ano.";
            }
        }

        if($erro){
            //True:

            echo "<p><b>ERRO: $erro</b></p>";

        }else{
            $sql_code= "UPDATE servidor_exonerado SET nome='$nome',exercicio='$exercicio', exoneracao='$exoneracao',remuneracao='$remuneracao' WHERE siape='$siape' ";

            //Conectar-se com o BD através da função "query":

            $deu_certo=$mysqli->query($sql_code) or die($mysqli->error);

            if($deu_certo){
                echo "Exoneração alterada com SUCESSO!";
                unset($_POST);//Limpar a label e variáveis.
            }


        }
    
    
    }

    //TRANSFORMAR EM UM NÚMERO INTEIRO:

    $sql_servidor="SELECT *FROM servidor_exonerado WHERE siape='$siape' ";
    $query_servidor=$mysqli->query($sql_servidor) or die($mysqli->error);
    $servidor=$query_servidor->fetch_assoc();//Retorna um resultado através de loop em um array.

    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="font-family:System, monospace ;">
    <a href="servidores_exonerados.php">Voltas para Lista de Servidores</a>
    <form method="POST" action="">

    <p>
            SIAPE: <?php echo $servidor['siape'] ?>
            <br>
        </p>
       
        <p>
            <label>Nome: </label>
            <input value="<?php echo $servidor['nome'] ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Data do Efetivo Exercício: </label>
            <input value="<?php if(!empty($servidor['exercicio'])) echo formata_data($servidor['exercicio']);?>" name="exercicio" type="text"><br>
        </p>
        <p>
            <label>Data da Exoneração: </label>
            <input value="<?php if(!empty($servidor['exoneracao'])) echo formata_data($servidor['exoneracao']);?>" name="exoneracao" type="text"><br>
        </p>
        <p>
            <label>Remuneração: </label>
            <input value="<?php echo $servidor['remuneracao'] ?>" name="remuneracao" type="text"><br>
        </p>

        <p>
            <button type="submit">Salvar</button>
        </p>


    </form>
</body>
</html>