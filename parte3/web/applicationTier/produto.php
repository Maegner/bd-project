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

    function doesSupplierExist($supplierNif,$database){
        $sql = "SELECT * FROM Fornecedor WHERE nif = '$supplierNif';";
        $result = $database->query($sql);

        if(($result->rowCount()==0)){
            return false;
        }
        return true;
    }

    function doQuery($query,$database){
        try{
            $database->query($query);
        }

        catch(PDOException $e){
            echo("<p>ERROR In Query({$query}): {$e->getMessage()}</p>");
        }
    }
    //TODO: Verificar quando os secondary supplier vem vazio
    function postSecondarySuppliers($supliers,$supliersName,$ean,$database){
        $sups = $supliers;
        $noms = $supliersName;
        $position = 0;

        if(count($sups) != count($noms) or count($sups) == 0 ){
            echo("<p>ERROR: Insert the correct number of names and nifs</p>");
        }

        foreach($sups as $suplier){

            if(!doesSupplierExist($suplier,$database)){
                
                $request = "INSERT INTO Fornecedor VALUES('$suplier','$noms[$position]');";
                doQuery($request,$database);
            }

            $request = "INSERT INTO Fornecedor_secundario VALUES('$suplier','$ean');";

            doQuery($request,$database);

            $position = $position + 1;

        }
    }

    function postProduct($ean,$designacao,$categoria,$primarioNif,$primarioNome,$secundarySuppliersNif,$secundarySuppliersName,$data,$database){
        
        postPrimarySupplier($primarioNif,$primarioNome,$database);
        $sql = "INSERT INTO Produto VALUES('$ean', '$categoria', '$primarioNif', '$designacao', '$data');";
        doQuery($sql,$database);
        postSecondarySuppliers($secundarySuppliersNif,$secundarySuppliersName,$ean,$database);

    }

    function postPrimarySupplier($primarioNif,$primarioNome,$database){
        if(! doesSupplierExist($primarioNif,$database)){
            $request = "INSERT INTO Fornecedor VALUES('$primarioNif','$primarioNome');";
            doQuery($request,$database);
        }
    }

    $ean = $_REQUEST['EAN'];
    $designacao = $_REQUEST['Designacao'];
    $categoria = $_REQUEST['Categoria'];
    $primarioNif = $_REQUEST['FornecedorPrimarioNif'];
    $primarioNome = $_REQUEST['FornecedorPrimarioNome'];
    $secundarios = $_REQUEST['FornecedoresSecundarios'];
 
    $data = $_REQUEST['DataProduto'];
    $remover = $_REQUEST['RemoverProduto'];

    echo("<script> console.log({$primarioNif})</script>");

    $secundarySuppliersNif = array();
    $int = intval($secundarios);
    for($i = 1; $i <= $int; ++$i) {
        $index = $i;
        $string = 'FornecedorSecundarioNif'.$index;
        $value = $_REQUEST[$string];
        if($value != primarioNif && $value != ""){
            array_push($secundarySuppliersNif,$value);   
        }
    }
    
        $i = 1;
        $secundarySuppliersName = array();
        $int = intval($secundarios);
        for($i = 1; $i <= $int; ++$i) {
            $index = $i;
            $string = 'FornecedorSecundarioNome'.$index;
            $value = $_REQUEST[$string];
            if($value != ""){
                array_push($secundarySuppliersName, $value);
            }
        }
        
    
    
        if(!isRealDate($data)){
            echo("<p>ERROR: date inserted is not valid please insert in format YYYY-MM-DD</p>");
        }
    
        else{
            try
            {
                $host = "db.ist.utl.pt";
                $user ="ist426018";
                $password = "egmk9483";
                $dbname = $user;
                $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
                    if ($remover != "on") {
                        postProduct($ean,$designacao,$categoria,$primarioNif,$primarioNome,$secundarySuppliersNif,$secundarySuppliersName,$data,$db);
                    }
                    else {
                        $sql = "DELETE FROM Produto
                                WHERE ean = $ean;";
                    }
                $db = null;
                echo("<p>Insercao foi um sucesso</p>");
            }
            catch (Exception $e)
            {
                echo("<p>ERROR GeneralArea: {$e->getMessage()}</p>");
            }
        }
    
    

    
?>
    </body>
</html>
