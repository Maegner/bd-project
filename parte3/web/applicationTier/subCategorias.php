<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php
    function fetchSubCategory($superCategory,$db,$categoryList) {

        echo("<script>console.log('in')</script>");

        $sql = "SELECT *
                FROM Constituida
                WHERE super_categoria = '$superCategory';";
        $result = $db->query($sql);

        if($result->rowCount() == 0){
            return $categoryList;
        }

        foreach($result as $row) {
            $categoryList->push($row['categoria']);
            $categoryList = fetchSubCategory($row['categoria'],$db,$categoryList);
        }
        return $categoryList;
    }

    $superCat = $_REQUEST['SuperCategoria'];

    if ($superCat == "") {
        echo("<p>SuperCategoria vazio<p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
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

        $categoryList = new SplDoublyLinkedList();
        $categoryList = fetchSubCategory($superCat,$db,$categoryList);

        echo("<table border=\"0\" cellspacing=\"5\">\n");
        for($categoryList->rewind();$categoryList->valid();$categoryList->next())
        {
            echo("<tr>\n");
            echo("<td>{$categoryList->current()}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");

        $db = null;

        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        $db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
