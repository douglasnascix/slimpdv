<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Painel Administrativo</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $url;?>view/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo $url;?>view/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $url;?>view/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $url;?>view/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php if(isset($css_link)){echo $css_link;};?>
    <style type="text/css">
    nav a {
        color: #ff7f00;
    }

    nav a:hover, nav a:active {
        color: #333;
    }

    .laranja a{
        color: #ff7f00 !important;
    }
    .laranja>ul>li.active>a {
        background-color: #eee !important;
        border-color: #eee !important;
    }

    <?php if(isset($css)){echo $css;};?>
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $url; ?>">Spirit of Combat</a>
            </div>
            <!-- /.navbar-header -->

             <ul class="nav navbar-top-links navbar-right">
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    
                </li> -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $url;?>logout/"><i class="fa fa-sign-out fa-fw"></i> Sair</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo $url;?>"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Catalogo<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $url;?>cor/listar/">Cores</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>tamanho/listar/">Tamanhos</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>marca/listar/">Marcas</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>categoria/listar/">Categorias</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>produto/listar/">Produtos</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>promocoes/listar/">Promoções</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>cupom/listar/">Cupons de Desconto</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo $url;?>banner/listar/"><i class="fa fa-newspaper-o fa-fw"></i> Banners</a>
                        </li>

                        <li>
                            <a href="<?php echo $url;?>pedido/listar/"><i class="fa fa-money fa-fw"></i> Pedidos</a>
                        </li>

                        <li>
                            <a href="<?php echo $url;?>cliente/listar/"><i class="fa fa-users fa-fw"></i> Clientes</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Relatórios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="hidden">
                                    <a href="<?php echo $url;?>relatorio/listar/">Relatório Teste</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Configurações<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="hidden">
                                    <a href="<?php echo $url;?>empresa/listar/">Dados Empresa</a>
                                </li>
                                <li>
                                    <a href="<?php echo $url;?>usuario/listar/">Usuários</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php 
                            include '_modulos/'.$modulo.'/view/'.$pagina.".php";
                        ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo $url;?>view/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $url;?>view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $url;?>view/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $url;?>view/dist/js/sb-admin-2.js"></script>

    <?php echo $scriptsJS; ?>

</body>

</html>
