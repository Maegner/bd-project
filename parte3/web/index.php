<html>

    <style>
        html, body { margin: 0; padding: 0; }

        .QuerySet {
            width: 50%;
            background-color:yellow
        }

        .table {
            
        }

        .inputColumn {
            text-align: left;
        }

        .Query {
            background-color: white;
            text-align: center;
        }
    </style>
    <title>Projeto BD</title>
    <body background="servers.jpg">

        <div id = "Container">

            <div class = "QuerySet">
                <!--Adicionar e remover categorias-->
                <div id = "Query1" class = "Query" style="float:left">
                    <h3>Adicionar ou remover categoria</h3>

                    <form action="categoria.php" method="post">
                        <table style="text-align: right;">
                            <tr>
                                <td>Nova categoria: </td>
                                <td class="inputColumn"><input type="text" name="NomeCategoria"/></td> 
                            </tr>
                            <tr>
                                <td>Remover: </td>
                                <td class="inputColumn"><input type="checkbox" name="RemoverCategoria"/></td> 
                            </tr>
                        </table>
                        <p> <input type="submit" value="Submit"/> </p>
                    </form>
                </div>

                <!--Adicionar e remover produtos-->
                <div id = "Query2" class = "Query" style="float:left">
                    <h3>Adicionar ou remover produto</h3>

                    <form action="produto.php" method="post">
                        <table style="text-align: right;">
                            <tr>
                                <td>EAN: </td>
                                <td class="inputColumn"><input type="text" name="EAN"/></td> 
                            </tr>
                            <tr>
                                <td>Designação: </td>
                                <td class="inputColumn"><input type="text" name="Designacao"/></td> 
                            </tr>
                            <tr>
                                <td>Categoria: </td>
                                <td class="inputColumn"><input type="text" name="Categoria"/></td> 
                            </tr>
                            <tr>
                                <td>Fornecedor Primário: </td>
                                <td class="inputColumn"><input type="text" name="FornecedorPrimario"/></td> 
                            </tr>
                            <tr>
                                <!--????-->
                                <td>Fornecedores Secundários: </td>
                                <td class="inputColumn"><input type="text" name="FornecedoresSecundarios"/></td> 
                            </tr>
                            <tr>
                                <td>Data: </td>
                                <td class="inputColumn"><input type="text" name="DataProduto"/></td> 
                            </tr>
                            <tr>
                                <td>Remover</td>
                                <td class="inputColumn"><input type="checkbox" name="RemoverProduto"/></td> 
                            </tr>
                        </table>
                        <p> <input type="submit" value="Submit"/> </p>
                    </form>
                </div>

                <!--Listar reposicao de produto-->
                <div id = "Query3" class = "Query" style="float:left">
                    <h3> Listar reposição de um produto </h3>

                    <form action="reposicao.php" method="post">
                        <table style="text-align: right;">
                            <tr>
                                <td>EAN: </td>
                                <td class="inputColumn"><input type="text" name="EAN_Reposicao"/></td> 
                            </tr>
                        </table>
                        <p> <input type="submit" value="Submit"/> </p>
                    </form>
                </div>

            </div>

            <div class = "QuerySet" style="clear: left">
                <!--Alterar designacao de produto-->
                <div id = "Query4" class = "Query" style="float:left">
                    <h3> Alterar designação de um produto </h3>

                    <form action="designacao.php" method="post">
                        <table style="text-align: right;">
                            <tr>
                                <td>EAN: </td>
                                <td class="inputColumn"><input type="text" name="EAN_Reposicao"/></td> 
                            </tr>
                            <tr>
                                <td>Designação: </td>
                                <td class="inputColumn"><input type="text" name="NovaDesignacao"/></td> 
                            </tr>
                        </table>
                        <p> <input type="submit" value="Submit"/> </p>
                    </form>
                </div>

                <!--Listar sub-categorias-->
                <div id = "Query5" class = "Query" style="float:left">
                    <h3> Listar sub-categorias de uma categoria </h3>

                    <form action="subCategorias.php" method="post">
                        <table style="text-align: right;">
                            <tr>
                                <td>Categoria: </td>
                                <td class="inputColumn"><input type="text" name="SuperCategoria"/></td> 
                            </tr>
                        </table>
                        <p> <input type="submit" value="Submit"/> </p>
                    </form>
                </div>

            </div>

        </div>

    </body>
</html>
