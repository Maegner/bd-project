<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php
    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['NovaDesignacao'];

    if ($ean == "") {
        echo("<p>EAN vazio<p>");
        return;
    }
    if ($designacao == "") {
        echo("<p>Designação vazio<p>");
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

        $db->query("START TRANSACTION;");

        $sql = "UPDATE Produto
                SET design = '$designacao'
                WHERE ean = '$ean';";

        $db->query($sql);

        $db->query("COMMIT;");

        $db = null;

        echo("<p> Atualzação efectuada com sucesso </p>");
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
