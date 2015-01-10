<meta charset="utf-8">

<?php
	session_start();
	date_default_timezone_set("Brazil/East");
	require("dbaSis.php");

	$tabela = "cadastro";

	if(isset($_POST['sendLogin'])){
		$f["username"] = mysql_real_escape_string($_POST["usuario"]);
		$f["password"] = mysql_real_escape_string($_POST["senha"]);

		$_SESSION["username"] = $f["username"];
		/*echo "<pre>";
		print_r($f);
		echo "</pre>";*/

		/*autentica primeiro o username, depois a senha*/
		$autenticaUsername = $f["username"];
		$autenticaPassword = $f["password"];
		$readUser = read2($tabela, "where username = '$autenticaUsername'");
		$readPass = read2($tabela, "where senha = '$autenticaPassword'");
		if($readUser){
			//echo "usuario Ok<br>"; //imprime que username esta correto
			if($readPass){
				//echo "senha Ok<br>"; //imprime que a senha esta correta
				header("Location: ../php/index2.php");
			}
			else{
				//echo "<span>Senha incorreta!</span>";
				echo "<script>alert('Senha incorreta!')</script>"; //mostra uma janela de alerta (javascsript)
			}
		}else{
			//echo "<span>Erro! Usuário não existe</span>";
			echo "<script>alert('Usuário não existe!')</script>"; //mostra uma janela de alerta (javascsript)
		}
	}
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="../css/login.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Carme' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="login">
			<ul>
				<li><a href="login.php">LOGIN</a></li>
				<li><a href="login_cadastro.php">CADASTRE-SE</a></li>	
			</ul>
		</div>
		<div id="logo">
			<img src="../images/logo.png" alt="Logo" width="1024px" height="230px" >	
		</div>
		<!--menu-->
		<div id="menu">
			<ul>
				<li><a href="../index.html">Home</a></li>
				<li><a href="../jogos/jogos.html">Jogos</a></li>
				<li><a href="../sobre.html">Sobre</a></li>
				<li><a href="../contato.html">Contato</a></li>
			</ul>
		</div><!--fim menu-->
		<!--formularios ->editar no "login.css"-->
		<div id="identificacao">
			<h1>Identificação</h1>
			<fieldset id="field1">
				<h3>Já possuo cadastro</h3>
				<form name = 'form' action = '' method = 'post'> <!--IMPORTANTE colocar o method! -->
					<label>Usuário:</label><br>
					<input type="text" value="" name="usuario" size = '40'maxlength='20' required/>
					<br><br>
					<label>Senha:</label><br>
					<input type="password" value="" name="senha" size = '40' maxlength='6' required/>
					<br>
					<p><a href="#">Esqueci minha senha</a></p>
					<br>
					<input id="enviar" type="submit" value="Entrar" name="sendLogin">
				</form>
			</fieldset>
			<fieldset id="field2">
				<h3>Ainda não possuo cadastro</h3>
			</fieldset>
		</div>
	</body>
</html>
