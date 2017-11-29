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
            width: 350px;
        }
    </style>

    <script>
        function updateSec() {
            var table = document.getElementById("TabelaProduto");
            var row = document.getElementById("PrimeiroSecundario");
            var numberOfSecs = document.getElementById("secondaryNumber").value;
            var limite = document.getElementById("FornecedorLimit");

            var firstRow = table.rows[6];
            while (firstRow.className == "FornecedorSec") {
                table.deleteRow(6);
                firstRow = table.rows[6];
            }

            for (var i = 0; i < numberOfSecs-1; ++i) {
                var newRow = row.cloneNode(true);
                newRow.children[1].children[0].name = "FornecedorSecundario".concat((i+2).toString());
                newRow.children[0].innerHTML = "Fornecedor Secundario ".concat((i+2).toString(), ":");
                var index = 6 + i;
                table.children[0].insertBefore(newRow, table.children[0].children[index]);
            }
        }
    </script>
    <title>Projeto BD</title>
    <body background="servers.jpg">

        <div id = "Container">

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
                    <table id="TabelaProduto" style="text-align: right;">
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
                            <td>Fornecedores Secundários: </td>
                            <td class="inputColumn"><input type="number" name="FornecedoresSecundarios" min="1" onchange="updateSec()" id="secondaryNumber"></td> 
                        </tr>
                        <tr id="PrimeiroSecundario" class="FornecedorSec">
                            <td>Fornecedor Secundário 1: </td>
                            <td class="inputColumn"><input type="text" name="FornecedorSecundario1"/></td> 
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

    </body>
</html>
