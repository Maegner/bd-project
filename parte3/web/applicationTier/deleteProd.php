<html>
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
        $sql = "DELETE FROM Produto WHERE ean = '$ean';";
        doQuery($sql,$db);
        $end = "COMMIT;";
        doQuery($end,$db);

        $db = null;

        echo("<p> Remoção efectuada com sucesso </p>");

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
