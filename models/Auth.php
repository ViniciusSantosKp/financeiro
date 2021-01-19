<?php
require_once 'dao/UserDaoMysql.php';
require_once 'dao/MovimentoDaoMysql.php';

class Auth {

    private $pdo;
    private $base;

    public function __construct(PDO $engine, $base){
        $this->pdo = $engine;
        $this->base = $base;
    }

    public function checkToken (){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);

            if($user){
                return $user;
            }
        }
        header("Location: ".$this->base."login.php");
        exit;
    }

    public function validateLogin($email, $senha){
        $userDao = new UserDaoMysql($this->pdo);
        $user = $userDao->findByEmail($email);
        if($user){
           if(password_verify($senha, $user->getSenha())){
               $token = md5(time().rand(0, 9999));
               $_SESSION['token']=$token;
               $user->setToken($token);
               $userDao->updateUser($user);

               return true;
           } 
        }

        return false;
    }

    public function updateSaldo($token){
        $userDao = new UserDaoMysql($this->pdo);
        $user = $userDao->findByToken($token);
        $movimentoDao = new MovimentoDaoMysql($this->pdo);
        $listaMovimento = $movimentoDao->findByIdUser($user->getId());
        $saldo = 0;
        foreach ($listaMovimento as $movimento ){
            $saldo += $movimento->getValor();
        }
        
        $user->setSaldo($saldo);
        $userDao->updateUser($user);

        return true;
    }

   
}