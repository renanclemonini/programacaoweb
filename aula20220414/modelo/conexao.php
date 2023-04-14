<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        /**
         * Modelo para conexão do banco de dados MySQL utilizando PHP
         * @param mixed $userName -> (-) usuário
         * @param mixed $senha -> (-) senha
         * @param mixed $connexao -> (+) conexão
         */
        class dataBase{
            private $userName = "root";
            private $senha = "";
            public $connexao;
            /**
             * Função para realizar conexão com o Banco de Dados tratando exceção quando não exibir
             */
            public function dbConnection(){
                $this->connexao = null;
                try{
                    $this->connexao = new PDO('mysql:host=localhost; dbname=senai_pw;',$this->userName, $this->senha);
                    $this->connexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Conectado";
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
                return $this->connexao;
            }
        }
    
    ?>
</body>
</html>