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
    
    public function createBalance($addNominal){
        $query = "INSERT INTO {$this->table}
                    VALUES
                  (:id_account, :addNominal)";
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('addNominal', $addNominal);

        $this->db->execute();
    }

    public function addBalance($addNominal){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance + :addNominal
                    WHERE id_account=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('addNominal', $addNominal);

        $this->db->execute();
    }

    public function substractBalance($substractNominal){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance - :substractNominal
                    WHERE id_account=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('substractNominal', $substractNominal);

        $this->db->execute();
    }
}