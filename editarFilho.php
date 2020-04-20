<?php
require_once 'conexao.php';
// pega o codigo da URL
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

//iniciando a conexão com o banco de dados 
$cx = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

//selecionando o banco de dados 
$db = mysqli_select_db($cx, DB_NAME);

// pega o ID da URL
$codigo = isset($_GET['codigo']) ? (int) $_GET['codigo'] : null;//


// busca os dados dos filmes o a ser editado
$PDO = db_connect();
$sql = "SELECT * FROM funcionariofilho WHERE CodFuncionarioFilho = $codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$stmt->execute();
$Filhofuncionario = $stmt->fetch(PDO::FETCH_ASSOC);

// se o método fetch() não retornar um array, significa que o codigo não corresponde a um usuário válido
if (!is_array($Filhofuncionario))
{
    echo "Nenhum funcionario encontrado";
    exit;
}
?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sistema Teste </title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
		<script>
			$(function() {
				$( "#calendario" ).datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: 'yy-mm-dd',
					dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
					dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
					dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
					monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
					monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
				});
		});
	</script>
    </head>
    <body>
        <h1>Sistema Teste </h1>
        <h2>Editar Filho</h2>
        <br>
        <form action="updateFilho.php?codigo=<?php echo $codigo ?>>
            <label for="nome">Nome: </label>
			<input type="text" name="nome" id="nome" value="<?php echo $Filhofuncionario['Nome'] ?>">
            <br><br> 
			<label for="dataNascimento">Data de Nascimento: </label>
			<input type="text" name="calendario" id="calendario" value="<?php echo $Filhofuncionario['DataDeNascimento'] ?>">
			<br><br> 
            <input type="hidden" name="id" value="<?php echo $codigo ?>">
            <input type="submit" value="Alterar">
        </form>
    </body>
</html>