<?php 
    require_once('conexao.php');

    class Agendamentos{
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
                $sql = "SELECT * FROM agendamentos";
                $stmt = $this->connexao->prepare($sql);
                $stmt->execute();

                return $stmt;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function insert($nome, $telefone, $aniversario){
            try{
                $sql = "INSERT INTO clientes (nome, telefone, aniversario) values(:nome, :telefone, :aniversario)";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':aniversario', $aniversario);

                $stmt->execute();

                return $stmt;
            }catch(PDOException $e){
                echo $e -> getMessage();
            }
        }

        public function deletar($id){
            try {
                $sql = "DELETE from clientes where id = :id";
                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function editar($nome, $telefone, $aniversario, $id){
            try {
                $sql = "UPDATE clientes set nome = :nome, telefone = :telefone, aniversario = :aniversario where id = :id";

                $stmt = $this->connexao->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':aniversario', $aniversario);
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