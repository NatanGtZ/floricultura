<?php require 'conecta.php';

$produto_id = isset($_GET['produtoId']) ? $_GET['produtoId'] : null;

$countSql = "SELECT * FROM produto WHERE cod_produto = ".$produto_id;

$qryCount = $PDO->prepare($countSql);
$qryCount->execute();

$produto = $qryCount->fetchObject();

include 'header.php';
?>

<h2>Novo Pedido</h2>
<hr />
<form action="addPedido.php" method="post">
  <span id="valorProduto" style="display: none;"><?= $produto->valor_produto ?></span>
  <!-- area de campos do form -->
  <div class="row">
    <div class="col-sm-6 h3">
      Você está comprando: <?= $produto->descricao_produto ?>
    </div>
    <div class="col-sm-6 text-right h3">
      Valor do Pedido: R$<span id="valorPedido"><?= $produto->valor_produto ?></span>
    </div>
  </div>
  <hr />
  <div class="row">
    <input type="hidden" name="produtoId" value="<?= $produto->cod_produto ?>">
    <div class="form-group col-md-12">
      <label for="name">Quantidade:</label>
      <input type="number" class="form-control" id="quantidade" name="quantidade">
    </div>

    <div class="form-group col-md-12">
      <label for="name">Nome Cliente:</label>
      <input type="text" class="form-control" id="nome_cliente" name="nome_cliente">
    </div>
    <div class="form-group col-md-12">
      <label for="name">Telefone Cliente:</label>
      <input type="text" class="form-control" id="telefone" name="telefone">
    </div>

    <div class="col-md-12">
      <button type="submit" class="btn btn-success">Confirmar Pedido</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>
<?php
include 'footer.php'
?>