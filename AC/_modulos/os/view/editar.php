<?php 
include ROOT.DS."_modulos".DS."os".DS."view".DS."menu.php";
?>
<form action="<?php echo $url;?>os/editar/<?php echo $_GET['id']; ?>/" method="POST" id="editar">
      <div class="col-sm-2 form-group">
        <label for="os_id">Cod.</label>
        <input type="text" name="os_id" id="os_id" class="form-control" readonly value="<?php echo $os['os_id']?>">
        <input type="hidden" name="cliente_id" id="cliente_id" class="form-control" readonly value="<?php echo $os['cliente_id']?>">
      </div>
      <div class="col-sm-4 form-group">
        <label for="os_status">Status</label>
        <select name="os_status" id="os_status" class="form-control">
          <option value="Orçamento" <?php if($os['os_status'] == 'Orçamento'){echo 'selected ';};?> >Orçamento</option>
          <option value="Aguardando Aprovação" <?php if($os['os_status'] == 'Aguardando Aprovação'){echo 'selected ';};?> >Aguardando Aprovação</option>
          <option value="Aprovado" <?php if($os['os_status'] == 'Aprovado'){echo 'selected ';};?> >Aprovado</option>
          <option value="Reprovado" <?php if($os['os_status'] == 'Reprovado'){echo 'selected ';};?> >Reprovado</option>
        </select>
      </div>
      
      <div class="col-sm-3 form-group">
        <label for="os_data">Data</label>
        <input type="text" name="os_data" id="os_data" class="form-control" readonly value="<?php echo date_format(date_create($os['os_data']), "d/m/Y H:i:s")?>">
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_data_atualizado">Data Atualização</label>
        <input type="text" name="os_data_atualizado" id="os_data_atualizado" class="form-control" readonly value="<?php echo date_format(date_create($os['os_data_atualizado']), "d/m/Y H:i:s")?>">
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_equipamento">Equipamento</label>
        <select name="os_equipamento" id="os_equipamento" class="form-control">
          <option value="0" disabled selected>Escolha</option>
          <option value="Celular" <?php if($os['os_equipamento'] == 'Celular'){echo 'selected ';};?>>Celular</option>
          <option value="Tablet" <?php if($os['os_equipamento'] == 'Tablet'){echo 'selected ';};?>>Tablet</option>
          <option value="Desktop" <?php if($os['os_equipamento'] == 'Desktop'){echo 'selected ';};?>>Desktop</option>
          <option value="Notebook" <?php if($os['os_equipamento'] == 'Notebook'){echo 'selected ';};?>>Notebook</option>
          <option value="Video-Game" <?php if($os['os_equipamento'] == 'Video-Game'){echo 'selected ';};?>>Video-Game</option>
          <option value="Outro" <?php if($os['os_equipamento'] == 'Outro'){echo 'selected ';};?>>Outro</option>
        </select>
      </div>
      
      <div class="col-sm-3 form-group">
        <label for="marca_id">Marca</label>
        <select type="text" name="marca_id" id="marca_id" class="form-control">
          <option value="0" disabled selected>Escolha</option>
        <?php
          foreach ($marcas as $marca) {
            if($os['marca_id'] == $marca['marca_id']){
              $selecionado = "selected";
            }else{
              $selecionado = "";
            }
            echo '<option value="'.$marca['marca_id'].'" '.$selecionado.'>'.$marca['marca_nome'].'</option>';
          }
        ?>
        </select>
      </div>     

      <div class="col-sm-3 form-group">
        <label for="os_modelo">Modelo</label>
        <input type="text" name="os_modelo" id="os_modelo" class="form-control" value="<?php echo $os['os_modelo']?>">
      </div>

      <div class="col-sm-3 form-group">
        <label for="os_nserie">Nº Serie</label>
        <input type="text" name="os_nserie" id="os_nserie" class="form-control" value="<?php echo $os['os_nserie']?>">
      </div>

      <div class="col-sm-6 form-group">
        <label for="os_acessorio">Acessórios</label>
        <input type="text" name="os_acessorio" id="os_acessorio" class="form-control" value="<?php echo $os['os_acessorio']?>">
      </div>
      <div class="col-sm-6 form-group">
        <label for="tecnico_id">Técnico</label>
        <select name="tecnico_id" id="tecnico_id" class="form-control">
          <option value="0" disabled selected>Escolha</option>
          <?php
          foreach ($tecnicos as $tecnico) {
            if($os['tecnico_id'] == $tecnico['tecnico_id']){
              $selecionado = "selected";
            }else{
              $selecionado = "";
            }
            echo '<option value="'.$tecnico['tecnico_id'].'" '.$selecionado.'>'.$tecnico['tecnico_nome'].'</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_defeito">Defeito</label>
        <textarea name="os_defeito" id="os_defeito" class="form-control" rows="5"><?php echo $os['os_defeito']?></textarea>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_laudo">Laudo</label>
        <textarea name="os_laudo" id="os_laudo" class="form-control" rows="5"><?php echo $os['os_laudo']?></textarea>
      </div>
      <div class="col-md-6 form-group">
        <label for="os_obs">Observação</label>
        <textarea name="os_obs" id="os_obs" class="form-control" rows="5"><?php echo $os['os_obs']?></textarea>
      </div>
      <div class="col-sm-6 form-group">
         <label for="os_obs_interna">Obs Interna</label>
        <textarea name="os_obs_interna" id="os_obs_interna" class="form-control" rows="5"><?php echo $os['os_obs_interna']?></textarea>        
      </div>
      </form>
    </div>
    <div class="panel-footer">
     <div class="col-sm-6">
      <a href="<?php echo $url?>os/listar/" type="button" class="btn btn-block btn-default">Cancelar</a>      
    </div>
    <div class="col-sm-6">
      <button type="submit" class="form-control btn btn-success" form="editar" <?php if($os['os_status'] == "Cancelado"){echo "disabled";}?> > Salvar </button>
    </div>
    <div class="clearfix"></div>
  </div>

</div>
</div>

<?php
$scriptsJS .= '<script src="'.$url.'_plugins/jquery.mask.js"></script>';
$scriptsJS .= '<script src="'.$url.'_modulos/os/view/js/os.js"></script>';
?>