<?php
    require_once '../modelo/cliente.php';
    $objClientes = new Cliente();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $aniversario = $_POST['txtAniversario'];
        if($objClientes->insert($nome, $telefone, $aniversario)){
            $objClientes->redirect('../cliente.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objClientes->deletar($id)){
            $objClientes->redirect('../cliente.php');
        }
    }

    if(isset($_POST['editar'])){
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $aniversario = $_POST['txtAniversario'];
        $id = $_POST['txtId'];
        if($objClientes->editar($nome, $telefone, $aniversario, $id)){
            $objClientes->redirect('../cliente.php');
        }
    }
?>