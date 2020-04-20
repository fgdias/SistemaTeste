<?php
//iniciando a conexão com o banco de dados 
$cx = mysqli_connect("localhost", "root", "");

//selecionando o banco de dados 
$db = mysqli_select_db($cx, "sistemateste");
 
 //criando a query de consulta à tabela criada 
$sql = mysqli_query($cx, "SELECT * FROM funcionario") or die( 
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
        
        <h1>Meu top 10 filmes </h1>
        
	
		  
    
        <table width="50%" border="1">
            <thead>
                <tr>
			
					<th>Codigo Funcionario</th>
					<th>Nome</th>
					<th>Data Nascimento</th>
					<th>Editar</th>
                    <th>Excluir</th>
					
                </tr>
            </thead>
            <tbody>
               
                <tr><?php
					//pecorrendo os registros da consulta. 
					while($aux = mysqli_fetch_assoc($sql)) { ?>
					 <tr>
			
					 <th> <?php echo $aux["CodFuncionario"]."<br />"; ?> </th>
					 <th> <?php echo $aux["Nome"]."<br />"; ?> </th>
					  <th> <?php echo $aux["DataNascimento"]."<br />"; ?> </th><p>
					 <th> <a href="form-edit.php?codigo=<?php echo $aux['codigo'] ?>">Editar</a></th>
					<th> <a href="delete.php?codigo=<?php echo $aux['codigo'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a><?php }?>
					</tr>
                </tr>
    
            </tbody>
        </table>
                           <td>
						   	 <p><a href="form-add.php">Adicionar Filme</a></p>
                       
                    </td>
 
    </body>
</html>