<?php
require_once 'conecta.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (empty($id)) {
	echo "Pedido inválido.";
	exit;
}

$sql = "DELETE FROM pedido WHERE cod_pedido = :id";
$qryData = $PDO->prepare($sql);
$qryData->bindParam(':id', $id, PDO::PARAM_INT);

if ($qryData->execute()) {
    header('Location: pedidosForm.php');
} else {
    echo "Erro ao remover.";
    var_dump($qryData->errorInfo());
}
