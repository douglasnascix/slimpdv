<?php
session_start();
//header("Content-type: text/xml");
include "../../../config/config.php";

include "../../empresa/src/empresa.class.php";
include "../../sat/src/sat.class.php";
include "../../pedido/src/pedido.class.php";
include "../../caixa/src/cupom.class.php";
include "../../ncm/src/ibpt.class.php";

$pedidoOBJ = new Pedido(new Config());
$empresaOBJ = new Empresa(new Config());
$satOBJ = new Sat(new Config());
$cupomOBJ = new Cupom(new Config());

$empresa = $empresaOBJ->listar();
$sat = $satOBJ->listar();


function tirarAcentos($string){
    $string = str_replace("Ç", "C", $string);
    $string = str_replace("ç", "c", $string);
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}



//Emitir S@T

if($_GET['acao'] == "emitir"){

  if(isset($_GET['pedido_id'])) {
    $_SESSION['PEDIDO'] = $_GET['pedido_id'];
  }

  if (!isset($_SESSION['PEDIDO']) and !isset($_GET['acao'])) {
    header("Location: ".$url."caixa/index/");
  }


  $pedido = $pedidoOBJ->listar($_SESSION['PEDIDO']);
  $produtos = $pedidoOBJ->listar_produto($_SESSION['PEDIDO']);
  $pagamentos = $pedidoOBJ->listar_pagamento($_SESSION['PEDIDO']);


  function imposto($ncm, $cst){
    $ibptOBJ = new Ibpt(new Config());
    $buscar_imposto = $ibptOBJ->buscar_imposto($ncm);
    
    if($cst == 0){$federal = $buscar_imposto['nacionalfederal'];}
    else{$federal = $buscar_imposto['importadofederal'];}

    $estadual = $buscar_imposto['estadual'];
    $municipal = $buscar_imposto['municipal'];

    return $total = $federal+$estadual+$municipal;
  }

//09389576000167
//09389576000167
  $xmlSat = '<?xml version="1.0"?>
  <CFe>
    <infCFe versaoDadosEnt="0.07">
      <ide>
        <CNPJ>09389576000167</CNPJ>        
        <signAC>'.$sat['sat_signAC'].'</signAC>
        <numeroCaixa>001</numeroCaixa>
      </ide>
      <emit>
        <CNPJ>'.preg_replace("/[^0-9]/", "", $empresa['empresa_cnpj']).'</CNPJ>
        <IE>'.preg_replace("/[^0-9]/", "", $empresa['empresa_ie']).'</IE>
        <cRegTribISSQN>'.$empresa['empresa_RegTribISSQN'].'</cRegTribISSQN>
        <indRatISSQN>'.$empresa['empresa_indRatISSQN'].'</indRatISSQN>
      </emit>';
      

      if(isset($pedido['pedido_cpf'])){
        if($pedido['pedido_cpf'] != ""){
          $cpfcnpj = preg_replace("/[^0-9]/", "", $pedido['pedido_cpf']);
          if(strlen($cpfcnpj) == 11){
            $xmlSat .= '<dest>
            <CPF>'.$cpfcnpj.'</CPF>
          </dest>';
          }else{
            $xmlSat .= '<dest>
            <CNPJ>'.$cpfcnpj.'</CNPJ>
          </dest>';
          }
          
        }else{
          $xmlSat .= '<dest/>';
        }
      }else{
          $xmlSat .= '<dest/>';
      }   

      $contador = 1; $vCFeLei12741 = 0;
      $erro = "";
      foreach($produtos as $produto){



        //Verifica Nome produto
        if(strlen($produto['produto_nome']) >= 120) {
          $erro .= " Produto ". $produto['produto_id'] . " com Nome muito grande.";
        }

        //verifica NCM
        if($produto['produto_ncm'] == ""){
          $erro .= " Produto ". $produto['produto_id'] . " sem NCM.";
        }else{
          if(strlen($produto['produto_ncm']) != 8){
            $erro .= " Produto ". $produto['produto_id'] . " com NCM inválido.";
          }
        }

        //verifica CFOP
        if($produto['produto_cfop'] == ""){
          $erro .= " Produto ". $produto['produto_id'] . " sem CFOP.";
        }else{
          if(strlen($produto['produto_cfop']) != 4){
            $erro .= " Produto ". $produto['produto_id'] . " com CFOP inválido.";
          }
        }






      $vItem12741 = ($produto['produto_quantidade'] * $produto['produto_preco']) * imposto($produto['produto_ncm'], $produto['produto_cst']) / 100;
      $vCFeLei12741 += $vItem12741;
  		$xmlSat .='<det nItem="'.$contador.'">
  			  <prod>
  			    <cProd>'.$produto['produto_id'].'</cProd>
  			    <xProd>'.tirarAcentos($produto['produto_nome']).'</xProd>
  			    <NCM>'.$produto['produto_ncm'].'</NCM>
  			    <CFOP>'.$produto['produto_cfop'].'</CFOP>
  			    <uCom>'.$produto['produto_unidade'].'</uCom>
  			    <qCom>'.$produto['produto_quantidade'].'</qCom>
  			    <vUnCom>'.$produto['produto_preco'].'</vUnCom>
  			    <indRegra>A</indRegra>
  			  </prod>
  			  <imposto>
  			  	<vItem12741>'.number_format($vItem12741*$produto['produto_quantidade'], 2, '.', '').'</vItem12741>
  			    <ICMS>
  			      <ICMSSN102>
  			        <Orig>'.$produto['produto_cst'].'</Orig>
  			        <CSOSN>'.$produto['produto_csosn'].'</CSOSN>
  			      </ICMSSN102>
  			    </ICMS>
  			    <PIS>
  			      <PISSN>
  			        <CST>49</CST>
  			      </PISSN>
  			    </PIS>
  			    <COFINS>
  			      <COFINSSN>
  			        <CST>49</CST>
  			      </COFINSSN>
  			    </COFINS>
  			  </imposto>
  			</det>
  			';
  			$contador++;
      };
      $xmlSat .='
      <total>';
      if($pedido['pedido_acrescimo'] > 0.00 or $pedido['pedido_desconto'] > 0.00){
        $xmlSat .='<DescAcrEntr>';
          if($pedido['pedido_desconto'] > 0.00){
            $xmlSat .='<vDescSubtot>'.$pedido['pedido_desconto'].'</vDescSubtot>';
          }else{
            $xmlSat .='<vAcresSubtot>'.$pedido['pedido_acrescimo'].'</vAcresSubtot>';
          }
        $xmlSat .='</DescAcrEntr>';
      };
        $xmlSat .='<vCFeLei12741>';
        $xmlSat .= number_format($vCFeLei12741, 2, '.', '').'</vCFeLei12741>
      </total>
      <pgto>';
      
      foreach ($pagamentos as $pagamento) {
        $xmlSat .='
        <MP>
            <cMP>0'.$pagamento['pagamento_cod'].'</cMP>
            <vMP>'.$pagamento['pedido_pagamento_valor'].'</vMP>
          </MP>';
      };


      $xmlSat .='
      </pgto>
      <infAdic>
        <infCpl> :: Sistema SlimPDV :: </infCpl>
      </infAdic>
      
    </infCFe>
  </CFe>';

  if(!isset($_GET['pedido_id'])) {
    if($erro == ""){
      $cupomOBJ->criar($_SESSION['PEDIDO'], $xmlSat, $pedido['pedido_valor'], $pedido['pedido_cpf'], "Emitir", "");
    }else{
      $cupomOBJ->criar($_SESSION['PEDIDO'], $xmlSat, $pedido['pedido_valor'], $pedido['pedido_cpf'], "Falha", $erro);
    }
  }else{
    if($erro == ""){
      $cupomOBJ->atualizar($_SESSION['PEDIDO'], $xmlSat, $pedido['pedido_valor'], $pedido['pedido_cpf'], "Emitir", "");
    }else{
      $cupomOBJ->atualizar($_SESSION['PEDIDO'], $xmlSat, $pedido['pedido_valor'], $pedido['pedido_cpf'], "Falha", $erro);
    }
  }

  include "../../caixa/src/limpa.php";
  header("Location: ".$url."_modulos/caixa/src/limpa.php?fechar=1");
}



if($_GET['acao'] == "cancelar"){

  if(isset($_GET['chaveConsulta'])){

    $chaveConsulta = $_GET['chaveConsulta'];

    $xmlCancelamento = '<?xml version="1.0"?>
      <CFeCanc>
        <infCFe chCanc="'.$chaveConsulta.'">
          <ide>
            <CNPJ>09389576000167</CNPJ>
            <signAC>'.$sat['sat_signAC'].'</signAC>
            <numeroCaixa>001</numeroCaixa>
          </ide>
          <emit/>
          <dest/>
          <total/>
        </infCFe>
    </CFeCanc>';

  $cupomOBJ->cancelar($chaveConsulta, $xmlCancelamento);
  header("Location: ".$url."relatorio/sat/");
  
  }

}

if($_GET['acao'] == "imprimir"){

  if(isset($_GET['chaveConsulta'])){

    $chaveConsulta = $_GET['chaveConsulta'];

    $cupomOBJ->imprimir($chaveConsulta);  
    header("Location: ".$url."relatorio/sat/");
  
  }

}