<?php
require_once 'conexao.php';
//iniciando a conexão com o banco de dados 
$cx = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

//selecionando o banco de dados 
$db = mysqli_select_db($cx, DB_NAME);
// pega o codigo da URL
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
$numFilho = isset($_GET['resultadoFilho']) ? $_GET['resultadoFilho'] : null;

if ($numFilho > 0 )
{
    echo "Volte e exclua os filhos do funcionario primeiro";?>
	<input type="button" value="Voltar" onClick="history.go(-1)"> <?php
	
}else 
{
// remove do banco
$PDO = db_connect();
$sql = "DELETE FROM funcionario WHERE codFuncionario = $codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $CodFuncionario, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: principal.php');
}
else
{
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}
}