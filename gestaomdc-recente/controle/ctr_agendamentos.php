<?php 

require_once ('../modelo/agendamentos.php');
$objAgendamentos = new Agendamentos();

    if (isset($_POST['insert'])) {
        $nome = $_POST['txtNome'];
        $servico = $_POST['txtServico'];
        $data = $_POST['txtData'];
        $horario = $_POST['txtHorario'];
        if($objAgendamentos->insert($nome, $servico, $data, $horario)){
            $objAgendamentos->redirect('../newAgendamento.php');
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['txtId'];
        if($objAgendamentos->deletar($id)){
            $objAgendamentos->redirect('../agendamentos.php');
        }
    }

    if(isset($_POST['editar'])){
        $dataAgendamento = $_POST['txtDataAgendamento'];
        $horarioAgendamento = $_POST['txtHorarioAgendamento'];
        $id = $_POST['txtId'];
        if ($objAgendamentos->editar($dataAgendamento, $horarioAgendamento, $id)) {
            $objAgendamentos->redirect('../agendamentos.php');
        }
    }