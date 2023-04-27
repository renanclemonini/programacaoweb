<?php
    require_once '../modelo/cliente.php';
    $objCliente = new Cliente();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        $idade = $_POST['txtIdade'];
        $cpf = $_POST['txtCpf'];
        if($objCliente->insert($nome, $idade, $cpf)){
            $objCliente->redirect('../cliente.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objCliente->deletar($id)){
            $objCliente->redirect('../cliente.php');
        }
    }
?>