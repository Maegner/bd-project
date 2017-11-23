<html>
    <body>
        <!--
        <h3>Change balance for account <?=$_REQUEST['account_number']?></h3>

        <form action="update.php" method="post">
            <p><input type="hidden" name="account_number" value="<?=$_REQUEST['account_number']?>"/></p>
            <p>New balance: <input type="text" name="balance"/></p>
            <p><input type="submit" value="Submit"/></p>
        </form>
        -->


        <!--Adicionar e remover categorias-->
        <div id = "Query1" class = "Query">
            <h3>Adicionar ou remover categoria</h3>

            <form action="categoria.php" method="post">
                <p> Nova categoria: <input type="text" name="NomeCategoria"/> </p>
                <p> Remover <input type="checkbox" name="RemoverCategoria"/></p>
                <p> <input type="submit" value="Submit"/> </p>
            </form>
        </div>

        <!--Adicionar e remover produtos-->
        <div id = "Query2" class = "Query">
            <h3>Adicionar ou remover produto</h3>

            <form action="produto.php" method="post">
                <p> EAN: <input type="text" name="EAN"/> </p>
                <p> Designação: <input type="text" name="Designacao"/> </p>
                <p> Categoria: <input type="text" name="Categoria"/> </p>
                <p> Fornecedor Primário: <input type="text" name="FornecedorPrimario"/> </p>
                <p> Data: <input type="text" name="DataProduto"/> </p>
                <!--<p> Fornecedores Secundários: <input type="text" name="FornecedoresSecundarios"/> </p>-->
                <p> Remover <input type="checkbox" name="RemoverProduto"/></p>
                <p> <input type="submit" value="Submit"/> </p>
            </form>
        </div>

        <!--Listar reposicao de produto-->
        <div id = "Query3" class = "Query">
            <h3> Listar reposição de um produto </h3>

            <form action="reposicao.php" method="post">
                <p> EAN: <input type="text" name="EAN_Reposicao"/> </p>
                <p> <input type="submit" value="Submit"/> </p>
            </form>
        </div>

        <!--Alterar designacao de produto-->
        <div id = "Query3" class = "Query">
            <h3> Alterar designação de um produto </h3>

            <form action="designacao.php" method="post">
                <p> EAN: <input type="text" name="EAN_Reposicao"/> </p>
                <p> Nova designação: <input type="text" name="NovaDesignacao"/> </p>
                <p> <input type="submit" value="Submit"/> </p>
            </form>
        </div>

        <!--Listar sub-categorias-->
        <div id = "Query3" class = "Query">
            <h3> Listar sub-categorias de uma categoria </h3>

            <form action="subCategorias.php" method="post">
                <p> Categoria: <input type="text" name="SuperCategoria"/> </p>
                <p> <input type="submit" value="Submit"/> </p>
            </form>
        </div>


    </body>
</html>
