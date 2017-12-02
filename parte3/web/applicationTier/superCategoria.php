<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php

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
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }

    function postSuperCat($nameSuper,$subCats,$database){
        $sql = "INSERT INTO Categoria VALUES('$nameSuper');";
        doQuery($sql,$database);
        $sql = "INSERT INTO super_categoria VALUES('$nameSuper');";
        doQuery($sql,$database);
        postSubCats($nameSuper,$subCats,$database);
    }

    function postSubCats($nameSuper,$subCats,$database){
        foreach($subCats as $subCat){
            if(!doesCatExist($subCat,$database)){
                $sql = "INSERT INTO Categoria VALUES('$subCat');";
                doQuery($sql,$database); 
            }
            $sql = "INSERT INTO Constituida VALUES('$nameSuper','$subCat');";
            doQuery($sql,$database);
        }
    }

    $nameSuper = $_REQUEST['NomeCategoria'];

    if ($nameSuper == "") {
        echo("<p>NomeCategoria vazio<p>");
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

   try
    {
        $host = "db.ist.utl.pt";
        $user ="ist426019";
        $password = "lvng0049";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(doesCatExist($nameSuper,$db)){
            echo("<p>[ERRO] A categoria que pertende inserir ja existe</p>");
            echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        postSuperCat($nameSuper,$subCats,$db);

        $db = null;

        echo("<p>Insercao foi um sucesso</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
