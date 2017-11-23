<html>
    <body>
<?php
    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['Designacao'];
    $categoria = $_REQUEST['Categoria'];
    $primario = $_REQUEST['FornecedorPrimario'];
    $secundarios = $_REQUEST['FornecedoresSecundarios'];
    $data = $_REQUEST['DataProduto'];
    $remover = $_REQUEST['RemoverProduto'];

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
            $sql = "INSERT INTO Produto(ean, design, categoria, forn_primario, data)
                    VALUES ($ean, $designacao, $categoria, $primario, $data);"
            ;
        }
        else {
            $sql = "DELETE FROM Produto
                    WHERE ean = $ean;"
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
