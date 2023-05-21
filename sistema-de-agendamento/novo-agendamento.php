<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './bs4.php' ?>
    <title>Lista Agendamentos</title>
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
    <header> <?php include './nav.php' ?> </header>
    <main>
        <h1 class="mb-3 text-center" >Agendamento</h1>
        <form style="display: flex; flex-direction: column;" action="#" method="get">
            <input type="hidden" name="insert">
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iNome">Nome e Sobrenome:</label>
                <input style="width: 200px;" class="text-center" type="text" name="txtNome" id="iNome" placeholder="Digite seu nome aqui" required>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iNome">Telefone:</label>
                <input style="width: 200px;" class="text-center" type="text" name="txtNome" id="iNome" placeholder="Digite seu telefone aqui" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)" required>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iServico">Escolha Serviço:</label>
                <select name="txtServico" id="iServico" style="width: 200px;" class="text-center" required>
                    <option value="1">Selecione Serviço</option>
                    <option value="1">Opção 1</option>
                    <option value="1">Opção 2</option>
                    <option value="1">Opção 3</option>
                </select>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iData">Selecione Data: </label>
                <input style="width: 200px;" class="text-center" type="date" name="txtData" id="iData" required>
            </p>
            <p style="display: flex; align-items: center; flex-direction: column;">
                <label for="iHorario">Selecione Horário: </label>
                <input style="width: 200px;" class="text-center" type="time" name="txtHorario" id="iHorario" required>
            </p>
            <div style="display: flex; justify-content: center;">
                <input type="submit" class="btn btn-success container-sm" value="Cadastrar">
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