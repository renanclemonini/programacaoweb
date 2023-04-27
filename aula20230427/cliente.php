<?php
require_once('./modelo/cliente.php');
$objCliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="en">

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
        <h2 class="text-center m-3">Lista dos Clientes</h2>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Idade</th>
                    <th class="text-center">CPF</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "select * from cliente";
                    $stmt = $objCliente->runQuery($query);
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
                                <?php echo $objCliente['idade']; ?>
                            </td>
                            <td>
                                <?php echo $objCliente['cpf']; ?>
                            </td>
                            <td><button type="button" class="btn btn-warning">Editar</button></td>
                            <td><button type="button" class="btn btn-danger" 
                            data-toggle="modal" 
                            data-target="#myModalDelete" 
                            data-id="<?php echo $objCliente['id']; ?>"
                            data-nome="<?php echo $objCliente['nome']; ?>"> Deletar </button> </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <p>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Cadastrar</button>
        </p>
        <div class="modal" id="myModal">
            <!-- Modal Cadastro -->
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
                                <label for="idade">Idade:</label>
                                <input type="number" class="form-control" placeholder="Digite sua idade" id="idade" name="txtIdade">
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="number" class="form-control" placeholder="Digite seu CPF" id="cpf" name="txtCpf">
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

        <div class="modal" id="myModalDelete">
            <!-- Modal Delete -->
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
                                <input type="hidden" class="form-control" placeholder="Digite seu nome" id="recipient-nome" name="txtNome" readonly>

                            </div>
                            <button type="submit" class="btn btn-primary">Deletar</button>
                        </form>
                    </div>

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
</body>

</html>