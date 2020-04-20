<?php
require_once 'conexao.php';
//iniciando a conexão com o banco de dados 
$cx = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

//selecionando o banco de dados 
$db = mysqli_select_db($cx, DB_NAME);


// pega os dados do formuário
$nomeFuncionario = isset($_POST['nomeFuncionario']) ? $_POST['nomeFuncionario'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$DataDeNascimento = isset($_POST['calendario']) ? $_POST['calendario'] : null;
$CodFuncionario = isset($_POST['CodFuncionario']) ? $_POST['CodFuncionario'] : null;


// validação (bem simples, só pra evitar dados vazios)
if (empty($nome) )
{
    echo "Gentileza preencher todos os campos";
    exit;
}
// Consultar o banco
$PDO = db_connect();
$nome = $_POST['nome'];
$resulCodFunc = "SELECT CodFuncionario as codFuncionario FROM funcionario where nome LIKE '%$nomeFuncionario%' ";
$resultado_codFuncionario = mysqli_query($cx, $resulCodFunc);
$resultado_codFuncionario = mysqli_query($cx, $resulCodFunc);
$codFunc = mysqli_fetch_assoc($resultado_codFuncionario);
$codFuncionario = $codFunc['codFuncionario'];

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO funcionarioFilho(CodFuncionario, Nome, DataDeNascimento) VALUES($codFuncionario, :nome, :DataDeNascimento)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':DataDeNascimento', $DataDeNascimento);


if ($stmt->execute())
{
    header('Location: formularioCadastro.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}