<html>
    <body>
<?php

    function doQuery($query,$database){
        try{
            $database->query($query);
        }

        catch(PDOException $e){
            $rollback = "ROLLBACK;";
            doQuery($rollback,$db);
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }

    $nomeCategoria = $_REQUEST['NomeCategoria'];

    if ($nomeCategoria == "") {
        echo("<p>NomeCategoria vazio<p>");
        return;
    }

    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxx";
        $password = "xxxxxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $start = "START TRANSACTION;";
        doQuery($start,$db);

        $delCat = "DELETE FROM Categoria WHERE nome = '$nomeCategoria';";
        doQuery($delCat,$db);

        $end = "COMMIT;";
        doQuery($end,$db);

        $db = null;
    }
    catch (PDOException $e)
    {
        $rollback = "ROLLBACK;";
        doQuery($rollback,$db);
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
