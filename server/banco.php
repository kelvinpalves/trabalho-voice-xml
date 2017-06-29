<?php 

function atualizarPessoaPorNome($conn, $nome, $salario, $liquido) {
	try {
		$stmt = $conn->prepare("UPDATE pessoa SET bruto = ?, liquido = ? where nome = ?");
		return $stmt->execute(array($salario, $liquido, $nome));
	} catch(PDOException $ex) {
		print_r($ex);
		return null;
	}		
}

function buscarPessoas($conn) {
	try {
		$stmt = $conn->query("SELECT nome FROM pessoa");
		$array = $stmt->fetchAll();

		return $array;
	} catch(PDOException $ex) {
		print_r($ex);
		return null;
	}
}

function buscarPessoaPorNome($conn, $nome) {
	try {
		$stmt = $conn->prepare("SELECT nome FROM pessoa where nome = ?");
		$stmt->execute(array($nome));
		return $stmt->fetchAll();
	} catch(PDOException $ex) {
		print_r($ex);
		return null;
	}	
}

function conectar() {

	$host    = 'localhost';
	$nome    = $_SERVER['SERVER_NAME'] === 'localhost' ? 'voice' : 'forge821_unisc';
	$usuario = $_SERVER['SERVER_NAME'] === 'localhost' ? 'root' : 'forge821_teste';
	$senha   = $_SERVER['SERVER_NAME'] === 'localhost' ? '78981' : 'teste';

	return new PDO("mysql:host=$host;dbname=$nome", $usuario, $senha);	
}