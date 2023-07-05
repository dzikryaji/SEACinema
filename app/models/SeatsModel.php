<?php

class SeatsModel
{
    private $table = 'Seats';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSeats($idMovie, $date, $showtime)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_movie=:idMovie AND date=:date AND showtime=:showtime');
        $this->db->bind('idMovie', $idMovie);
        $this->db->bind('date', $date);
        $this->db->bind('showtime', $showtime);
        return $this->db->single();
    }

    public function getSeatsByIdSeats($idSeats)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id_seats=:idSeats');
        $this->db->bind('idSeats', $idSeats);
        return $this->db->single();
    }

    public function createSeats($idMovie, $date, $showtime)
    {
        $query = "INSERT INTO " . $this->table . "
                    VALUES
                    ('', :idMovie, :date, :showtime, :seats)";

        $seats = '';
        for ($i=0; $i < 64; $i++) { 
            $seats .= 0;
        }

        $this->db->query($query);
        $this->db->bind('idMovie', $idMovie);
        $this->db->bind('date', $date);
        $this->db->bind('showtime', $showtime);
        $this->db->bind('seats', $seats);
        $this->db->execute();
        return $seats;
    }

    public function updateSeats($seats)
    {
        $query ='UPDATE ' . $this->table . '
                    SET seats = :seats
                    WHERE id_seats=:idSeats';

        $this->db->query($query);
        $this->db->bind('seats', $seats['seats']);
        $this->db->bind('idSeats', $seats['id_seats']);
        $this->db->execute();
    }
}
