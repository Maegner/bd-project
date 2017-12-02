<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php

    $hadProblem = false;

    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['NovaDesignacao'];

    if ($ean == "") {
        echo("<p>[ERRO] EAN vazio<p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
        return;
    }
    if ($designacao == "") {
        echo("<p>[ERRO] Designação vazio<p>");
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

        $exists = "SELECT FROM Produto WHERE ean = '$ean';";
        $result = $db->query($exists);

        if($result->rowCount()==0){
            $db->query("ROLLBACK;");
            echo("<p>[ERRO] Nao existe produto com o ean especificado<p>");
            echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
            return;
        }

        $sql = "UPDATE Produto
                SET design = '$designacao'
                WHERE ean = '$ean';";

        $db->query($sql);

        $db->query("COMMIT;");

        $db = null;

        if(!hadProblem){
            echo("<p> Atualzação efectuada com sucesso </p>");
        }

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
