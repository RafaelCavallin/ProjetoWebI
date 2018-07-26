<?php  
session_start();
require_once("inc/inc.dbadmin.php");
require_once("inc/inc.conexao.php");

    //Verifica se há uma session válida.
    if(!isset($_SESSION['login']['log']) and empty($_SESSION['login']['log'])){
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestão</title>
</head>
<body>
    <?php include_once('php/exe.menu.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <?php
                // MENSAGEM APÓS CADASTRO/EXCLUSÃO
                    if (isset($_GET['msg']) AND $_GET['msg'] == 'insert') {
                        $msg = '<div id="alerta" class="alert alert-primary mt-3" role="alert">
                                    Cadastrado com Sucesso!
                                </div>';

                    }elseif (isset($_GET['msg']) AND $_GET['msg'] == 'del') {
                        $msg = '<div id="alerta" class="alert alert-danger mt-3" role="alert">
                                    Excluido com Sucesso!
                                </div>';

                    }elseif (isset($_GET['msg']) AND $_GET['msg'] == 'up') {
                        $msg = '<div id="alerta" class="alert alert-success mt-3" role="alert">
                                    Alterado com Sucesso!
                                </div>';
                    }elseif (isset($_GET['msg']) AND $_GET['msg'] == 'sti') {
                        $msg = '<div id="alerta" class="alert alert-danger mt-3" role="alert">
                                    Senha atual incorreta. Senha não alterada!
                                </div>';
                    }elseif (isset($_GET['msg']) AND $_GET['msg'] == 'spi') {
                        $msg = '<div id="alerta" class="alert alert-danger mt-3" role="alert">
                                    Senhas precisam ser iguais. Senha não alterada!
                                </div>';
                    }elseif (isset($_GET['msg']) AND $_GET['msg'] == 'ptc') {
                        $msg = '<div id="alerta" class="alert alert-danger mt-3" role="alert">
                                    Preencha todos os campos. Senha não alterada!
                                </div>';
                    }else{
                        $msg = "";
                    }
                    echo $msg;
                ?>    

                <?php 
                // CARREGAMENTO DAS PÁGINAS
                    if (isset($_GET['pg']) and !empty($_GET['pg'])) {
                        $pag = $_GET['pg'];
                    }else{
                        $pag = 'home';
                    }
                    include_once('php/exe.' . $pag .'.php');
                ?>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mask.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $('#alerta').fadeOut(1000);
            }, 3000);
        });
    </script>

</body>
</html>