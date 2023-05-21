<?php 

    require_once './modelo/cliente.php';
    $objClientes = new Cliente();

    require_once './modelo/servicos.php';
    $objServicos = new Servicos();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include './bs4.php';
    ?>
    <title>Document</title>
    <style>
        main{
            width: 450px;
            margin: 10px auto;
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <?php 
            include './navegacao.php';
        ?>
    </header>
    <main>
        <h1 class="mb-3 text-center" >Agendamento</h1>
        <form style="display: flex; flex-direction: column;" action="./controle/ctr_agendamentos.php" method="post">
            <input type="hidden" name="insert">
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iNome">Escolha Cliente:</label>
                <select name="txtNome" id="iNome" required>
                    <option value="">Selecione Cliente</option>
                    <?php
                        $sql = "SELECT id as 'Id', nome as 'Nome', telefone as 'Tel' FROM clientes";
                        $stmt = $objClientes->runQuery($sql);
                        $stmt->execute();
                        while($objClientes = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo $objClientes['Id'] ?>">
                        <?php echo $objClientes['Nome']?>
                        <?php #echo $objClientes['Tel']?>
                    </option>
                    <?php 
                        }
                    ?>
                </select>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iServico">Escolha Serviço:</label>
                <select name="txtServico" id="iServico" required>
                    <option value="">Selecione Serviço</option>
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
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iData">Selecione Data: </label>
                <input type="date" name="txtData" id="iData" required>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iHorario">Selecione Horário: </label>
                <input type="time" name="txtHorario" id="iHorario" required>
            </p>
            <div style="display: flex; justify-content: center;">
                <input style="width: 100%;" type="submit" class="btn btn-success" value="Cadastrar" data-toggle="modal" data-target="#confirm">
            </div>
        </form>
    </main>

    <!-- The Modal -->
    <div class="modal" id="confirm">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    Agendamento realizado!
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>