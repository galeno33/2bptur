<?php
        //session_start();
        include ("../PhpArq/conexao.php");

        if(isset($_FILES['arquivo'])){
            $arquiv = $_FILES['arquivo'];
                //var_dump($_FILES);
            if($arquiv['error']){
                die("Falha ao enviar arquivo");
            }
                if($arquiv['size'] > 2097152){
                    die("Arquivo muito grande! Max: 2MB");
                }
                $pasta = "../../bptur_sistem/arqAud/";
                $nomeArquivo = $arquiv['name'];
                $novoNomeArquiv = uniqid();
                //extenção para identificar o tipo do arquivo a ser tratado
                $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                    if($extensao != "pdf"){
                        die("O arquivo não está em pdf, por favor converta-o para pdf.");
                    }
                    $carregado = move_uploaded_file($arquiv["tmp_name"], $pasta . $novoNomeArquiv  . "." . $extensao);
                        if($carregado){
                            //echo "arquivo carregado com sucesso!";
                            echo  "<script>alert('Arquivo enviado com Sucesso!');</script>";
                        }
        }
        
?>       
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audiências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bptur_sistem/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="aud.css">

</head>
<body>
    
    <header class="navbar navbar-dark bg-primary flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../../bptur_sistem/principal/home.html">2º BPTUR - BARRERINHAS</a>
       
       
                         <div class="col-sm-6" id="aud">
                            <!--tag para cadastrar produtos-->
                            <a href="#addEmployeeModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="material-icons">&#xE147;</i> <span>Lançar Audiencia</span></a>
                            <!--tag para deletar produtos-->
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>      
                        </div>
       
       
       
        <div>
                <!--<div class="page-header clearfix">-->
                   <!---<h2 class="pull-left">Users</h2>--->    
                   <!--<a href="../sevicos/LancaOrdens.php" class="btn btn-success pull-right">voltar</a>
                </div>-->
            </div>
        <!--<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>-->
        <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->
       
    </header>
        <table border = '2' class="table table-striped table-hover">
            <tr>
            <td>POSTO</td>
            <td>NOME DE GUERRA</td>
            <td>DATA</td>
            <td>HORA</td>
            <td>ARQUIVO</td>
            </tr>
        
                 
                
<?php

                    //substituir ordem_serviço pela tabela do banco de dados Audiencia
                    $sql = "SELECT * FROM ordem_servico";
                    $result = mysqli_query($conn, $sql) or die ("Erro ao tentar consultar ordens");

                        //if(($result) AND ($result->num_rows != 0)){
                            while($row = mysqli_fetch_assoc($result)){
                                //substituir
                                $ordem = $row['numero_ordem'];
                                $nomeCliente = $row['nome_cliente'];
                                $contato = $row['telefone'];
                                $produto = $row['produto'];
                                $detalhes = $row['detalhes_produto'];
                              
                                
                                echo "<tr>";
                                echo "<td>".$ordem."</td>";
                                echo "<td>".$nomeCliente."</td>";
                                echo "<td>".$contato."</td>";
                                echo "<td>".$produto."</td>";
                                echo "<td>".$detalhes."</td>";                              
                                echo "</tr>";
                                
                                
                            }
                           // mysqli_close($conn);
                        //}

       // echo "</table>";
            
?>
</table>    



        <!--iniciando Modal -->
        <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
        <div class="modal-content" >

            <div class="modal-header" >
                <h5 class="modal-title" id="ModalLabel">Lançamento de audiência</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>

               
                    <div class="modal-body">

                        <form class="p-4 p-md-5 border rounded-3 bg-light" id="form_cadastro" action="" method="POST" enctype="multipart/form-data">    

                            <!-------------------------Posto e Graduações----------------------------->
                            <div  class="col-md-4">
                                <label for="codigo" class="control-label">graduação</label>
                                <input type="text" name="posto" id="posto" class="form-control"> <!--type de text para numero-->
                            </div>

                            <!-------------------------nome---------------------------->
                            <div class="form-group">
                                <label for="produto" class="control-label">nome</label>
                                <input type="text" name="produto" id="produto" class="form-control">
                            </div>

                                <br>
                            <!----------------------------Tipos---------------------------->
                            <!-- <div class="form-group">
                                    <select for="tipos" class="form-select" id="tipos" name="tipos" required>
                                        <option selected disabled value="">Tipos..</option>
                                        <option>Polo</option>
                                        <option>camiseta</option>
                                        <option>....</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid state.
                                    </div>
                                </div>-->

                            <!-------------------------data da audiência------------------------------->
                            <div class="form-group">
                                <label for="preco" class="control-label">data</label>
                                <input type="date" id="data" name="data" lang="en" step="0.25" class="form-control">
                                <!---<input type="number" name="preco" id="preco" onchange="setTwoNumberDecimal" min="0" max="100" step="0.25" value="0.00" />-->
                            </div><!-----verificar o lançamento dos valores no banco de dados----->

                            <!-------------------------Hora da audiência------------------------------->
                            <div class="form-group">
                                <label for="detalhes" class="control-label">hora</label>
                                <input type="time" name="hora" id="hora" class="form-control">
                            </div>

                            <!------------------------butão do modal-------------------------->
                            <div class="modal-footer col-12" >
                            
                                    <!--butão de upload de arquivos pdf-->
                                    <input type="file" name="arquivo" class="btn btn-success" value="Arquivos">
                               
                                <input type="submit" class="btn btn-danger" data-bs-dismiss="modal" value="Fechar">
                                <input type="submit" name="upload" class="btn btn-primary"  value="Salvar">
                            </div>
                            
                       
                            
                        </form> 
                
                    </div>
               

        </div>
        </div>
        </div>

        <!--fim de modal-->



<script src="../../bptur_sistem/bootstrap/js/bootstrap.bundle.min.js"></script> 

</body>
</html>