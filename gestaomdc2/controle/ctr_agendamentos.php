<?php 

require_once ('../modelo/agendamentos.php');
$objAgendamentos = new Agendamentos();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        $servico = $_POST['txtServico'];
        $data = $_POST['txtData'];
        $horario = $_POST['txtHorario'];
        if($objAgendamentos->insert($nome, $servico, $data, $horario)){
            $objAgendamentos->redirect('../agendamentos.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objAgendamentos->deletar($id)){
            $objAgendamentos->redirect('../agendamentos.php');
        }
    }

    if(isset($_POST['editar'])){
        $idCliente = $_POST['idCliente'];
        $idServico = $_POST['idServico'];
        $dataAgendamento = $_POST['dataAge'];
        $horarioAgendamento = $_POST['horarioAge'];
        $id = $_POST['id'];
        if ($objAgendamentos->editar($idCliente, $idServico, $dataAgendamento, $horarioAgendamento, $id)) {
            $objAgendamentos->redirect('../agendamentos.php');
        }
    }