<?php
include("conn.php");

$id = $_GET["id"] ?? 0;
$dt_saida2 = $_GET["dt_saida"];
$valorPagar = $_GET["valor"] ?? 0;
$tipo_pgto = $_GET["tipo_pgto"];
$observ = $_GET["observacoes"];

$valorPagar = str_replace(["R$", ".", ","], ["", "", "."], $valorPagar);
echo $valorPagar;

// str_replace - serve para substituir caracteres em uma string. No caso, ele está removendo o "R$", 
// os pontos e substituindo a vírgula por ponto, para que o valor possa ser armazenado corretamente no 
// banco de dados como um número decimal.

$sql = "UPDATE estacionamento 
SET dt_saida='$dt_saida2',
valor=$valorPagar, 
tipo_pgto_id=$tipo_pgto, 
observacoes='$observ' 
WHERE id='$id'"; 

if($conn->query($sql)) {    
    header("location: index.php");
}


// $dt_saida1 = new DateTime();
// $dt_form = $dt_saida1->format('Y-m-d H:i');


// -- SET dt_saida='$dt_form',
