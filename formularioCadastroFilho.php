<?php
require 'conexao.php';

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
        <h2>Cadastro de Filho</h2>
        <br>
        <form action="cadFilho.php" method="post">
		     <label for="nome">Nome Funcionario: </label>
            <input type="text" name="nomeFuncionario" id="nomeFuncionario"><br><br>
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome">
            <br><br> 
			<label for="dataNascimento">Data de Nascimento: </label>
			<input type="text" name="calendario" id="calendario" /></p>		
			</table> </p>
            <input type="submit" value="Salvar">
			<input type="submit" value="Cancelar">
        </form>
    </body>
</html>