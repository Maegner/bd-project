<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
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
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }
    $ean = $_REQUEST['EAN'];

    if ($ean == "") {
        echo("<p>[ERRO]EAN vazio<p>");
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

        $exists = "SELECT FROM Produto WHERE ean = '$ean';";
        $result = $db->query($exists);

        if($result->rowCount()==0){
            $rollback = "ROLLBACK;";
            doQuery($rollback,$db);
            echo("<p>[ERRO] Nao existe produto com o ean especificado<p>");
            echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        $sql = "DELETE FROM Produto WHERE ean = '$ean';";
        doQuery($sql,$db);
        $end = "COMMIT;";
        doQuery($end,$db);

        $db = null;

        if(!$hadProblem){
            echo("<p> Remoção efectuada com sucesso </p>");
        }
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $rollback = "ROLLBACK;";
        doQuery($rollback,$db);
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
