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
}
