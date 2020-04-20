<?php

require_once 'conexao.php';
//iniciando a conexão com o banco de dados 
$cx = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);

//selecionando o banco de dados 
$db = mysqli_select_db($cx, DB_NAME);


$nomeFuncionario = isset($_POST['nomeFuncionario']) ? $_POST['nomeFuncionario'] : null;

if(array_key_exists('pesquisar', $_POST)) {
	$pesquisar = $_POST['pesquisar'];
} else {
    $pesquisar = "%%";
}

//criando a query de consulta à tabela criada 
$sql = mysqli_query($cx, "SELECT * FROM funcionario where nome LIKE '%$pesquisar%' ") or die( 
  mysqli_error($cx) //caso haja um erro na consulta 
);
?>
 
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SISTEMA TESTE </title>
    </head>
    <body>
        
        <h1>SISTEMA TESTE </h1>
			<form method="POST" action="consultaFuncionario.php">
				Nome Funcionario:<input type="text" name="pesquisar">
				<input type="submit" value="ENVIAR">
			</form>
		     
        <table width="50%" border="1">
            <thead>
                <tr>
			
					<th>Codigo Funcionario</th>
					<th>Nome</th>
					<th>Data Nascimento</th>
					<th>Numero de Filho</th>
					<th>Editar</th>
                    <th>Excluir</th>
					
                </tr>
            </thead>
            <tbody>
               
                <tr><?php
						//pecorrendo os registros da consulta. 
						while($aux = mysqli_fetch_assoc($sql)) { 
							$codigoFuncionario = $aux["CodFuncionario"]; 
							//Filho - Somar a quantidade de filhos por funcionario
							$result_filho = "SELECT COUNT(nome) AS num_result FROM funcionariofilho where CodFuncionario = $codigoFuncionario";
							$resultado_filho = mysqli_query($cx, $result_filho);
							$row_filho = mysqli_fetch_assoc($resultado_filho);
					?>
					<tr>
					<th> <?php echo $aux["CodFuncionario"]."<br />"; ?> </th>
					<th> <?php echo $aux["Nome"]."<br />"; ?> </th>
					<th> <?php echo $aux["DataNascimento"]."<br />"; ?> </th>
					<th> <?php echo $row_filho['num_result']."<br />"; ?> </th><p>
					<th> <a href="editar.php?codigo=<?php echo $aux['CodFuncionario'] ?>">Editar</a></th>
					<th> <a href="excluir.php?codigo=<?php echo $aux['CodFuncionario'] ?>&resultadoFilho=<?php echo $row_filho['num_result'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a><?php }?>
					</tr>
                </tr>
    
            </tbody>
        </table>
                           <td>
						   	 <p><a href="formularioCadastro.php">Adicionar Funcionario</a></p>
							 <p><a href="principal.php">Voltar</a></p>
                       
                    </td>
 
    </body>
</html>