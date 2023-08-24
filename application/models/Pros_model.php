<?php

class Pros_model extends CI_Model
{
    protected $tableName = "pros";

    public function cb_pros($email, $password) // Vérifier si on a un utilisateur en bdd grâce au pseudo + mail + mdp
    {
        $query = $this->db
            ->where('email', $email)
            ->where('password', $password)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function get_all()
    {
        $query = $this->db->select('*')
            ->from($this->tableName)
            ->get()
            ->result();
        return $query;
    }

    public function get_all_where_id($id)
    {
        $query = $this->db->select('*')
            ->from($this->tableName)
            ->where('id_pro', $id)
            ->get()
            ->result();
        return $query;
    }

    public function get_id($email)
    {
        $query = $this->db->select('id_pro')
            ->where('email', $email)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->id_pro);
    }

    public function get_all_rdv($date, $id)
    {
        $query = $this->db->select('*')
            ->from('rendez_vous')
            ->where('date_rendez_vous', $date)
            ->where('id_pro', $id)
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

    public function set_nb_likes($id)
    {
        $query = $this->db->set('likes', 'likes+1', FALSE)
            ->where('id_pro', $id)
            ->update($this->tableName);
        return $query;
    }

    public function set_pro()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'boss' => $this->input->post('boss'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'likes' => 0
        );
        $this->db->insert($this->tableName, $data);
    }
}
