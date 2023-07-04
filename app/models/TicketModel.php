<?php

class TicketModel
{
    private $table = 'Ticket';
    private $db;

    public function __construct()
    {
        $this->db = new Database;     
    }

    public function getTicketbyIdAccount($idAccount){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_account=:idAccount');
        $this->db->bind('idAccount', $idAccount);
        return $this->db->resultSet();
    }

    public function getTicketbyIdAccountAndIdMovie($idAccount, $idMovie){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_account=:idAccount AND id_movie=:idMovie');
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idMovie', $idMovie);
        return $this->db->single();
    }

    public function setTicket($idAccount, $idMovie, $seats){
        $query = "INSERT INTO {$this->table}
                    VALUES
                  (:idAccount, :idMovie, :seats)";
        
        $this->db->query($query);
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idMovie', $idMovie);
        $this->db->bind('seats', $seats);

        $this->db->execute();
    }

    public function deleteTicket($idAccount, $idMovie){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_account=:idAccount AND id_movie=:idMovie');
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idMovie', $idMovie);
        $this->db->execute();
    }

}