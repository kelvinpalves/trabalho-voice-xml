<?php

$dadosValidos = isset($_REQUEST['nomeBanco']) && strlen(trim($_REQUEST['nomeBanco'])) > 0;
$dadosValidos = isset($_REQUEST['salario']) && strlen(trim($_REQUEST['salario'])) > 0 && $dadosValidos;
$dadosValidos = isset($_REQUEST['salarioLiquido']) && strlen(trim($_REQUEST['salarioLiquido'])) > 0 && $dadosValidos;

if ($dadosValidos) {
	$nome           = $_REQUEST["nomeBanco"];
	$salario        = $_REQUEST["salario"];
	$salarioLiquido = $_REQUEST["salarioLiquido"];

	require_once('banco.php');

	$conn    = conectar();
	$retorno = buscarPessoaPorNome($conn, $nome);
	$strRetorno = '';

	if (count($retorno) > 0) {
		if (atualizarPessoaPorNome($conn, $nome, $salario, $salarioLiquido)) {
			$strRetorno = 'A pessoa informada foi ' . $nome . ', seu salário bruto é ' . $salario . ' reais e seu salário líquido é ' . $salarioLiquido . ' reais';
		} else {
			$strRetorno = 'Ocorreu um erro ao atualizar a pessoa.';
		}
	} else {
		$strRetorno = 'O nome informado não foi encontrado no banco de dados.';
	}

} else {
	$strRetorno = 'Ocorreu um erro ao efetuar a operação.';
}

print ('<vxml version="2.1" xml:lang="pt-BR">');
print ('  <form id="teste">');
print ('     <block>');
print ('    	<prompt>');
print ($strRetorno);
print ('    	</prompt>');
print ('    </block>');
print ('  </form>');
print ('</vxml>');

?>