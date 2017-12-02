<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php

    function doQuery($query,$database){
        try{
            $database->query($query);
        }

        catch(PDOException $e){
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }
    $ean = $_REQUEST['EAN'];

    if ($ean == "") {
        echo("<p>EAN vazio<p>");
        return;
    }

    try
    {
        $host = "db.ist.utl.pt";
        $user ="ist426019";
        $password = "lvng0049";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $start = "START TRANSACTION;";
        doQuery($start,$db);
        $sql = "DELETE FROM Produto WHERE ean = '$ean';";
        doQuery($sql,$db);
        $end = "COMMIT;";
        doQuery($end,$db);

        $db = null;

        echo("<p> Remoção efectuada com sucesso </p>");
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
