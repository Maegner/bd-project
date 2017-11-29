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
    
    function postSecondarySuppliers($supliers,$ean,$database){
        $sups = explode(";",$supliers);

        foreach($sups as $suplier){

            echo("<p>{$suplier}</p>");

            $request = "INSERT INTO Fornecedor_secundario VALUES('$suplier','$ean');";

            try{
                $database->query($request);
            }

            catch(Exception $e){
                echo("<p>ERROR: {$e->getMessage()}</p>");
            }

        }
    }

    function postProduct($ean,$designacao,$categoria,$primario,$secundarios,$data,$database){
        $sql = "INSERT INTO Produto VALUES('$ean', '$categoria', '$primario', '$designacao', '$data');";
        
        try{
            $database->query($sql);
        }

        catch(Exception $e){
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
        echo("<p>{$secundarios}</p>");
        postSecondarySuppliers($secundarios,$ean,$database);
    }

    function postPrimarySupplier($primario,$database){
        $sql = "SELECT * FROM Fornecedor WHERE nif = '$primario';"
        $result = $database->query($sql);

        if(!$result){
            $sql = "INSERT INTO Fornecedor "
        }
    }


    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['Designacao'];
    $categoria = $_REQUEST['Categoria'];
    $primario = $_REQUEST['FornecedorPrimario'];
    $secundarios = $_REQUEST['Fornecedores Secundarios separados por ;'];
    $data = $_REQUEST['DataProduto'];
    $remover = $_REQUEST['RemoverProduto'];

    if(!isRealDate($data)){
        echo("<p>ERROR: date inserted is not valid please insert in format YYYY-MM-DD</p>");
    }
    else{
        try
        {
            $host = "db.ist.utl.pt";
            $user ="ist426018";
            $password = "pmke4417";
            $dbname = $user;
            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
                if ($remover != "on") {
                    postProduct($ean,$designacao,$categoria,$primario,$secundarios,$data,$db);
                }// Tem de fazer input de um fornecedor secundario tbem RI-RE3​: Todo o EAN​ de produto​ tem de existir na relação fornece_sec
                else {
                    $sql = "DELETE FROM Produto
                            WHERE ean = $ean;";
                }
            $db = null;
        }
        catch (Exception $e)
        {
            echo("<p>ERROR: {$e->getMessage()}</p>");
        }
    }

    
?>
    </body>
</html>
