<?php
	require("iniSis.php");

	$conn = mysql_connect(HOST,USER,PASS)or die("Erro ao conectar! ".mysql_error());
	/*if($conn){
		echo "Conectado com o BD com sucesso!<br>";
	}*/

	//seleciona o banco de dados
	$db = mysql_select_db(DB)or die("Erro ao selecionar o BD! ".mysql_error());


	/****FUNÇÃO CADASTRO NO BANCO****/
	function insert($tabela, array $dados){
		$fields = implode(", ", array_keys($dados));
		$values = "'".implode("', '", array_values($dados))."'";
		/*echo "<pre>";
		print_r($values);*/

		//{} serve para inserir a variável da TABELA e WHERE
		//() serve para inserir as variáveis CAMPOS e VALORES da tabela
		$queryInsert = "insert into {$tabela} ($fields) values ($values)";
		$executeInsert = mysql_query($queryInsert)or die("Erro ao cadastrar! Função insert() ".mysql_error());
		//echo "Cadastro realizado com sucesso!<br>";

		return true;
	}

	/*$dados = array(
		"nome"=>"Hello",
		"sobrenome"=>"World",
		"email"=>"ola@yahoo.com.br",
		"username"=>"hello4",
		"senha"=>"12kj5555555",
		"data"=>date('Y-m-d H:i:s')
		);*/

	//create("cadastro",$dados);


	/****ATUALIZACAO DO BANCO****/
	function update($tabela, array $dado, $condicao){ //na $condicao colocar WHERE
		foreach($dado as $keys => $values){
			$campos[] = "$keys = '$values'";
		}
		$campos = implode(", ", $campos);
		$queryUpdate = "update {$tabela} set $campos {$condicao}";
		$executeUpdate = mysql_query($queryUpdate)or die("Erro ao atualizar o BD! ".mysql_error());
		
		//echo "Banco atualizado com sucesso!<br>";
		
		return true;
	}

	
	/****FUNÇÃO LOGIN****/
	function login($tabela, $username, $password){
		$queryRead = "select*from {$tabela} where username = '$username' and senha = $password;";
		$executeRead = mysql_query($queryRead)or die("Erro ao ler! ".mysql_error());
		
		
		$colunas = mysql_num_fields($executeRead); //recebe a qtd de colunas da tabela
		//$linhas = mysql_num_rows($executeRead);

		for($i = 0; $i < $colunas; $i++){
			$camposColuna[$i] = mysql_field_name($executeRead, $i);
			echo $camposColuna[$i]."<br>"; //debug
		}
		echo "<hr>";
		for($j = 0; $res = mysql_fetch_assoc($executeRead); $j++){
			print_r($res); 
			for($k = 0; $k < $colunas; $k++){
				$resultado[$j][$camposColuna[$k]] = $res[$camposColuna[$k]]."<br>";
			}
		}
		
		return $resultado;
	}

	/****FUNCAO LÊ BD****/
	function read2($tabela, $condicao){
		$queryRead = "select*from {$tabela} {$condicao}";
		$executeRead = mysql_query($queryRead)or die("Erro ao ler! Função read2() ".mysql_error());

		$linhas= mysql_num_rows($executeRead);

		if($linhas > 0){
			return true;
		}else{
			return false;
		}
	}

	function select($tabela, $condicao){
		$querysel = "select * from {$tabela} {$condicao}";
		$executesel = mysql_query($querysel)or die("Erro ao ler! Função read2() ".mysql_error());
	    $linhas= mysql_fetch_array($executesel);
	    $nome = $linhas['nome'];
	    return $nome;

	}

	/****FUNCAO QUE VERIFICA SE O EMAIL JA EXISTE****/
	//verifica se existe email
	function emailExists($tabela, $email){
		$query = "select email from {$tabela} where email = '$email'";
		$result = mysql_query($query)or die("Erro! Função emailExists() ".mysql_error());

		if(mysql_num_rows($result) > 0)
			return true; //email existe
		else
			return false;
	}

	/****FUNCAO QUE VERIFICA SE O USERNAME JA EXISTE****/
	//verifica username
	function usernameExists($tabela, $username){
		$query = "select username from {$tabela} where username = '$username'";
		$result = mysql_query($query)or die(mysql_error());

		if(mysql_num_rows($result) > 0)
			return true; //username ja existe
		else
			return false;
	}

	/****CRIPTOGRAFA A SENHA****/
	//criptografar senha
	function cryptPassword($password){
		//return sha1($password);
		return md5($password);
	}


	/****FUNÇÃO 2 CADASTRO NO BANCO --> usa a funcao para criptografar a senha****/ 
	function insert2($tabela, $nome, $sobrenome, $email, $username, $senha, $data){
		$senha = cryptPassword($senha); //ira criptografar a senha --> TÁ COLOCANDO A MSM SENHA CRIPTOGRAFADA!

		//{} serve para inserir a variável da TABELA e WHERE
		//() serve para inserir as variáveis CAMPOS e VALORES da tabela
		$queryInsert = "insert into {$tabela} (nome,sobrenome,email,username,senha,data) values ('$nome','$sobrenome','$email',
			'$username','$senha','$data')";
		$executeInsert = mysql_query($queryInsert)or die("Erro ao cadastrar! Função insert() ".mysql_error());
	
		return true;
	}

?>
