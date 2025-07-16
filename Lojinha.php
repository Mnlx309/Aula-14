<?php
    /*criar um programa com as opções:
1. Adicionar Produto
2. Adicionar Cliente
3. Editar Cliente
4. Editar Produto
5. Deletar Cliente
6. Deletar Produto 
7. Novo Pedido
*/

$host = 'localhost';
$usuario = 'root';
$senha = '123456';
$banco = 'excalidraw';
$option = "";

$conexao = mysqli_connect($host,$usuario,$senha,$banco);
   if(!$conexao)
    {
        die("Falha na Conexão:" . mysqli_connect_error());
    } 
    echo "Conexão Realizada com Sucesso!\n";
    function addproduto($conexao)
    {
        //1. Adicionar Produto - OK
        $nomeproduto = readline ("Informe o Produto a Ser adicionado: ");
        $estoque = readline ("Informe a Quantidade Disponibilizada em Estoque: ");
        $Valorun = readline ("Informe o Valor Unitário: ");
        $Caracteristicas = readline ("Informe as Características do Produto: ");
        $Id_Categoria = readline ("Informe a Categoria do Produto\n 1 | EletroDomésticos\n2 | Casa\n3 | Roupas\n4 | Ferramentas");
        $addprod = "INSERT INTO produtos(Nome_Produto,Quantidade_Estoque,Valor_Unitário,Características,Id_Categoria) 
        VALUES('$nomeproduto',$estoque,$Valorun,'$Caracteristicas',$Id_Categoria)";
            if(mysqli_query($conexao,$addprod))
            {
                echo "Produto Adicionado com Sucesso!";
                return;

            }
            else
            {
                echo "Erro:" . $addprod . "" . mysqli_connect_error($conexao);
            die();
            }
    }
    function addcliente($conexao)
    {
        //2. Adicionar Cliente - OK
        $nomecliente = readline ("Informe o Nome do Cliente: ");
        $email = readline("Informe o Email do Cliente: ");
        $telefone = readline ("Informe o Telefone do Cliente (xx)9...: ");
        $sexo = readline ("Informe o Sexo do Cliente('M'/'F'): ");
        $endereço = readline ("Informe o Endereço do Cliente (CEP + Cidade/Estado): ");
        $documento = readline ("Informe o Documento do Cliente (CPF): ");
        $addcliente = "INSERT INTO clientes (Nome,Email,Telefone,Sexo,Endereço,Documento)
        VALUES ('$nomecliente','$email','$telefone','$sexo','$endereço','$documento')";
        if(mysqli_query($conexao,$addcliente))
            {
               echo "Cliente Adicionado com Sucesso!";
               return;
            } 
        else
            {
                echo "Erro:" . $addcliente . "" . mysqli_connect_error($conexao);
            die();
            }
    }
    function editcliente($conexao)
    {
    //3. Editar Cliente 
    $show = mysqli_query($conexao, "SELECT Id_Cliente, Nome FROM clientes");
        if (mysqli_num_rows($show) > 0)
        {
            echo "Usuários cadastrados:\n";
          while($row = mysqli_fetch_assoc($show))
          {
            
            echo "ID: " . $row['Id_Cliente'] . " | Cliente: " . $row['Nome'] . "\n";
          }
        }
    $identify = readline ("Informe o Cliente a Ser Editado(Id_Cliente): ");
    $dado = readline ("Informe o Dado a ser Editado(Nome/Email/Telefone/Endereço): ");
        if($dado == 'Nome')
            {
                $novonome = readline ("Informe o Novo Nome do Cliente: ");
                $editnome = "UPDATE clientes SET Nome = '$novonome' WHERE Id_Cliente = '$identify'";
                if(mysqli_query($conexao,$editnome))
                    {
                        echo "Cliente Adicionado com Sucesso!";
                        return;
                    } 
                    else
                        {
                            echo "Erro:" . $editnome . "" . mysqli_connect_error($conexao);
                        die();
                        }
            }
            if($dado == 'Email')
            {
                $novoemail = readline ("Informe o Novo Email do Cliente: ");
                $editemail = "UPDATE clientes SET Email = '$novoemail' WHERE Id_Cliente = '$identify'";
                if(mysqli_query($conexao,$editemail))
                        {
                           echo "Email Modificado com Sucesso!";
                           return;
                        } 
        else
            {
                echo "Erro:" . $editemail . "" . mysqli_connect_error($conexao);
            die();
            }
            }
            if($dado == 'Telefone')
            {
                $novotelefone = readline ("Informe o Novo Telefone do Cliente: ");
                $edittelefone = "UPDATE clientes SET Telefone = '$novotelefone' WHERE Id_Cliente = '$identify'";
                if(mysqli_query($conexao,$edittelefone))
            {
                echo "Telefone Modificado com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $edittelefone . "" . mysqli_connect_error($conexao);
            die();
            }
            }
            if($dado == 'Endereço')
            {
                $novoend = readline ("Informe o Novo Endereço do Cliente: ");
                $editend = "UPDATE clientes SET Endereço = '$novoend' WHERE Id_Cliente = '$identify'";
                if(mysqli_query($conexao,$editend))
            {
                echo "Endereço Modificado com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $editend . "" . mysqli_connect_error($conexao);
            die();
            }
            }
    }
    function editprod($conexao)
    {
        $show = mysqli_query($conexao, "SELECT cod_produto, Nome_Produto FROM produtos");
        if (mysqli_num_rows($show) > 0)
        {
            echo "Produtos cadastrados:\n";
          while($row = mysqli_fetch_assoc($show))
          {
            
            echo "Código do Produto: " . $row['cod_produto'] . " | Produto: " . $row['Nome_Produto'] . "\n";
          }
        }
        $editprod = readline ("Informe o Produto a Ser Editado: ");
        $editcat = readline("Informe a Sessão a Ser Editada(Nome/Quantidade/Valor/Características/Categoria): ");
        If($editcat == 'Nome')
        {
            $novonprod = readline ("Informe o Novo Nome do Produto: ");
            $editnomeprod = "UPDATE produtos SET Nome_Produto = '$novonprod' WHERE Nome_Produto = '$editprod'";
                if(mysqli_query($conexao,$editnomeprod))
            {
               echo "Nome do Produto Modificado com Sucesso!";
               return;
            } 
        else
            {
                echo "Erro:" . $editnomeprod . "" . mysqli_connect_error($conexao);
            die();
            }
            }
      If($editcat == 'Quantidade')
        {
            $novaqt = readline ("Informe a Nova Quantidade do Produto: ");
            $editqtd = "UPDATE produtos SET Quantidade_Estoque = $novaqt WHERE Nome_Produto = '$editprod'";
                if(mysqli_query($conexao,$editqtd))
            {
                echo "Quantidade em Estoque Modificada com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $editqtd . "" . mysqli_connect_error($conexao);
            die();
            }
            }
        If($editcat == 'Valor')
        {
            $novovalor = readline ("Informe o Novo Valor Unitário do Produto: ");
            $editvalor = "UPDATE produtos SET Valor_Unitário = $novovalor WHERE Nome_Produto = '$editprod'";
                if(mysqli_query($conexao,$editvalor))
            {
                echo "Quantidade em Estoque Modificada com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $editvalor . "" . mysqli_connect_error($conexao);
            die();
            }
            }
        If($editcat == 'Características')
        {
            $novocarac = readline ("Informe as Novas Características do Produto: ");
            $editcarac = "UPDATE produtos SET Características = '$novocarac' WHERE Nome_Produto = '$editprod'";
                if(mysqli_query($conexao,$editcarac))
            {
                echo "Quantidade em Estoque Modificada com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $editcarac . "" . mysqli_connect_error($conexao);
            die();
            }
            }
        If($editcat == 'Categoria')
        {
            $novocateg = readline ("Informe a Nova Categoria do Produto (1/2/3/4/5): ");
            $editcateg = "UPDATE produtos SET Id_Categoria = $novocateg WHERE Nome_Produto = '$editprod'";
                if(mysqli_query($conexao,$editcateg))
            {
                echo "Quantidade em Estoque Modificada com Sucesso!";
                return;
            } 
        else
            {
                echo "Erro:" . $editcateg . "" . mysqli_connect_error($conexao);
            die();
            }
            }
        }
        function deleteclient($conexao)
        {
            //5. Deletar Cliente
            $show = mysqli_query($conexao, "SELECT Id_Cliente, Nome FROM clientes");
        if (mysqli_num_rows($show) > 0)
        {
            echo "Clientes cadastrados:\n";
          while($row = mysqli_fetch_assoc($show))
          {
            
            echo "ID: " . $row['Id_Cliente'] . " | Cliente: " . $row['Nome'] . "\n";
          }
        }
        $deleteclient = readline ("Informe o Cliente a ser removido (Informe o Id_cliente): ");
        $delete = "DELETE FROM clientes WHERE Id_cliente = '$deleteclient'";
        if (mysqli_query($conexao,$delete))
    {
        echo "Registro Excluído com Sucesso";
    }
    else
    {
        echo "Erro:" . $delete . "" . mysqli_connect_error($conexao);
    }

        }
        function deleteproduto($conexao)
        {
            //6. Deletar Produto
            $show = mysqli_query($conexao, "SELECT cod_produto, Nome_Produto FROM produtos");
        if (mysqli_num_rows($show) > 0)
        {
            echo "Produtos cadastrados:\n";
          while($row = mysqli_fetch_assoc($show))
          {
            
            echo "ID: " . $row['cod_produto'] . " | Produto: " . $row['Nome_Produto'] . "\n";
          }
        }
        $deleteprod = readline ("Informe o Produto a ser removido (Informe o cod_produto): ");
        $deletepr = "DELETE FROM produtos WHERE cod_produto = $deleteprod";
        if (mysqli_query($conexao,$deletepr))
    {
        echo "Registro Excluído com Sucesso";
    }
    else
    {
        echo "Erro:" . $deletepr . "" . mysqli_connect_error($conexao);
    }

        }
        Function novopedido($conexao)
        //7. Novo Pedido
        {
             $show = mysqli_query($conexao, "SELECT Id_Cliente, Nome FROM clientes");
        if (mysqli_num_rows($show) > 0)
        {
            echo "Clientes cadastrados:\n";
          while($row = mysqli_fetch_assoc($show))
          {
            
            echo "ID: " . $row['Id_Cliente'] . " | Cliente: " . $row['Nome'] . "\n";
          }
        }
        {
            $idclientepedido = readline ("Informe o ID do cliente comprador: ");
            $valorvenda = readline ("Informe o Valor Total da Venda");
            $novavenda = "INSERT INTO pedidos (ID_Cliente_Pedido,Valor_Pedido) VALUES ($idclientepedido,$valorvenda)";
            if (mysqli_query($conexao,$novavenda))
    {
        echo "Venda Registrada com Sucesso!";
    }
    else
    {
        echo "Erro:" . $novavenda . "" . mysqli_connect_error($conexao);
    }
        }
    }
do
{
   $option = Readline ("\nEscolha uma Opção:\n1. Adicionar Produto\n2. Adicionar Cliente\n3. Editar Cliente\n4. Editar Produto\n5. Deletar Cliente\n6. Deletar Produto\n7. Novo Pedido\n8. Sair");
        If($option == 1)
        {
            addproduto($conexao);
        }
        If($option == 2)
        {
            addcliente($conexao);
        }
        If($option == 3)
        {
        editcliente($conexao);
        }
        If($option == 4)
        {
        editprod($conexao);
        }
        If($option == 5)
        {
        deleteclient($conexao);
        }
         If($option == 6)
         {
        deleteproduto($conexao);
         }
         If($option == 7)
         {
         novopedido($conexao);
         }
         If($option == 8)
         {
            echo "Fechado o Programa!";
            die();
         }
}
While($option != 8)

?>