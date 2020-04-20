<?php
require_once 'conexao.php';
// pega o codigo da URL
$codigoFuncionarioFilho = isset($_GET['id']) ? $_GET['id'] : null;
$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
$DataDeNascimento = isset($_GET['calendario']) ? $_GET['calendario'] : null;



// validação (bem simples)
if (empty($nome) || empty($DataDeNascimento) )
{
    echo "Volte e preencha todos os campos";
    exit;
}

// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE funcionariofilho SET nome = :nome, DataDeNascimento = :DataDeNascimento WHERE CodFuncionarioFilho =:codigoFuncionarioFilho";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigoFuncionarioFilho', $codigoFuncionarioFilho);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':DataDeNascimento', $DataDeNascimento);

if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}