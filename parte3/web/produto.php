<html>
    <body>
<?php

    function isRealDate($date) { 
        if (false === strtotime($date)) { 
            return false;
        } 
        list($year, $month, $day) = explode('-', $date); 
        return checkdate($month, $day, $year);
    }

    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['Designacao'];
    $categoria = $_REQUEST['Categoria'];
    $primario = $_REQUEST['FornecedorPrimario'];
    $secundarios = $_REQUEST['FornecedoresSecundarios'];
    $data = $_REQUEST['DataProduto'];
    $remover = $_REQUEST['RemoverProduto'];

    if(!isRealDate($data)){
        echo("<p>ERROR: date inserted is not valid please insert in format YYYY-MM-DD</p>");
    }
    else{
        try
        {
            $host = "db.ist.utl.pt";
            $user ="istxxxxx";
            $password = "xxxxxxx";
            $dbname = $user;
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
                if ($remover != "on") {
                    $sql = "INSERT INTO Produto
                            VALUES ('$ean', '$categoria', '$primario', '$designacao', '$data');"
                    ;
                }// Tem de fazer input de um fornecedor secundario tbem RI-RE3​: Todo o EAN​ de produto​ tem de existir na relação fornece_sec
                else {
                    $sql = "DELETE FROM Produto
                            WHERE ean = $ean;"
                    ;
                }
    
            $db->query($sql);
    
    
            $db = null;
        }
        catch (PDOException $e)
        {
            $db->query("rollback;");
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
    }

    
?>
    </body>
</html>
