<?php
include 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    include "login.class.php";   

    $login["usuario_email"] = $_POST['usuario_email'];
    $login["usuario_senha"] = $_POST['usuario_senha'];

    session_start();
    $loginOBJ = new Login(new config());
    
    if ($loginOBJ->logar($login)) {
        header("Location: ".$url);
    }else{
        $erro = "<h3>Erro ao fazer login.</h3>" ;
    }

};

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplicativo Comercial - S@T Fiscal</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $url ;?>view/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo $url ;?>view/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="col-md-4 col-md-offset-4" style="margin-top:100px;">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">PDVSlim - S@T Fiscal</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="?" method="POST">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuário" name="usuario_email" type="number" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Senha" name="usuario_senha" type="password" value="">
                            </div>
                            <?php if(isset($erro))echo $erro; ?>
                            <button type="submit" class="btn btn-warning btn-block">Acessar</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="<?php echo $url ;?>view/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $url ;?>view/js/bootstrap.min.js"></script>

</body>

</html>