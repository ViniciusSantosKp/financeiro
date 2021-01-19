<?php

require_once 'models/Movimento.php';

class MovimentoDaoMysql implements MovimentoDao {

    private $pdo;

    public function __construct(PDO $engine){
        $this->pdo = $engine;
    }
  
    public function movGenerator ($array){
        $u = new Movimento ();
        $u->setId($array['id'])?? 0;
        $u->setIdUser($array['id_user'])?? 0;
        $u->setNome($array['nome'])?? 0;
        $u->setTipo($array['tipo'])?? 0;
        $u->setValor($array['valor'])?? 0;
        $u->setData($array['data_op'])?? 0;


        return $u;

    }
    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM movimentos WHERE id=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount()>0){
            $info = $sql->fetch(PDO::FETCH_ASSOC);
            $user=$this->movGenerator($info);
            return $user;
        }else{
            return false;
        }
    }
    public function findByIdUser($id){
        $array = [];

        $sql = $this->pdo->prepare("SELECT * FROM movimentos WHERE id_user=:idUser");
        $sql->bindValue(':idUser', $id );
        $sql->execute();

        if ($sql->rowCount()>0){
            $dados = $sql->fetchAll();

            foreach($dados as $movimento){
           
                $extrato = $this->movGenerator($movimento);
                $array[] = $extrato;
            }
        }
        return $array;
    }
    public function addMov(Movimento $m){
        $sql = $this->pdo->prepare("INSERT INTO movimentos (id_user, nome, valor, tipo, data_op) VALUES (:id_user, :nome, :valor, :tipo, :data_op)");
        $sql->bindValue(':nome',$m->getNome());
        $sql->bindValue(':id_user', $m->getIdUser());
        $sql->bindValue(':valor', $m->getValor());
        $sql->bindValue(':tipo', $m->getTipo());
        $sql->bindValue(':data_op', $m->getData());
        $sql->execute();

        $m->setId($this->pdo->lastInsertId());
        return true;
    }
    public function deleteMov($id){
        $sql=$this->pdo->prepare("DELETE FROM movimentos WHERE id=:id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}