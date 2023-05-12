<?php
    require_once '../modelo/servicos.php';
    $objServicos = new Servicos();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        if($objServicos->insert($nome, $telefone, $aniversario)){
            $objServicos->redirect('../servicos.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objServicos->deletar($id)){
            $objServicos->redirect('../servicos.php');
        }
    }

    if(isset($_POST['editar'])){
        $nome = $_POST['txtNome'];
        $id = $_POST['txtId'];
        if($objServicos->editar($nome, $id)){
            $objServicos->redirect('../servicos.php');
        }
    }
?>