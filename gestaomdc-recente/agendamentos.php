<?php
    require_once('./modelo/servicos.php');
    $objServicos = new Servicos();

    require_once('./modelo/cliente.php');
    $objClientes = new Cliente();
    
    require_once('./modelo/agendamentos.php');
    $objAgendamentos = new Agendamentos();
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
    <header>
        <?php
        
            include('navegacao.php')
        
        ?>
    </header>

    <div class="container">
        <h2 class="my-3">Agendamentos</h2>
        <p>Lista de Agendamentos Realizados</p>
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Novo Agendamento
            </button>
        </div>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <!-- <th class="text-center">ID</th> -->
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Serviço</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Horário</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT a.id, a.idCliente AS 'idCliente', cli.nome AS 'Cliente', serv.id AS 'idServico', serv.nome AS 'Servico', a.dataAgendamento as 'Data', a.horarioAgendamento as 'Horario' FROM agendamentos a 
                    INNER JOIN clientes cli ON cli.id = a.idCliente 
                    INNER JOIN servicos serv ON serv.id = a.idServico ORDER BY a.dataAgendamento";
                    $stmt = $objAgendamentos->runQuery($sql);
                    $stmt->execute();
                    while ($objAgendamentos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td data-id="<?php echo $objAgendamentos['id']; ?>">
                                <?php echo $objAgendamentos['Cliente']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Servico']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Data']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Horario']; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning"
                                data-toggle="modal" 
                                data-target="#myModalEditar" 
                                data-id="<?php echo $objAgendamentos['id']; ?>"
                                data-idCliente="<?php echo $objAgendamentos['idCliente']; ?>"
                                data-cliente="<?php echo $objAgendamentos['Cliente']; ?>"
                                data-idServico="<?php echo $objAgendamentos['idServico']; ?>"
                                data-servico="<?php echo $objAgendamentos['Servico']; ?>"
                                data-agendamento="<?php echo $objAgendamentos['Data']; ?>"
                                data-horario="<?php echo $objAgendamentos['Horario']; ?>">
                                Editar</button> 
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#myModalDelete" 
                                data-id="<?php echo $objAgendamentos['id']; ?>"
                                data-nome="<?php echo $objAgendamentos['Cliente']; ?>"> Deletar </button> 
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
                    <h4 class="modal-title">Novo Agendamento</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./controle/ctr_agendamentos.php" method="post">
                        <input type="hidden" name="insert">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <br>
                            <select name="txtNome" id="nome">
                                <?php
                                    $sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Tel' FROM clientes";
                                    $stmt = $objClientes->runQuery($sql);
                                    $stmt->execute();
                                    while($objClientes = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $objClientes['Id'] ?>">
                                    <?php echo $objClientes['Nome']?> -
                                    <?php echo $objClientes['Tel']?>
                                </option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="servico">Serviço:</label>
                            <br>
                            <select name="txtServico" id="servico">
                                <?php
                                    $sql = "SELECT * FROM servicos ORDER BY nome";
                                    $stmt = $objServicos->runQuery($sql);
                                    $stmt->execute();
                                    while($objServicos = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $objServicos['id'] ?>"><?php echo $objServicos['nome'] ?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dataAgendamento">Data:</label>
                            <input type="date" class="form-control" id="dataAgendamento" name="txtData">
                        </div>
                        <div class="form-group">
                            <label for="horarioAgendamento">Data:</label>
                            <input type="time" class="form-control" id="horarioAgendamento" name="txtHorario">
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer"></div>
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
                        <form action="./controle/ctr_agendamentos.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id">
                            <input type="hidden" name="txtIdCliente" id="recipient-idCliente">
                            <div class="form-group">
                                <label for="recipient-cliente">Cliente:</label>
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="recipient-cliente" name="cliente" readonly>
                            </div>
                            <div class="form-group">
                                <label for="recipient-servico">Serviço:</label>
                                <input type="hidden" name="idServico" id="recipient-idServico">
                                <input type="text" class="form-control" placeholder="Digite serviço" id="recipient-servico" name="servico" readonly>
                            </div>
                            <div class="form-group">
                                <label for="recipient-dataAgendamento">Data:</label>
                                <input type="date" class="form-control" id="recipient-dataAgendamento" name="txtDataAgendamento">
                            </div>
                            <div class="form-group">
                                <label for="recipient-horarioAgendamento">Horario:</label>
                                <input type="time" class="form-control" id="recipient-horarioAgendamento" name="txtHorarioAgendamento">
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer"></div>
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
                    <form action="./controle/ctr_agendamentos.php" method="post">
                        <input type="hidden" name="delete">
                        <input type="hidden" name="txtId" id="recipient-id" readonly>
                        <div class="form-group">
                            <label for="nome">Tem certeza que deseja deletar este agendamento?</label>
                            <input type="hidden" name="nome" id="recipient-nome">
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <button type="submit" class="btn btn-primary">Deletar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer"></div>
                </div>

            </div>
        </div>
    </div>
    
    <!-- JQuery Delete -->
    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');

            var modal = $(this);
            modal.find('#recipient-id').val(recipientId);
        });
    </script>

    <!-- JQuery Editar -->
    <script>
        $('#myModalEditar').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientIdCliente = button.data('idCliente');
            var recipientCliente = button.data('cliente');
            var recipientIdServico = button.data('idServico');
            var recipientServico = button.data('servico');
            var recipientDataAgendamento = button.data('agendamento');
            var recipientHorarioAgendamento = button.data('horario');
            

            var modal = $(this);
            modal.find('#recipient-idCliente').val(recipientIdCliente);
            modal.find('#recipient-cliente').val(recipientCliente);
            modal.find('#recipient-idServico').val(recipientIdServico);
            modal.find('#recipient-servico').val(recipientServico);
            modal.find('#recipient-dataAgendamento').val(recipientDataAgendamento);
            modal.find('#recipient-horarioAgendamento').val(recipientHorarioAgendamento);
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