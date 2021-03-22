<?php

require_once 'conecta.php';

$produto_id = isset($_POST['produtoId']) ? $_POST['produtoId'] : null;
$produto_quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
$cliente_nome = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : null;
$cliente_telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;

$clienteIds = "SELECT cod_cliente FROM cliente WHERE nome_cliente = ".$cliente_nome;

$clienteId = 3;

/*$clienteTel = "UPDATE cliente SET 'telefone' = :telefone WHERE cod_cliente = ".$clienteId;
$qryAdd = $PDO->prepare($clienteTel);
$qryAdd->bindParam(':telefone',$clienteTel);
$qryAdd->execute();*/

if (empty($produto_id) && empty($clienteId)) {
    echo "Preencha todos os campos.";
    exit;
}

$sql = "INSERT INTO pedido(cod_cliente, cod_produto, quantidade) VALUES (:cliente_id, :produto_id, :produto_quantidade)";
$qryAdd = $PDO->prepare($sql);
$qryAdd->bindParam(':cliente_id',$clienteId);
$qryAdd->bindParam(':produto_id',$produto_id);
$qryAdd->bindParam(':produto_quantidade',$produto_quantidade);

if ($qryAdd->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao cadastrar pedido";
    print_r($qryAdd->errorInfo());
}

?>