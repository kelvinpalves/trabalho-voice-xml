<?php

require_once('banco.php');

$conn = conectar();

$retorno = buscarPessoas($conn);

print_r(json_encode($retorno));