<?php 
    require_once('conexao.php');

    class Agendamentos{
        private $connexao;

        public function __construct(){
            $dataBase = new dataBase();
            $this->connexao = $dataBase->dbConnection();                       
        }

        public function runQuery($sql){
            try
            {
                $stmt = $this->connexao->prepare($sql);

                return $stmt;
            }
            catch (PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

        public function read(){
            try
            {
                $sql = "SELECT * FROM agendamentos";
                $stmt = $this->connexao->prepare($sql);
                $stmt->execute();

                return $stmt;
            }
            catch (PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }

        public function insert($idCliente, $idServico, $dataAgendamento, $horarioAgendamento){
            try 
            {
                $sql = "INSERT INTO agendamentos (idCliente, idServico, dataAgendamento, horarioAgendamento) values (:idCliente, :idServico, :dataAgendamento, :horarioAgendamento)";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':idCliente', $idCliente);
                $stmt->bindParam(':idServico', $idServico);
                $stmt->bindParam(':dataAgendamento', $dataAgendamento);
                $stmt->bindParam(':horarioAgendamento', $horarioAgendamento);

                $stmt->execute();

                return $stmt;
            }
            catch(PDOException $e)
            {
                echo $e -> getMessage();
            }
        }

        public function deletar($id){
            try 
            {
                $sql = "DELETE from agendamentos where id = :id";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } 
            catch (PDOException $e) 
            {
                echo $e->getMessage();
            }
        }

        public function editar($dataAgendamento, $horarioAgendamento, $id){
            try
            {
                $sql = "UPDATE agendamentos set dataAgendamento = :dataAgendamento, horarioAgendamento = :horarioAgendamento where id = :id";

                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':dataAgendamento', $dataAgendamento);
                $stmt->bindParam(':horarioAgendamento', $horarioAgendamento);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function redirect($url)
        {
            header("Location: $url");
        }

        
    }
?>