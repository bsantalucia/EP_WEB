<meta charset="utf-8">

<?php

	/****VALIDACAO DOS CAMPOS****/
	$valida = true; //só irá inseiri no BD se esssa variável for TRUE
	$name = $lastname = $email = $username = $password = $confirmaPassword = $data = "";
	$nameErr = $lastnameErr = $emailErr = $usernameErr = $passwordErr = "";

	function validaEntrada($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	/****BANCO DE DADOS****/
	require("dbaSis.php");
	
	date_default_timezone_set("Brazil/East");

	$tabela = "cadastro";

	if(isset($_POST["send"])){

		/*valida os campos*/
		$name = validaEntrada($_POST["nome"]);
		if(!preg_match("/^[a-zA-Z ]*$/", $name)){
			$nameErr = "Somente letras ou espaços em branco são permitidos";
			$valida = false;
		}

		$lastname = validaEntrada($_POST["sobrenome"]);
		if(!preg_match("/^[a-zA-Z ]*$/", $lastname)){
			$lastnameErr = "Somente letras ou espaços em branco são permitidos";
			$valida = false;
		}

		$email = $_POST["email"];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // filter_var é uma função nativa do PHP
			$emailErr = "Formato de e-mail inválido";
			$valida = false;
		}
		if(emailExists($tabela, $email)){ //email ja existente!
			$emailErr = "Este e-mail já está cadastrado";
			$valida = false;
		}

		$username = $_POST["username"];
		if(usernameExists($tabela, $username)){ //username ja existente!
			$usernameErr = "Username já cadastrado";
			$valida = false;
		}

		$passowrd = $_POST["senha"];
		$confirmaPassword = $_POST["confirma"];
		if($confirmaPassword != $passowrd){ //confirma a senha
			$passwordErr = "Senha não confere";
			$valida = false;
		}

		else if($valida){
			$dados = array(
			"nome"=>$_POST["nome"],
			"sobrenome"=>$_POST["sobrenome"],
			"email"=>$_POST["email"],
			"username"=>$_POST["username"],
			"senha"=>$_POST["senha"],
			"data"=>date("Y-m-d H:i:s")
			);

			insert($tabela, $dados);
			header("Location: ../cadastroSucesso.html");
		}
	
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<meta charset='utf-8'>
	<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../css/login_cadastro.css" rel="stylesheet" type="text/css" media="screen" />
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
	<div id="menu">
		<ul>
			<li><a href="../index.html">Home</a></li>
			<li><a href="../jogos/jogos.html">Jogos</a></li>
			<li><a href="../sobre.html">Sobre</a></li>
			<li><a href="../contato.html">Contato</a></li>
		</ul>
	</div>
	<div id="cadastro">
		<h3>Faça seu cadastro para começar a jogar!</h3>
		<fieldset id="fieldset">
		<span class="error">* Campos obrigatórios</span><br><br>
		<form name='form' action="" method='post'>
			<label>Nome:</label><br>
			<input type='text' name='nome'  value = "<?php echo $name;?>" maxlength='50' size = '40' autofocus required/>
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>
			<label>Sobrenome:</label><br>
			<input type='text' name='sobrenome' value = "<?php echo $lastname;?>" maxlength='100' size = '40' required/>
			<span class="error">* <?php echo $lastnameErr;?></span></span>
			<br><br>
			<label>E-mail:</label><br>
			<input type='text' name='email'  value = "<?php echo $email;?>" maxlength='50' size = '40' required/>
			<span class="error">* <?php echo $emailErr;?></span>
			<br><br>
			<label>Username:</label><br>
			<input type='text' name='username' value = "<?php echo $username;?>" maxlength='20' size = '40' required/>
			<span class="error">* </span>
			<br><br>
			<label>Senha:</label><br>
			<input type='password' name='senha'  maxlength='6' required/>
			<br><br>
			<label>Confirme sua Senha:</label><br>
			<input type='password' name='confirma'  maxlength='6' required/>
			<span class="error">* <?php echo $passwordErr; ?></span>
			<br><br><br>
			<input id="enviar" type='submit' value='Finalizar Cadastro' name='send' required/>
		</form>
	</fieldset>
	</div><!--fim cadastro-->
</body>
</html>
