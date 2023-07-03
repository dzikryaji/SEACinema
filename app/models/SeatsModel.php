<?php

class SeatsModel
{
    private $table = 'Seats';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSeatsByIdMovie($idMovie)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_movie=:idMovie');
        $this->db->bind('idMovie', $idMovie);
        return $this->db->single();
    }

    public function createSeats($idMovie)
    {
        $query = "INSERT INTO " . $this->table . "
                    VALUES
                    (:idMovie, :seats)";

        $seats = '';
        for ($i=0; $i < 64; $i++) { 
            $seats .= 0;
        }

        $this->db->query($query);
        $this->db->bind('idMovie', $idMovie);
        $this->db->bind('seats', $seats);
        $this->db->execute();
        return $seats;
    }

    public function upadateSeats($seats)
    {
        $query ='UPDATE ' . $this->table . '
                    SET seats = :seats
                    WHERE id_movie=:idMovie';

        $this->db->query($query);
        $this->db->bind('seats', $seats['seats']);
        $this->db->bind('idMovie', $seats['id_movie']);
        $this->db->execute();
    }
}
