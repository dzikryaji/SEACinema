<?php

class BalanceModel{
    private $table = 'Balance';
    private $db;

    public function __construct()
    {
        $this->db = new Database;     
    }

    public function getBalancebyIdAccount($idAccount){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_account=:idAccount');
        $this->db->bind('idAccount', $idAccount);
        return $this->db->single();
    }
    
    public function createBalance($data){
        $query = "INSERT INTO {$this->table}
                    VALUES
                  (:id_account, :topUp)";
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('topUp', $data['topUp']);

        $this->db->execute();
    }

    public function addBalance($data){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance + :topUp
                    WHERE id_account=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('topUp', $data['topUp']);

        $this->db->execute();
    }

    public function substractBalance($data){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance - :withdraw
                    WHERE id_account=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('withdraw', $data['withdraw']);

        $this->db->execute();
    }
}