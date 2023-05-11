<?php
    require_once '../modelo/cliente.php';
    $objCliente = new Cliente();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $aniversario = $_POST['txtAniversario'];
        if($objCliente->insert($nome, $telefone, $aniversario)){
            $objCliente->redirect('../cliente.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objCliente->deletar($id)){
            $objCliente->redirect('../cliente.php');
        }
    }

    if(isset($_POST['editar'])){
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $aniversario = $_POST['txtAniversario'];
        $id = $_POST['txtId'];
        if($objCliente->editar($nome, $telefone, $aniversario, $id)){
            $objCliente->redirect('../cliente.php');
        }
    }
?>