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

    public function getTicketbyIdAccountAndIdSeats($idAccount, $idSeats){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_account=:idAccount AND id_seats=:idSeats');
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idSeats', $idSeats);
        return $this->db->single();
    }

    public function setTicket($idAccount, $idMovie, $idSeats, $seats){
        $query = "INSERT INTO {$this->table}
                    VALUES
                  (:idAccount, :idMovie, :idSeats, :seats)";
        
        $this->db->query($query);
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idMovie', $idMovie);
        $this->db->bind('idSeats', $idSeats);
        $this->db->bind('seats', $seats);

        $this->db->execute();
    }

    public function deleteTicket($idAccount, $idSeats){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id_account=:idAccount AND id_seats=:idSeats');
        $this->db->bind('idAccount', $idAccount);
        $this->db->bind('idSeats', $idSeats);
        $this->db->execute();
    }

}