<?php

$host="localhost";
$db="crud_servidores";
$user="root";
$pass="";

$mysqli=new mysqli($host,$user,$pass,$db);

if($mysqli->connect_errno){
    die("Falha na conexão com o banco de dados!");
}

function formata_data($data){
     
    return implode('/', array_reverse(explode('-',$data)));
     
 }
 

?>