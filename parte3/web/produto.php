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

    $fornecedores_sec = array();
    $int = intval($secundarios);
    for($i = 0; $i < $int; ++$i) {
        $index = $i + 1;
        $string = 'FornecedorSecundario'.$index;
        echo("<script>console.log($string)</script>");
        array_push($fornecedores_sec, $string);
    }

    try
    {
        $host = "db.ist.utl.pt";
        $user ="istxxxxx";
        $password = "xxxxxxx";
        $dbname = $user;
        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($remover != "on") {
            $sql = "INSERT INTO Produto(ean, categoria, forn_primario, design, data)
                    VALUES ($ean, $categoria, $primario, $designacao, $data);"
            ;
        }// Tem de fazer input de um fornecedor secundario tbem RI-RE3​: Todo o EAN​ de produto​ tem de existir na relação fornece_sec
        else {
            $sql = "DELETE FROM Produto
                    WHERE ean = $ean;"
            ;
        }

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
