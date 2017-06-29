<?php

require ('banco.php');

$nomes = buscarPessoas(conectar());

print ('<?xml version="1.0" encoding="UTF-8"?>');
print ('<vxml version = "2.1" xml:lang="pt-BR">');
print ("<script> 
		<![CDATA[
			function calcularDescontoINSS(salario) {
				var ALIQUOTA_08 = {de: 0, ate: 1659.38};
				var ALIQUOTA_09 = {de: 1659.39, ate: 2765.66};
				var ALIQUOTA_11 = {de: 2765.67, ate: 5531.31};
				var TETO        = 5531.31;
 
				if (salario >= ALIQUOTA_08.de && salario <= ALIQUOTA_08.ate) {
				  return salario - (salario * 0.08);
				} else if (salario >= ALIQUOTA_09.de && salario <= ALIQUOTA_09.ate) {
				  return salario - (salario * 0.09);
				} else if (salario >= ALIQUOTA_11.de && salario <= ALIQUOTA_11.ate) {
				  return salario - (salario * 0.11);
				} else {
				  return salario - (TETO * 0.11);
				}
			}

			function calcularDescontoIRRF(salario) {
				var ALIQUOTA_00	= {de: 0, ate: 1903.98};
				var ALIQUOTA_07	= {de: 1903.99, ate: 2826.65};
				var ALIQUOTA_15	= {de: 2826.66, ate: 3751.05};	
				var ALIQUOTA_22	= {de: 3751.06, ate: 4664.68};	
				var ALIQUOTA_27	= {de: 4664.69};	
			  
				if (salario >= ALIQUOTA_00.de && salario <= ALIQUOTA_00.ate) {
					return salario;
				} else if (salario >= ALIQUOTA_07.de && salario <= ALIQUOTA_07.ate) {
					return salario * 0.075;
				} else if (salario >= ALIQUOTA_15.de && salario <= ALIQUOTA_15.ate) {
					return salario * 0.15;
				} else if (salario >= ALIQUOTA_22.de && salario <= ALIQUOTA_22.ate) {
					return salario * 0.225;
				} else if (salario >= ALIQUOTA_27.de) {
					return salario * 0.275;
				}
			}

			function calcularSalarioLiquido(s) {
				var salario = parseFloat(s, '0');
				return (salario - calcularDescontoIRRF(calcularDescontoINSS(salario))).toFixed(2);
			}
		]]>  
	</script>");
print ('<var name="nomeBanco" expr="" />');
print ('<var name="salarioLiquido" expr="0" />');
print ('<var name="salario" expr="0" />');

print ('<form>');
print ('<field name="nome">');
print ('<prompt>Informe o nome desejado</prompt>');
print ('<grammar>');
print ('[');

$strNome = '';
foreach ($nomes as $key => $value) {
	$strNome .= '(' . $value['nome'] . ') ';
}

print (trim($strNome) . ']');
print ('</grammar>');
print ('<filled>');
print ('<assign name="nomeBanco" expr="nome" />');
print ('<goto next="#detalhes" />');
print ('</filled>');
print ('</field>');
print ('</form>');
print ('<form id="detalhes">');
print ('<field name="salario" type="digits">');
print ('<prompt>Fale seu salário número por número.</prompt>');
print ('<filled>');
print ('<assign name="salarioLiquido" expr="calcularSalarioLiquido(salario)" />');
print ('<submit method="post" namelist="nomeBanco salario salarioLiquido" next="http://forgeit.com.br/unisc/server/pesquisar.php"/>');
print ('</filled>');
print ('</field>');
print ('</form>');

print ('</vxml>');