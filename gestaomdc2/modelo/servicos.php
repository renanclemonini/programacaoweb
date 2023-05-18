<?php 
    require_once('conexao.php');

    class Servicos{
        private $connexao;

        public function __construct(){
            $dataBase = new dataBase();
            $this->connexao = $dataBase->dbConnection();                       
        }

        public function runQuery($sql){
            $stmt = $this->connexao->prepare($sql);
            return $stmt;
        }

        public function read(){
            try {
                $sql = "SELECT * FROM servicos";
                $stmt = $this->connexao->prepare($sql);
                $stmt->execute();

                return $stmt;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function insert($nome){
            try{
                $sql = "INSERT INTO servicos (nome) values (:nome)";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);

                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e -> getMessage();
            }
        }

        public function deletar($id){
            try {
                $sql = "DELETE from servicos where id = :id";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function editar($nome, $id){
            try {
                $sql = "UPDATE servicos set nome = :nome where id = :id";

                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function redirect($url){
            header("Location: $url");
        }

        
    }
?>