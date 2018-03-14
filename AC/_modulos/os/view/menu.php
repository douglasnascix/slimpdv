<h3><?php echo $cliente['cliente_nome'] ?></h3>
<div class="row">
  <div class="col-sm-12 form-group text-right">
    <a href="<?php echo $url."os/cadastrar/".$os['cliente_id']?>/" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i> Novo</a>
    <a href="<?php echo $url."_modulos/os/src/imprimirA4.php?id=".$os['os_id']?>" class="btn btn-success" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="glyphicon glyphicon-print"></i> A4</a>
    <a href="<?php echo $url."_modulos/os/src/imprimir80x40.php?id=".$os['os_id']?>" class="btn btn-success" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="glyphicon glyphicon-print"></i> Mini</a>
    <!-- <a href="<?php echo $url."os/excluir/".$os['os_id']?>/" class="btn btn-danger" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="glyphicon glyphicon-ban-circle"></i> Excluir</a> -->
  </div>
</div>
<div class="clearfix"></div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ordem de Serviço</h3>
  </div>

  
  <div class="panel-body">
    <a href="<?php echo $url."os/editar/".$os['os_id']?>/" class="btn btn-primary active" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="fa fa-info-circle"></i> Informações</a></a>
    <a href="<?php echo $url."os/pecas/".$os['os_id']?>/" class="btn btn-warning" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="fa fa-shopping-cart"></i> Peças e Serviços</a></a>
    <a href="<?php echo $url."os/pagamentos/".$os['os_id']?>/" class="btn btn-success" <?php if($os['os_id'] == 0){echo 'disabled' ;};?>><i class="fa fa-money"></i> Pagamentos</a></a>

    <hr>