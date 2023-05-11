<?php
    require_once('./modelo/servicos.php');
    $objServicos = new Servicos();
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
        <form action="./controle/ctr_agendamentos.php" method="post">
            <label for="cbServicos"></label>
            <?php 
                $stmt = $objServicos->read();
                $stmt->execute();
                while($stmt->fetchObject()){
            ?>
                <select name="cbServicos" id="iCbServicos">
                    <option value="option"> <?php echo $objServicos['nome'] ?> </option>
                </select>
            <?php 
                }
            ?>
        </form>
    </div>

    <div class="container">
        <h2 class="my-3 text-center">Agendamento</h2>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Horário</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
            <p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Novo Agendamento
                </button>
            </p>
                <?php
                    $stmt = $objServicos->read();
                    $stmt->execute();
                    while ($objServicos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objServicos['id']; ?>
                            </td>
                            <td>
                                <?php echo $objServicos['nome']; ?>
                            </td>
                            <td>
                                20/05/2023
                                <?php #echo $objServicos['dataAgendamento']; ?>
                            </td>
                            <td>
                                14:00
                                <?php #echo $objServicos['horarioAgendamento']; ?>
                            </td>
                            <td>
                                
                                <button type="button" class="btn btn-warning"
                                data-toggle="modal" 
                                data-target="#myModalEditar" 
                                data-id="<?php echo $objServicos['id']; ?>"
                                data-nome="<?php echo $objServicos['nome']; ?>">
                                Editar</button> 
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#myModalDelete" 
                                data-id="<?php echo $objServicos['id']; ?>"
                                data-nome="<?php echo $objServicos['nome']; ?>"> Deletar </button> 
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
                        <form action="./controle/ctr_servicos.php" method="post">
                            <input type="hidden" name="insert">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="nome" name="txtNome">
                            </div>
                            <div class="form-group">
                                <label for="dataAgendamento">Data:</label>
                                <input type="date" class="form-control" id="dataAgendamento" name="txtData">
                            </div>
                            <div class="form-group">
                                <label for="horarioAgendamento">Data:</label>
                                <input type="time" class="form-control" id="horarioAgendamento" name="txtHorario">
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
                        <form action="./controle/ctr_servicos.php" method="post">
                            <input type="hidden" name="editar">
                            <input type="hidden" name="txtId" id="recipient-id">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" placeholder="Digite seu nome" id="recipient-nome" name="nome">
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
                    <form action="./controle/ctr_servicos.php" method="post">
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