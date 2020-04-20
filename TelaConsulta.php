<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "sistemateste";
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	$pesquisar = $_POST['pesquisar'];
	$result_cursos = "SELECT * FROM funcionario WHERE Nome LIKE '%$pesquisar%'";
	$resultado_cursos = mysqli_query($conn, $result_cursos);
	
	while($rows_cursos = mysqli_fetch_array($resultado_cursos)){?>
					<?php echo $rows_cursos["CodFuncionario"].""; ?> 
					<?php echo $rows_cursos["Nome"].""; ?> 
					<?php echo $rows_cursos["DataNascimento"]."<br />"; ?>
					<?php
		
	}
?>