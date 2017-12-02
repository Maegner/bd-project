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
            }
            $sql = "INSERT INTO Constituida VALUES('$nameSuper','$subCat');";
            if (!doQuery($sql,$database)){
                return;
            }
        }
    }

    $nameSuper = $_REQUEST['NomeCategoria'];

    if ($nameSuper == "") {
        echo("<p> [ERRO] NomeCategoria vazio<p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
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
        echo("<p> [ERRO] Insira sub categorias validas");
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

        if(doesCatExist($nameSuper,$db)){
            $db->query("ROLLBACK;");
            echo("<p>[ERRO] A categoria que pertende inserir ja existe</p>");
            echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        postSuperCat($nameSuper,$subCats,$db);

        $db->query("COMMIT;");

        $db = null;

        echo("<p>Insercao foi um sucesso</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $db->query("ROLLBACK;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
