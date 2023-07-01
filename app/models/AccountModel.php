<?php

class AccountModel{
    private $table = 'Account';
    private $db;

    public function __construct()
    {
        $this->db = new Database;     
    }
    
    public function createAccount($data){
        $query = "INSERT INTO account
                    VALUES
                  ('', :name, :username, :age, :password_hash)";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
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
}