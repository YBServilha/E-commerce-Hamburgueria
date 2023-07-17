<?php 
    class Menu{

        public $pdo;

        public function __construct(){
            try{
                $this->pdo = new PDO("mysql:dbname=burgerfriends;host:localhost","root","");
            }catch(PDOExeption $e){
                echo "Erro de banco de dados: " . $e->getMessage() . "<br>";
            }catch(PDOExeption $e){
                echo "Erro genérico: " . $e->getMessage() . "<br>";
            }
        }

        public function ListaTabela($tabela){
            $res = array();
            $cmd = $this->pdo->query("SELECT* FROM {$tabela} ORDER BY id ASC");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        public function PegaTodosMenu(){
            $result = array();
            $cmd = $this->pdo->query("SELECT id, folder, nome FROM menu;");
            $result = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }


?>