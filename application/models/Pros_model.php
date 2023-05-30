<?php

class Pros_model extends CI_Model
{
    protected $tablename = "pros";

    public function get_all()
    {
        $query = $this->db->select('*')
            ->from($this->tablename);
        return $query;
    }

    public function get_all_rdv($date)
    {
        $query = $this->db->select('*')
            ->from('rendez_vous')
            ->where('date_rendez_vous', $date)
            ->order_by('heure_rendez_vous')
            ->get()
            ->result();
        return $query;
    }

    public function get_user($id)
    {
        $query = $this->db->select('*')
            ->from('users')
            ->where('id', $id)
            ->get()
            ->result();
        return $query;
    }
}
