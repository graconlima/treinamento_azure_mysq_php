<?php

echo 
"<html>
<head>
<style media='screen'>
*,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
label{
    color: white;
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
</style>
</head>
<body>
<label for='log'>
";

//$e = "172.18.0.1:3306";
//$u = "root";
//$s = "senha2";

$e = $_POST['url'];
$u = $_POST['usuario'];
$s = $_POST['senha'];

//passo 1: conexao
$conn = new mysqli($e, $u, $s);
if($con->connect_error){
        die("Falha na conexao a $e.");
}else{
        echo "Conectado com sucesso a $e <br/>";
}

//passo 2: criar BD
$bd = "bd";
$sql = "CREATE DATABASE IF NOT EXISTS $bd";

if($conn->query($sql) === TRUE){
	echo "Banco de dados pronto!<br>";
}else{
	die("Problema na criacao do BD...");
}
$conn->close();

//passo 3: criar tabela
$tabela = "pessoa";
$sql = "CREATE TABLE IF NOT EXISTS $tabela(id INT AUTO_INCREMENT PRIMARY KEY, nome varchar(100))";

$conn = new mysqli($e, $u, $s, $bd);
if($conn->query($sql) === TRUE){
	echo "$tabela criada com sucesso.<br/>";
}else{
	echo "$tabela nao criada.<br/>";
}

//passo 4: inserindo dados
$sql = "INSERT INTO $tabela VALUES(NULL, 'JOAO')";

if($conn->query($sql) === TRUE){
	echo "Nova entrada em $tabela inserida com sucesso <br/>";
}else{
	echo "Nao foi possivel inserir dados em $tabela<br/>";
}

//passo 5: realizando consulta
$sql = "SELECT * FROM $tabela";
$r = $conn->query($sql);
if($r->num_rows > 0){
	while($l = $r->fetch_assoc()){
		echo "id: ".$l["id"].", nome: ".$l["nome"]."<br/>";
	}
}else{
	echo "Sem valores<br/>";
}

$conn->close();

echo "</label></body></html>";
?>

