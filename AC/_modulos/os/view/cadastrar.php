<h3><?php echo $cliente['cliente_nome'] ?> <small>CPF <?php echo $cliente['cliente_cpf'] ?></small></h3>
<p><?php echo $cliente['cliente_telefone'] ?> - <?php echo $cliente['cliente_celular'] ?> <a href="<?php echo $url.'cliente/editar/'.$cliente['cliente_id']?>"><i class="fa fa-edit"></i></a></p>
<div class="row">
  <div class="col-sm-12 form-group text-right">
    <a href="<?php echo $url."os/cadastrar/".$_GET['id']?>/" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i> Novo</a>
  </div>
</div>
<div class="clearfix"></div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ordem de Serviço</h3>
  </div>

  <form action="<?php echo $url;?>os/cadastrar/<?php echo $cliente[0]; ?>/" method="POST">
  <div class="panel-body">
      <div class="col-sm-2 form-group">
        <label for="os_id">Cod.</label>
        <input type="text" name="os_id" id="os_id" class="form-control" readonly>
      </div>
      <div class="col-sm-4 form-group">
        <label for="os_status">Status</label>
        <select name="os_status" id="os_status" class="form-control">
          <option value="Orçamento">Orçamento</option>
          <option value="Aguardando Aprovação">Aguardando Aprovação</option>
          <option value="Aprovado">Aprovado</option>
          <option value="Reprovado">Reprovado</option>
        </select>
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_data">Data</label>
        <input type="text" name="os_data" id="os_data" class="form-control" readonly>
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_data_atualizado">Data Atualização</label>
        <input type="text" name="os_data_atualizado" id="os_data_atualizado" class="form-control" readonly>
      </div>
      
      <div class="col-sm-3 form-group">
        <label for="os_equipamento">Equipamento</label>
        <select name="os_equipamento" id="os_equipamento" class="form-control">
          <option value="0" disabled selected>Escolha</option>
          <option value="Celular">Celular</option>
          <option value="Tablet">Tablet</option>
          <option value="Desktop">Desktop</option>
          <option value="Notebook">Notebook</option>
          <option value="Video-Game">Video-Game</option>
        </select>
      </div>

      <div class="col-sm-3 form-group">
        <label for="marca_id">Marca</label>
        <select type="text" name="marca_id" id="marca_id" class="form-control">
          <option value="0" disabled selected>Escolha</option>
        <?php
          foreach ($marcas as $marca) {
            echo '<option value="'.$marca['marca_id'].'">'.$marca['marca_nome'].'</option>';
          }
        ?>
        </select>
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_modelo">Modelo</label>
        <input type="text" name="os_modelo" id="os_modelo" class="form-control">
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_nserie">Nº Serie</label>
        <input type="text" name="os_nserie" id="os_nserie" class="form-control">
      </div>

      <div class="col-sm-6 form-group">
        <label for="os_acessorio">Acessórios</label>
        <input type="text" name="os_acessorio" id="os_acessorio" class="form-control">
      </div>
      <div class="col-sm-6 form-group">
        <label for="tecnico_id">Técnico</label>
        <select name="tecnico_id" id="tecnico_id" class="form-control">
          <?php
          foreach ($tecnicos as $tecnico) {
            echo '<option value="'.$tecnico['tecnico_id'].'">'.$tecnico['tecnico_nome'].'</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_defeito">Defeito</label>
        <textarea name="os_defeito" id="os_defeito" class="form-control" rows="5"></textarea>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_laudo">Laudo</label>
        <textarea name="os_laudo" id="os_laudo" class="form-control" rows="5"></textarea>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_obs">Observação</label>
        <textarea name="os_obs" id="os_obs" class="form-control" rows="5"></textarea>
      </div>
      <div class="col-sm-6 form-group">
         <label for="os_obs_interna">Obs Interna</label>
        <textarea name="os_obs_interna" id="os_obs_interna" class="form-control" rows="5"></textarea>        
      </div>      

    </div>
    <div class="panel-footer">
     <div class="col-sm-6">
      <a href="<?php echo $url?>os/listar/" type="button" class="btn btn-block btn-default">Cancelar</a>      
    </div>
    <div class="col-sm-6">
      <button type="submit" class="form-control btn btn-success"> Salvar </button>
    </div>
    <div class="clearfix"></div>
  </div>
</form>
</div>
</div>
<?php
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/os/view/js/os.js"></script>';
?>