<?php 

require_once '../modelo/agendamentoDAO.php';
$objAgendamentos = new Agendamento();

    if(isset($_POST['insert']))
    {
        $cliente = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $servico = $_POST['txtServico'];
        $agendamento = $_POST['txtData'];
        $horario = $_POST['txtHorario'];
        if($objAgendamentos->insert($cliente, $telefone, $servico, $agendamento, $horario))
        {
            $objAgendamentos->redirect('../novo-agendamento.php');
        }
    }

