<?php

class AccountModel{
    private $table = 'Account';
    private $db;

    public function __construct()
    {
        $this->db = new Database;     
    }
    
    public function createAccount($data){
        $query = "INSERT INTO (name, username, age, balance, password_hash) account
                    VALUES
                  (:name, :username, :age, :balance, :password_hash)";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('balance', 0);
        $this->db->bind('age', $data['age']);
        $this->db->bind('password_hash', $data['password_hash']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAccountbyUsername($username){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function addBalance($addNominal){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance + :addNominal
                    WHERE id=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('addNominal', $addNominal);

        $this->db->execute();
    }

    public function substractBalance($substractNominal){
        $query = 'UPDATE ' . $this->table . '
                    SET balance = balance - :substractNominal
                    WHERE id=:id_account';
        
        $this->db->query($query);
        $this->db->bind('id_account', $_SESSION['account']['id']);
        $this->db->bind('substractNominal', $substractNominal);

        $this->db->execute();
    }
}