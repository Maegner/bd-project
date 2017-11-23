<html>
    <body>
<?php
    $nomeCategoria = $_REQUEST['NomeCategoria'];
    $remover = $_REQUEST['RemoverCategoria'];

    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxx";
        $password = "xxxxxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->query("Inserir categoria;");

        //REVER SYNTAX!!
        if ($remover != "on") {
            $sql = "INSERT INTO Categoria(nome)
                    VALUES ('$nomeCategoria');"
                    ;
        }
        else {
            $sql = "DELETE FROM Categoria
                    WHERE nome = '$nomeCategoria';"
            ;
        }

        echo("<p>$sql</p>");

        $db->query($sql);

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
