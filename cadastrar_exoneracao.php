<?php
    if(count($_POST)>0){

        $erro=false;

        include('conexao.php');

        $siape=$_POST['siape'];
        $nome=$_POST['nome'];
        $exercicio=$_POST['exercicio'];
        $exoneracao=$_POST['exoneracao'];
        $remuneracao=$_POST['remuneracao'];

        if(empty($siape)){
            $erro="Número SIAPE obrigatório!";
        }
        if(empty($nome)){
            $erro="Preencha o nome completo.";
        }
    
        if(!empty($exercicio)){
            $dataMatriz=explode('/',$exercicio);
            if(count($dataMatriz)==3){
                $exercicio=implode('-',array_reverse($dataMatriz));
            }else{
                $erro="A data de exoneração deve ser no padrão dia/mês/ano.";
            }
    
        }
        if(!empty($exoneracao)){
            $dataMatriz=explode('/',$exoneracao);
            if(count($dataMatriz)==3){
                $exoneracao=implode('-',array_reverse($dataMatriz));
            }else{
                $erro="A data de exoneração deve ser no padrão dia/mês/ano.";
            }
        }

        if(empty($remuneracao)){
            $erro="Preencha a remuneração.";
        }else{
            $remuneracao=str_replace(',','.',$remuneracao);
        }

        if($erro){
            echo "<p><b> ERRO: $erro</b></p>";
        }else{
            $sql_code="INSERT INTO servidor_exonerado(siape,nome,exercicio,exoneracao,remuneracao) VALUES('$siape','$nome','$exercicio','$exoneracao','$remuneracao')";

            $deu_certo=$mysqli->query($sql_code) or die($mysqli->error);

            if($deu_certo){
                echo "<p>Exoneração cadastrada!</p>";
                unset($_POST);
            }
        }

        
    }

   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Exoneração de Servidor</title>
</head>
<body >
    <a href="servidores_exonerados.php">Lista de Exonerações</a>
    <form method="POST" action="">

        <p>
            <label>SIAPE: </label>
            <input value="<?php if(isset($_POST['siape'])) echo $_POST['siape']; ?>" name="siape" type="text"><br>
        </p>
        <p>
            <label>Nome: </label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text"><br>
        </p>
        <p>
            <label>Data de Efetivo Exercício: </label>
            <input value="<?php if(isset($_POST['exercicio'])) echo $_POST['exercicio']; ?>"name="exercicio" type="text"><br>
        </p>
        <p>
            <label>Data da Exoneração: </label>
            <input value="<?php if(isset($_POST['exoneracao'])) echo $_POST['exoneracao']; ?>" name="exoneracao" type="text"><br>
        </p>
        <p>
            <label>Remuneração: </label>
            <input value="<?php if(isset($_POST['remuneracao'])) echo $_POST['remuneracao']; ?>" name="remuneracao" type="text"><br>
        </p>
        <p>
            <button  type="submit">Salvar Exoneração</button>
        </p>

    </form>
    
</body>
</html>