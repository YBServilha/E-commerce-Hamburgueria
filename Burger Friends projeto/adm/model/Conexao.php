<?php

    class Conexao{
        private $host = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $db = 'burgerfriends';
    

    //EXECUTOR DE QUERYS
    public function Executar($sql){
        $conexao = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $query = mysqli_query($conexao, $sql);
        return $query;
        $conexao->close();
    }

    //EXECUTAR E ARMAZENAR DADOS EM ARRAY
    public function DadosArray($sql){
        $conexao = new mysqli($this->host, $this->user, $this->pass, $this->db);
        $query = mysqli_query($conexao, $sql);
        $array = mysqli_fetch_array($query);
        return $array;
        $conexao->close();
    }
}
    //FUNÇÃO DE CONEXÃO (caso precise)
    $conexao = new mysqli("localhost", "root", "", "burgerfriends");
    
?>