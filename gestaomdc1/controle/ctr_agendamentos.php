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