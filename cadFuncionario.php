<?php
require_once 'conexao.php';
// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$dataNascimento = isset($_POST['calendario']) ? $_POST['calendario'] : null;
$salario = isset($_POST['salario']) ? $_POST['salario'] : null;
$atividades = isset($_POST['atividades']) ? $_POST['atividades'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($nome) )
{
    echo "Gentileza preencher todos os campos";
    exit;
}

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO funcionario(Nome, DataNascimento, Salario, Atividades) VALUES(:nome, :dataNascimento , :salario ,:atividades)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':dataNascimento', $dataNascimento);
$stmt->bindParam(':salario', $salario);
$stmt->bindParam(':atividades', $atividades);

if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}