<?php
require_once 'conecta.php';


$pedido = "SELECT * FROM  pedido";

$countSql = "SELECT  COUNT(*) AS total FROM pedido ORDER BY cod_pedido ASC";
$dataSql = "SELECT pedido.*, produto.descricao_produto, cliente.*
FROM pedido
INNER JOIN produto ON pedido.cod_produto = produto.cod_produto 
INNER JOIN cliente ON pedido.cod_cliente = cliente.cod_cliente 
ORDER BY cod_pedido ASC";



$qryCount = $PDO->prepare($countSql);
$qryCount->execute();

$total = $qryCount->fetchColumn();

$qryData = $PDO->prepare($dataSql);
$qryData->execute();

include 'header.php'

?>
<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Pedidos</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-default" href="pedidosForm.php"><i class="fa fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>
<hr>
<table class="table table-hover">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Nome Cliente</th>
            <th>Telefone Cliente</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($total > 0) { ?>
            <?php while ($produto = $qryData->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $produto['cod_pedido']; ?></td>
                    <td><?= $produto['descricao_produto']; ?></td>
                    <td><?= $produto['quantidade']; ?></td>
                    <td><?= $produto['nome_cliente']; ?></td>
                    <td><?= $produto['telefone']; ?></td>

                    <td class="actions text-right">
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" 
                            data-pedido=1 data-id="<?= $produto['cod_pedido']; ?>">
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6">Nenhum produto cadastrado.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
include 'footer.php'
?>
