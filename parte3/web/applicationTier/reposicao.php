<html>
<head>
    <meta charset="utf-8">
    <title> Projeto de BD </title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
<?php
    $ean = $_REQUEST['EAN_Reposicao'];

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

        $sql = "SELECT * FROM Reposicao WHERE ean = '$ean';";
                
        $result = $db->query($sql);

        if($result->rowCount()==0){
            echo ("<p> Nenhuma reposicao encontrada para o produto com EAN = {$ean}");
        }

        echo("<table border=\"0\" cellspacing=\"5\">\n");
        foreach($result as $row)
        {
            echo("<tr>\n");
            echo("<td>{$row['ean']}</td>\n");
            echo("<td>{$row['nro']}</td>\n");
            echo("<td>{$row['lado']}</td>\n");
            echo("<td>{$row['altura']}</td>\n");
            echo("<td>{$row['operador']}</td>\n");
            echo("<td>{$row['instante']}</td>\n");
            echo("<td>{$row['unidades']}</td>\n");
            echo("</tr>\n");
        }
        echo("</table>\n");

        $db = null;

        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
    catch (PDOException $e)
    {
        echo("<p>ERROR: {$e->getMessage()}</p>");
        echo("<button onclick='window.history.back()' style='float:left; clear:both'>Voltar</button>");
    }
?>
    </body>
</html>
