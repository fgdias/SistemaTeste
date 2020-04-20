<?php
require_once 'init.php';
// pega o codigo da URL
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

// remove do banco
$PDO = db_connect();
$sql = "DELETE FROM topfilmes WHERE codigo = :codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}