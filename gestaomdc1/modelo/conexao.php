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
        
        class dataBase{
            private $userName = "root";
            private $senha = "";
            public $connexao;
            
            public function dbConnection(){
                $this->connexao = null;
                try{
                    $this->connexao = new PDO('mysql:host=localhost; dbname=gestaomdc;',$this->userName, $this->senha);
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