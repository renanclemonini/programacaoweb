<?php 

require_once './connection.php';

class Agendamento{
    private $conn;

    public function __construct()
    {
        $dataBase = new dataBase();
        $this->conn = $dataBase->dbConnection();
    }

    public function runQuery($sql)
    {
        try
        {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    
    public function insert($cliente, $telefone, $idServico, $agendamentoData, $horario)
    {
        try
        {
            $sql = "INSERT INTO agendamento (cliente, telefone, idServico, agendamentoData, horario) VALUES (:cliente, :telefone, :idServico, :agendamentoData, :horario)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":cliente", $cliente);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":idServico", $idServico);
            $stmt->bindParam(":agendamentoData", $agendamentoData);
            $stmt->bindParam(":horario", $horario);

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
    public function read()
    {
        try
        {
            $sql = "SELECT * from agendamento";
            $stmt = $this->conn->prepare($sql);

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function update($cliente, $telefone, $agendamentoData, $horario, $id)
    {
        try
        {
            $sql = "UPDATE agendamento SET cliente = :cliente, telefone = :telefone, agendamentoData = :agendamentoData, horario = :horario WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":cliente", $cliente);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":agendamentoData", $agendamentoData);
            $stmt->bindParam(":horario", $horario);
            $stmt->bindParam(":id", $id);

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function delete($id)
    {
        try
        {
            $sql = "DELETE FROM agendamento WHERE id = :id";
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
}