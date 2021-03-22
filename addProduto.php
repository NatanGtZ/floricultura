<?php

require_once 'conecta.php';


$id = isset($_POST['id']) ? $_POST['id'] : null;
$nome = isset($_POST['descricao_produto']) ? $_POST['descricao_produto'] : null;
$valor = isset($_POST['valor_produto']) ? $_POST['valor_produto'] : null;

if (empty($nome) || empty($valor)) {
    echo "Preencha todos os campos.";
    exit;
}

if (isset($_FILES['imagem_produto']) && $_FILES['imagem_produto']['size'] > 0) {
    $tmpName  = $_FILES['imagem_produto']['tmp_name'];
    $fp = fopen($tmpName, 'rb');
    if ($id != null) {
        $sql = "UPDATE produto SET descricao_produto = :nome, valor_produto = :valor, imagem_produto = :imagem WHERE cod_produto = :id";
        $qryAdd = $PDO->prepare($sql);
        $qryAdd->bindParam(':id', $id);
        $qryAdd->bindParam(':nome', $nome);
        $qryAdd->bindParam(':valor', $valor);
        $qryAdd->bindParam(':imagem', $fp, PDO::PARAM_LOB);
    } else {
        $sql = "INSERT INTO produto(descricao_produto, valor_produto, imagem_produto) VALUES (:nome, :valor, :imagem)";
        $qryAdd = $PDO->prepare($sql);
        $qryAdd->bindParam(':nome', $nome);
        $qryAdd->bindParam(':valor', $valor);
        $qryAdd->bindParam(':imagem', $fp, PDO::PARAM_LOB);
    }
} else {
    if ($id != null) {
        $sql = "UPDATE produto SET descricao_produto = :nome, valor_produto = :valor WHERE cod_produto = :id";
        $qryAdd = $PDO->prepare($sql);
        $qryAdd->bindParam(':id', $id);
        $qryAdd->bindParam(':nome', $nome);
        $qryAdd->bindParam(':valor', $valor);
    } else {
        $sql = "INSERT INTO produto(descricao_produto, valor_produto) VALUES (:nome, :valor)";
        $qryAdd = $PDO->prepare($sql);
        $qryAdd->bindParam(':nome', $nome);
        $qryAdd->bindParam(':valor', $valor);
    }
}

if ($qryAdd->execute()) {
    header('Location: index.php');
} else {
    echo "Erro ao cadastrar pedido";
    print_r($qryAdd->errorInfo());
}