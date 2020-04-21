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
$sql = "SELECT * FROM funcionario WHERE codFuncionario = $codigo";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
$stmt->execute();
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

 //criando a query de consulta à tabela criada 
$sqlConsultaFilho = mysqli_query($cx, "SELECT * FROM funcionariofilho WHERE codFuncionario = $codigo") or die( 
  mysqli_error($cx) //caso haja um erro na consulta 
);


// se o método fetch() não retornar um array, significa que o codigo não corresponde a um usuário válido
if (!is_array($funcionario))
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
        <h2>Editar Funcionario</h2>
        <br>
        <form action="update.php?codigo=<?php echo $codigo ?>>
            <label for="nome">Nome: </label>
			<input type="text" name="nome" id="nome" value="<?php echo $funcionario['Nome'] ?>">
            <br><br> 
			<label for="dataNascimento">Data de Nascimento: </label>
			<input type="text" name="calendario" id="calendario" value="<?php echo $funcionario['DataNascimento'] ?>">
			<br><br> 
			<label for="salario">Salario: </label>
			<input type="text" name="salario" id="salario" value="<?php echo $funcionario['Salario'] ?>">
			<br><br> 
			<label for ="atividades">Atividades: </label>
			<textarea cols=60 id="atividades" rows="10" name="atividades" ><?php echo $funcionario['Atividades'] ?></textarea> <br> <br>
        <table width="50%" border="1">
            <thead>
                <tr>
					<th>Nome</th>
					<th>Data Nascimento</th>
					<th>Editar</th>
                    <th>Excluir</th>
					
                </tr>
            </thead>
            <tbody>
               
                <tr><?php
					//pecorrendo os registros da consulta. 
					while($auxFilho = mysqli_fetch_assoc($sqlConsultaFilho)) {  ?>
					
					 <tr>
					  <th> <?php echo $auxFilho["Nome"]."<br />"; ?> </th>
					  <th> <?php echo $auxFilho["DataDeNascimento"]."<br />"; ?> </th><p>
					 <th> <a href="editarFilho.php?codigo=<?php echo $auxFilho['CodFuncionarioFilho'] ?>">Editar</a></th>
					<th> <a href="excluirFilho.php?codigo=<?php echo $auxFilho['CodFuncionarioFilho'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a><?php }?>
					</tr>
                </tr>
    
            </tbody>
        </table>
			<p><a href="formularioCadastroFilho.php">Novo Filho</a></p>
            <input type="hidden" name="id" value="<?php echo $codigo ?>">
            <input type="submit" value="Alterar">
			<form>
				<a href="principal.php"><input type="button"value="Voltar"></a>
			</form>
        </form>
    </body>
</html>