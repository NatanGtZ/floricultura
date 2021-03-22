<?php 
require 'conecta.php';

$produto_id = isset($_GET['id']) ? $_GET['id'] : null;
$countSql = "SELECT * FROM produto WHERE cod_produto=".$produto_id;
$qryCount = $PDO->prepare($countSql);
$qryCount->execute();

$produto = $qryCount->fetchObject();

include 'header.php';
?>
<?= ($produto_id != null) ? '<h2>Editar Produto</h2>' : '<h2>Novo Produto</h2>' ?>

<hr />
<form action="addProduto.php" enctype="multipart/form-data" method="post">
  <?= ($produto_id != null) ? '<input type="hidden" name="id" value="'.$produto->cod_produto.'">' : "" ?>
  <div class="row">
    <div class="form-group col-md-12">
      <label for="name">Nome:</label>
      <input type="text" class="form-control" name="descricao_produto" value="<?= ($produto_id != null) ? $produto->descricao_produto : "" ?>">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Valor:</label>
      <input type="number" class="form-control" name="valor_produto" value="<?= ($produto_id != null) ? $produto->valor_produto : "" ?>">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Imagem:</label>
      <input type="file" class="form-control-file" name="imagem_produto">
    </div>
    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
<?php
include 'footer.php'
?>