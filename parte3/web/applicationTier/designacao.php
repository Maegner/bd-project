<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
                        <!-- load Ink's CSS -->
                        <link rel="stylesheet" type="text/css" href="../ink/css/ink-flex.min.css">
    <link rel="stylesheet" type="text/css" href="../ink/css/font-awesome.min.css">

    <!-- load Ink's CSS for IE8 -->
    <!--[if lt IE 9 ]>
        <link rel="stylesheet" href="../css/ink-ie.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <![endif]-->

    <!-- test browser flexbox support and load legacy grid if unsupported -->
    <script type="text/javascript" src="../ink/js/modernizr.js"></script>
    <script type="text/javascript">
        Modernizr.load({
          test: Modernizr.flexbox,
          nope : '../ink/css/ink-legacy.min.css'
        });
    </script>

    <!-- load Ink's javascript files -->
    <script type="text/javascript" src="../ink/js/holder.js"></script>
    <script type="text/javascript" src="../ink/js/ink-all.min.js"></script>
    <script type="text/javascript" src="../ink/js/autoload.js"></script>

    <style type="text/css">

        body {
            background: #ededed;
        }

        header {
            border-bottom: 1px solid #cecece;
        }

        footer {
            background: #ccc;
        }

    </style>
</head>
    <body>
<?php

    $hadProblem = false;

    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['NovaDesignacao'];

    if ($ean == "") {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>[ERRO] EAN vazio</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }
    if ($designacao == "") {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>[ERRO] Designação vazio</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist426040";
        $password = "lkdy2200";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("START TRANSACTION;");

        $exists = "SELECT FROM Produto WHERE ean = '$ean';";
        $result = $db->query($exists);

        if($result->rowCount()==0){
            $db->query("ROLLBACK;");
            echo("<div class=\"ink-alert basic error\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Erro:</b>[ERRO] Nao existe produto com o ean especificado</p>
            </div>");
            echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        $sql = "UPDATE Produto
                SET design = '$designacao'
                WHERE ean = '$ean';";

        $db->query($sql);

        $db->query("COMMIT;");

        $db = null;

        if(!$hadProblem){
            echo("<div class=\"ink-alert basic success\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Sucesso:</b>Atualzação efectuada com sucesso</p>
            </div>");
        }

        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $db->query("ROLLBACK;");
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>{$e->getMessage()}</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
