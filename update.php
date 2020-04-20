<?php
require_once 'conexao.php';
// pega o codigo da URL
$codigoFuncionario = isset($_GET['id']) ? $_GET['id'] : null;
$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
$DataNascimento = isset($_GET['calendario']) ? $_GET['calendario'] : null;
$salario = isset($_GET['salario']) ? $_GET['salario'] : null;
$atividades = isset($_GET['atividades']) ? $_GET['atividades'] : null;
// validação
if (empty($nome) || empty($DataNascimento) || empty($salario) || empty($atividades) )
{
    echo "Volte e preencha todos os campos";
    exit;
}

// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE funcionario SET nome = :nome, DataNascimento = :DataNascimento, salario = :salario, atividades = :atividades WHERE CodFuncionario = :codigoFuncionario";
echo $sql;
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':DataNascimento', $DataNascimento);
$stmt->bindParam(':salario', $salario);
$stmt->bindParam(':atividades', $atividades);

$stmt->bindParam(':codigoFuncionario', $codigoFuncionario, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}