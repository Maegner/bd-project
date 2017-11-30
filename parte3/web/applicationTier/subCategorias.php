<html>
    <body>
<?php
    function fetchSubCategory($superCategory) {
        $sql = "SELECT *
                FROM Constituida
                WHERE super_categoria = '$superCategory'"
                ;
        $result = $db->query($sql);

        foreach($result as $row) {
            $categoryList->push($row['categoria']);
            fetchSubCategory($row['categoria']);
        }
    }

    $superCat = $_REQUEST['SuperCategoria'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxx";
        $password = "xxxxxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $categoryList = new SplDoublyLinkedList();
        fetchSubCategory($superCat);

        echo("<table border=\"0\" cellspacing=\"5\">\n");
        for($categoryList->rewind();$categoryList->valid();$categoryList->next())
        {
            echo("<tr>\n");
            echo("<td>{$dlist->current()}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");

        $db->query("commit;");

        $db = null;
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
?>
    </body>
</html>
