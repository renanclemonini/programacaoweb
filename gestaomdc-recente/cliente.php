<?php
    require_once('./modelo/cliente.php');
    $objCliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Clientes</title>
</head>
<body>
    <?php
    
        include('navegacao.php')
    
    ?>
    <div class="container">
        <h2 class="my-3">Lista dos Clientes</h2>
        <p>Cadastro de Clientes para o banco de dados</p>
        <p>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Novo Cliente</button>
        </p>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Telefone</th>
                    <th class="text-center">Aniversário</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt = $objCliente->read();
                    $stmt->execute();
                    while ($objCliente = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objCliente['id']; ?>
                            </td>
                            <td>
                                <?php echo $objCliente['nome']; ?>
                            </td>
                            <td>
                                <?php echo $objCliente['telefone']; ?>
                            </td>
                            <td>
                                <?php echo $objCliente['aniversario']; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning"
                                data-toggle="modal" 
                                data-target="#myModalEditar" 
                                data-id="<?php echo $objCliente['id']; ?>"
                                data-nome="<?php echo $objCliente['nome']; ?>"
                                data-telefone="<?php echo $objCliente['telefone']; ?>"
                                data-aniversario="<?php echo $objCliente['aniversario']; ?>">Editar</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#myModalDelete" 
                                data-id="<?php echo $objCliente['id']; ?>"
                                data-nome="<?php echo $objCliente['nome']; ?>"> Deletar </button> 
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <!-- Modal Cadastro -->
        <div class="modal" id="myModal">
            
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Novo Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_cliente.php" method="post">
                            <input type="hidden" name="insert">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="nome" name="txtNome">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" placeholder="Digite seu telefone" id="telefone" name="txtTelefone" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)">
                            </div>
                            <div class="form-group">
                                <label for="aniversario">Aniversário:</label>
                                <input type="text" class="form-control" placeholder="Digite seu aniversário" id="aniversario" name="txtAniversario" maxlength="10"  onkeypress="formatar('##/##/####',this)">
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    </div>

                </div>
            </div>
        </div>

    <!-- Modal Editar -->
    <div class="modal" id="myModalEditar">
            
        <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_cliente.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="recipient-nome" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" placeholder="Digite seu telefone" id="recipient-telefone" name="telefone" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)">
                            </div>
                            <div class="form-group">
                            <label for="aniversario">Aniversário:</label>
                                <input type="text" class="form-control" placeholder="Digite seu aniversário" id="recipient-aniversario" name="aniversario" maxlength="10"  onkeypress="formatar('##/##/####',this)">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal Delete -->
    <div class="modal" id="myModalDelete">
        
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark" style="color: #fff;">
                    <h4 class="modal-title">Deletar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./controle/ctr_cliente.php" method="post">
                        <input type="hidden" name="delete">
                        <input type="hidden" name="txtId" id="recipient-id" readonly>
                        <div class="form-group">
                            <label for="nome">Tem certeza que deseja deletar??</label>
                            <input type="text" name="nome" id="recipient-nome">
                        </div>
                        <button type="submit" class="btn btn-primary">Deletar</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientNome = button.data('nome');

            var modal = $(this);
            modal.find('#recipient-id').val(recipientId);
            modal.find('#recipient-nome').val(recipientNome);
        });
    </script>
    <script>
        $('#myModalEditar').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientNome = button.data('nome');
            var recipientTelefone = button.data('telefone');
            var recipientAniversario = button.data('aniversario');

            var modal = $(this);
            modal.find('#recipient-nome').val(recipientNome);
            modal.find('#recipient-telefone').val(recipientTelefone);
            modal.find('#recipient-aniversario').val(recipientAniversario);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>
    <script>  
        function formatar(mascara, documento) {
            let i = documento.value.length;
            let saida = '#';
            let texto = mascara.substring(i);
            while (texto.substring(0, 1) != saida && texto.length ) {
            documento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
            }
        }
    </script>
</body>

</html>