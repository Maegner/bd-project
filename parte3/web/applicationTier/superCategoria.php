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

    function doesCatExist($catName,$database){
        $sql = "SELECT * FROM Categoria WHERE nome = '$catName';";
        $result = $database->query($sql);

        if(($result->rowCount()==0)){
            return false;
        }
        return true;
    }

    function doQuery($query,$database){
        try{
            $database->query($query);
        }

        catch(PDOException $e){
            $hadProblem = true;
            echo("<div class=\"ink-alert basic error\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Erro:</b> ERROR In Query({$query}): {$e->getMessage()}</p>
            </div>");
            $db->query("ROLLBACK;");
            return false;
        }
        return true;
    }

    function postSuperCat($nameSuper,$subCats,$database){
        $sql = "INSERT INTO Categoria VALUES('$nameSuper');";
        if (!doQuery($sql,$database)){
            return;
        }
        $sql = "INSERT INTO super_categoria VALUES('$nameSuper');";
        if (!doQuery($sql,$database)){
            return;
        }
        postSubCats($nameSuper,$subCats,$database);
    }

    function postSubCats($nameSuper,$subCats,$database){
        foreach($subCats as $subCat){
            if(!doesCatExist($subCat,$database)){
                $sql = "INSERT INTO Categoria VALUES('$subCat');";
                if (!doQuery($sql,$database)){
                    return;
                }
                $sql = "INSERT INTO Categoria_Simples VALUES('$subCat');";
                if (!doQuery($sql,$database)){
                    return;
                }
            }
            $sql = "INSERT INTO Constituida VALUES('$nameSuper','$subCat');";
            if (!doQuery($sql,$database)){
                return;
            }
        }
    }

    $nameSuper = $_REQUEST['NomeCategoria'];

    if ($nameSuper == "") {
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b> [ERRO] NomeCategoria vazio</p>
        </div>");
        echo("<button class=\"ink-button orange\"  onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }

    $numberSub = $_REQUEST['SubCategorias'];
    $subCats = array();

    $int = intval($numberSub); 
    for($i = 1; $i <= $int; ++$i) {
        $index = $i;
        $string = 'SubCategoria'.$index;
        $value = $_REQUEST[$string];
        if($value != $nameSuper && $value != ""){
            array_push($subCats,$value);   
        }
    }
    if(count($subCats) == 0){
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b> [ERRO] Insira sub categorias validas</p>
        </div>");
        echo("<button class=\"ink-button orange\"  onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
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

        if(doesCatExist($nameSuper,$db)){
            $db->query("ROLLBACK;");
            echo("<div class=\"ink-alert basic error\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Erro:</b> [ERRO] A categoria que pertende inserir ja existe</p>
            </div>");
            echo("<button class=\"ink-button orange\"  onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        postSuperCat($nameSuper,$subCats,$db);

        $db->query("COMMIT;");

        $db = null;

        if(!hadProblem){
            echo("<div class=\"ink-alert basic success\" role=\"alert\">
            <button class=\"ink-dismiss\">&times;</button>
            <p><b>Sucesso:</b> Insercao foi um sucesso</p>
            </div>");
        }
        echo("<button class=\"ink-button orange\"  onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $db->query("ROLLBACK;");
        echo("<div class=\"ink-alert basic error\" role=\"alert\">
        <button class=\"ink-dismiss\">&times;</button>
        <p><b>Erro:</b> ERROR: {$e->getMessage()}</p>
        </div>");
        echo("<button class=\"ink-button orange\"  onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
