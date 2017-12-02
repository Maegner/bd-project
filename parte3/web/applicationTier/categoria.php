<html>
    <head>
        <meta charset="utf-8">
        <title> Projeto de BD </title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
<?php

    function exists($name,$db){
        $sql = "SELECT * FROM Categoria WHERE nome = '$name';";
        $result = $db->query($sql);
        if($result->rowCount()!= 0){
            return true;
        }
        return false;
    }

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

        if(exists($nomeCategoria,$db)){
            echo("<p>[ERRO] A categoria que pertende inserir ja existe</p>");
            echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");1
            return;
        }


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
