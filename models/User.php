<?php

class User {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $saldo;
    private $token;
    private $cargo;
    

    public function getId(){
        return $this->id;
    }
    public function setId($i){
        $this->id = trim($i);
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome($n){
        $this->nome = ucwords(trim($n));
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($e){
        $this->email = $e;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($s){
        $this->senha = $s;
    }
    public function getSaldo(){
        return $this->saldo;
    }
    public function setSaldo($s){
        $this->saldo = $s;
    }
    public function getToken(){
        return $this->token;
    }
    public function setToken($t){
        $this->token = $t;
    }
    public function getCargo(){
        return $this->cargo;
    }
    public function setCargo($c){
        $this->cargo = $c;
    }

}

interface UserDAO {
    public function findByToken($token);
    public function findByEmail($email);
    public function findById($id);
    public function addUser(User $u);
    public function updateUser (User $u);
    public function deleteUser ($id);

}