<?php 
    require_once('./modelo/cliente.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Clientes</title>
</head>
<body>
<div class="container">
    <h2 class="text-center">Lista dos Clientes</h2>           
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
                <tr>
                    <td>1</td>
                    <td>John</td>
                    <td>21</td>
                    <td>555.124.698-89</td>
                    <td><button type="button" class="btn btn-warning">Editar</button></td>
                    <td><button type="button" class="btn btn-danger">Deletar</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mary</td>
                    <td>23</td>
                    <td>789.852.369-99</td>
                    <td><button type="button" class="btn btn-warning">Editar</button></td>
                    <td><button type="button" class="btn btn-danger">Deletar</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Jesus</td>
                    <td>33</td>
                    <td>114.741.223-55</td>
                    <td><button type="button" class="btn btn-warning">Editar</button></td>
                    <td><button type="button" class="btn btn-danger">Deletar</button></td>
                </tr>
            </tbody>
    </table>
    <p><button type="button" class="btn btn-success">Cadastrar</button></p> 
    </div>
</body>
</html>