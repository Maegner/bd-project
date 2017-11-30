<html>
    <body>
<?php
    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['NovaDesignacao'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxx";
        $password = "xxxxxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("START TRANSACTION;");

        $sql = "UPDATE Produto
                SET design = '$designacao'
                WHERE ean = '$ean';"
        ;

        $db->query($sql);

        $db->query("COMMIT;");

        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("ROLLBACK;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
