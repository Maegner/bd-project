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

    function exists($name,$db){
        $sql = "SELECT * FROM Categoria WHERE nome = '$name';";
        $result = $db->query($sql);
        if($result->rowCount()!= 0){
            return true;
        }
        return false;
    }

    $nomeCategoria = $_REQUEST['NomeCategoria'];
    if ($nomeCategoria == "") {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>NomeCategoria vazio</p>
        </div>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist426018";
        $password = "fcgs5019";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("START TRANSACTION;");

        if(exists($nomeCategoria,$db)){
            echo("<div class=\"ink-alert basic error\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Erro:</b>[ERRO] A categoria que pertende inserir ja existe</p>
            </div>");
            echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            $db->query("ROLLBACK;");
            return;
        }


        $sql = "INSERT INTO Categoria VALUES('$nomeCategoria');";

        $db->query($sql);

        $sql = "INSERT INTO Categoria_Simples VALUES('$nomeCategoria');";
        
        $db->query($sql);

        $db->query("COMMIT;");

        $db = null;

        echo("<div class=\"ink-alert basic success\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Sucesso:</b>Insercao foi um sucesso</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $db->query("ROLLBACK;");
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>ERROR: {$e->getMessage()}</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
