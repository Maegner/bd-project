<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">

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
    $ean = $_REQUEST['EAN_Reposicao'];

    if ($ean == "") {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>[ERRO] EAN vazio</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }
    
    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxxx";
        $password = "xxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM Reposicao WHERE ean = '$ean';";
                
        $result = $db->query($sql);

        if($result->rowCount()==0){
            echo("<div class=\"ink-alert basic error\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Erro:</b>[ERRO] Nenhuma reposicao encontrada para o produto com EAN = {$ean}</p>
            </div>");
            echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        echo("<table class=\"ink-table alternating\" border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['ean']}</td>\n");
            echo("<td>{$row['nro']}</td>\n");
            echo("<td>{$row['lado']}</td>\n");
            echo("<td>{$row['altura']}</td>\n");
            echo("<td>{$row['operador']}</td>\n");
            echo("<td>{$row['instante']}</td>\n");
            echo("<td>{$row['unidades']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");

        $db = null;

        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b>ERROR: {$e->getMessage()}</p>
        </div>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
