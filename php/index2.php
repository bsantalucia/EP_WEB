<meta charset="utf-8">

<?php
	session_start();
	date_default_timezone_set("Brazil/East");
	require("dbaSis.php");
	$tabela = "cadastro";

	$_SESSION["username"] = $username;
	$nome = select($tabela, "where username = '$username';");
	//$nome = $linhas['nome'];

	//$readPass = read2($tabela, "where senha = '$autenticaPassword'");
	//if($readUser){
		//echo "usuario Ok<br>"; //imprime que username esta correto
	//	}
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Cubos</title>
		<meta charset="utf-8">
		<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Carme' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="login">
			<ul>
					
			</ul>
		</div>
		<div id="logo">
			<img src="../images/logo.png" alt="Logo" width="1024px" height="230px" >	
		</div>
		<div id="menu">
			<ul>
				<li><a href="../php/index2.php">Home</a></li>
				<li><a href="../jogos/jogos2.html">Jogos</a></li>
				<li><a href="../sobre2.html">Sobre</a></li>
				<li><a href="../contato2.html">Contato</a></li>
			</ul>
		</div>
		<div id="conteudo">
			<div id="conteudo_home">
		<form name = 'form' action = '' method = 'post'> <!--IMPORTANTE colocar o method! -->
		</form>
				<h2>Bem Vindo(a) <?php echo $nome; ?>!</h2>
				<p>
					Você acaba de entrar no maravilhoso mundo de Cubo Games! Onde os melhores jogos estão. Divirta-se com o 
					Jogo da Memória do Sr. Panda! Encontre os mais diversos animais! Encontre todos os pares antes que o 
					tempo acabe!
			</div>
		</div>
	</body>
</html>
