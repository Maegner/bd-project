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

    function doQuery($query,$database){
        try{
            $database->query($query);
        }

        catch(PDOException $e){
            $hadProblem = true;
            $rollback = "ROLLBACK;";
            doQuery($rollback,$db);
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }

    function isNewSimple($name,$db){
        $sql = "SELECT * FROM Constituida where super_categoria = '$name';";
        $result = $db->query($sql);
        if($result->rowCount()==1){
            return true;
        }
        return false;
    }

    function changeToSimple($name,$db){
        $sql = "DELETE FROM Constituida WHERE super_categoria = '$name';";
        doQuery($sql,$db);
        $sql = "DELETE FROM Super_Categoria WHERE nome = '$name';";
        doQuery($sql,$db);
        $sql = "INSERT INTO Categoria_Simples VALUES('$name');";
        doQuery($sql,$db);
    }

    function isInSuperCat($name,$db){
        $sql = "SELECT * FROM Constituida where categoria = '$name';";
        $result = $db->query($sql);
        foreach($result as $row){
            if(isNewSimple($row['super_categoria'],$db)){
                changeToSimple($row['super_categoria'],$db);
            }
        }
    }

    $nomeCategoria = $_REQUEST['NomeCategoria'];

    if ($nomeCategoria == "") {
        echo("<p>NomeCategoria vazio<p>");
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

        $start = "START TRANSACTION;";
        doQuery($start,$db);

        isInSuperCat($nomeCategoria,$db);

        $delCat = "DELETE FROM Categoria WHERE nome = '$nomeCategoria';";
        doQuery($delCat,$db);

        $end = "COMMIT;";
        doQuery($end,$db);

        $db = null;
        if(!$hadProblem){
            echo("<p> Remoção efectuada com sucesso </p>");
        }
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $rollback = "ROLLBACK;";
        doQuery($rollback,$db);
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button class=\"ink-button orange\" onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>