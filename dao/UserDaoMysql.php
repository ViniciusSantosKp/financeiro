<?php

require_once 'models/User.php';

class UserDaoMysql implements UserDAO {

    private $pdo;

    public function __construct(PDO $engine){
        $this->pdo = $engine;
    }
    
    private function userGenerator ($array){
        $u=new User();
        $u->setId($array['id']) ?? 0;
        $u->setNome($array['nome']) ?? '';
        $u->setEmail($array['email']) ?? '';
        $u->setSenha($array['senha']) ?? '';
        $u->setSaldo($array['saldo']) ?? 0;
        $u->setToken($array['token']) ?? '';
        $u->setCargo($array['cargo']) ?? 0;
        

        return $u;

    }
    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM users");
        if ($sql->rowCount()>0){
            $dados = $sql->fetchAll();

            foreach($dados as $item){
           
                $user = $this->userGenerator($item);
                $array[] = $user;
            }
        }
        return $array;
    }
    public function findByToken($token){
        if(!empty($token)){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE token=:token");
            $sql->bindValue(':token', $token);
            $sql->execute();
    
            if($sql->rowCount()>0){
                $info = $sql->fetch(PDO::FETCH_ASSOC);
                $user=$this->userGenerator($info);
                return $user;
            }
        }else{
            return false;
        }
    
    }
    public function findByEmail($email){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount()>0){
            
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $user = $this->userGenerator($data);
            return $user;
         
        }else{
            return false;
        }

    }
    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount()>0){
            $info = $sql->fetch(PDO::FETCH_ASSOC);
            $user=$this->userGenerator($info);
            return $user;
        }else{
            return false;
        }

    }
    public function addUser(User $u){
        $sql = $this->pdo->prepare("INSERT INTO users (nome, email, senha, saldo, token, cargo) VALUES(:nome, :email, :senha, 0, 0, 0)");
        $sql->bindValue(':nome',$u->getNome() );
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':senha', $u->getSenha());
        $sql->execute();

        $u->setId($this->pdo->lastInsertId());
        return $u;
    }
    public function updateUser (User $u){
        $sql = $this->pdo->prepare("UPDATE users SET nome=:nome, email=:email, token=:token, saldo=:saldo WHERE id=:id");
        $sql->bindValue(':nome',$u->getNome() );
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(':token', $u->getToken());
        $sql->bindValue(':saldo', $u->getSaldo());
        $sql->bindValue(':id', $u->getId());
        $sql->execute();

        return true;
    }
    public function deleteUser ($id){
        $sql=$this->pdo->prepare("DELETE FROM users WHERE id=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
        
    
}