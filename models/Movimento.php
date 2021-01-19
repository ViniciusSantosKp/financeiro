<?php

class Movimento {
    private $id;
    private $id_user;
    private $nome;
    private $valor;
    private $tipo;
    private $data_op;

    public function getId (){
        return $this->id;
    }
    public function setId ($i){
        $this->id = $i;
    }
    public function getIdUser (){
        return $this->id_user;
    }
    public function setIdUser ($i){
        $this->id_user = $i;
    }
    public function getNome (){
        return $this->nome;
    }
    public function setNome ($i){
        $this->nome = $i;
    }
    public function getValor (){
        return $this->valor;
    }
    public function setValor ($i){
        $this->valor = $i;
    }
    public function getTipo (){
        return $this->tipo;
    }
    public function setTipo ($i){
        $this->tipo = $i;
    }
    public function getData (){
        return $this->data_op;
    }
    public function setData ($i){
        $this->data_op = $i;
    }
    


}

interface MovimentoDao {
    
    public function findByIdUser($id);
    public function addMov(Movimento $m);
    public function deleteMov($id);

}