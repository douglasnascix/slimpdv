<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SlimPDV - S@T FISCAL <?php echo $titulo_pagina;?></title>
    <link href="<?php echo $url;?>view/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>view/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo $url;?>view/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $url;?>view/css/pdvslim.css" rel="stylesheet">
    <link href="<?php echo $url;?>view/css/loader.css" rel="stylesheet">

    <link href="<?php echo $url;?>view/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <?php if(isset($css)){echo $css;};?>

    <script src="<?php echo $url;?>view/js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div id="bg-loader">
      <div id="loader"></div>
  </div>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="<?php echo $url;?>view/img/logo.png" alt=""></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $url;?>"><i class="glyphicon glyphicon-home"></i> Início</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-book"></i> Cadastro<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $url;?>categoria/listar/">Categorias</a></li>
                    <li><a href="<?php echo $url;?>produto/listar/">Produtos</a></li>
                    <li><a href="<?php echo $url;?>cliente/listar/">Clientes</a></li>
                </ul>
            </li>
            
            <li><a href="<?php echo $url;?>_modulos/caixa/src/limpa.php?fechar=1"><i class="glyphicon glyphicon-shopping-cart"></i> Caixa</a></li>

            <li><a href="<?php echo $url;?>os/listar/"><i class="fa fa-wrench "></i> O.S</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Relatórios<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $url;?>ncm/listar/">Consultar NCM</a></li>
                	<li><a href="<?php echo $url;?>relatorio/produtoncm/">Produtos sem NCM</a></li>
                	<li><a href="<?php echo $url;?>relatorio/produtogrupo/">Produtos por Grupo</a></li>
                    <li><a href="<?php echo $url;?>relatorio/vendas/">Vendas</a></li>
                    <li><a href="<?php echo $url;?>relatorio/sat/">Cupom S@T</a></li>
                    <li><a href="<?php echo $url;?>relatorio/caixa/">Caixa</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> Configurações<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $url;?>empresa/editar/">Dados Empresa</a></li>
                    <li><a href="<?php echo $url;?>pagamento/listar/">Pagamentos</a></li>
                    <li><a href="<?php echo $url;?>sat/editar/">S@T Fiscal</a></li>
                    <li><a href="<?php echo $url;?>usuario/listar/">Usuários</a></li>
                    <li><a href="<?php echo $url;?>tecnico/listar/">Técnicos</a></li>
                </ul>
            </li>

            <li><a href="<?php echo $url;?>logout/"><i class="fa fa-power-off"></i></a></li>

          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <?php include '_modulos/'.$modulo.'/view/'.$pagina.".php";?>
    </div>

    <script src="<?php echo $url;?>view/js/jquery.min.js"></script>
    <script src="<?php echo $url;?>view/js/bootstrap.min.js"></script>
    <script src="<?php echo $url;?>view/js/ie10-viewport-bug-workaround.js"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    });
    </script>
    <?php echo $scriptsJS; ?>
  </body>
</html>
