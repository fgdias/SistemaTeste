<?php
require_once 'init.php';
// pega os dados do formuário
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
$ator = isset($_POST['ator']) ? $_POST['ator'] : null;
$diretor = isset($_POST['diretor']) ? $_POST['diretor'] : null;
$imagem = isset($_POST['imagem']) ? $_POST['imagem'] : null;

// validação (bem simples, só pra evitar dados vazios)
if (empty($titulo) || empty($descricao) || empty($categoria) || empty($ator) || empty($diretor)  )
{
    echo "Volte e preencha todos os campos";
    exit;
}

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO topfilmes(titulo, descricao, categoria,ator,diretor) VALUES(:titulo, :descricao, :categoria, :ator, :diretor)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':ator', $ator);
$stmt->bindParam(':diretor', $diretor);

if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}