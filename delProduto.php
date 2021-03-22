<?php
require_once 'conecta.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (empty($id)) {
	echo "Produto inválido.";
	exit;
}

$sql = "DELETE FROM produto WHERE cod_produto = :id";
$qryData = $PDO->prepare($sql);
$qryData->bindParam(':id', $id, PDO::PARAM_INT);

if ($qryData->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao remover.";
    var_dump($qryData->errorInfo());
}
