<?php 
$hostname = "localhost";
$bancodedados = "aws_bd";
$usuario = "root";
$senha = "";


$conn = new mysqli($hostname, $usuario, $senha, $bancodedados);   

if ($conn->connect_error) {
    echo"Erro ao Conectar ao Banco mano :/ :". $conn->connect_error ."";
    exit();
}
?>