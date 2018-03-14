<h3 class="page-header">Configuração / Pagamento / Listar</h3>


<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<td><b>Nome</b></td>
				<td><b>&nbsp;</b></td>
			</tr>
		</thead>
	<?php foreach ($pagamentos as $pagamento){
		echo '
		<tr>
			<td>'.$pagamento['pagamento_nome'].'</td>
			<td align="right">';

			if($pagamento['pagamento_ativado'] == 1 ){
				echo '<a href="'.$url.'pagamento/desativa/'.$pagamento[0].'/" class="btn btn-success btn-xs">
					<span class="fa fa-power-off"> </span>
				</a>';
			}else{
				echo '<a href="'.$url.'pagamento/ativa/'.$pagamento[0].'/" class="btn btn-danger btn-xs">
						<span class="fa fa-power-off"></span>
					</a>';
			}
		
		echo '
			</td>
		</tr>';
		}?>
	</table>
</div>