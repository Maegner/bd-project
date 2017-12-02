<html>
    <head>
        <meta charset="utf-8">
        <title> Projeto de BD </title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
<?php
    $nomeCategoria = $_REQUEST['NomeCategoria'];

    if ($nomeCategoria == "") {
        echo("<p>NomeCategoria vazio<p>");
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

        $sql = "INSERT INTO Categoria VALUES('$nomeCategoria');";

        $db->query($sql);

        $db->query("commit;");

        $db = null;

        echo("<p>Insercao foi um sucesso</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        #$db->query("rollback;");
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
