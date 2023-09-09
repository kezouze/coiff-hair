<?php

class Users_model extends CI_Model
{
    protected $tableName = 'users';

    public function cb_users($pseudo, $email, $password) // Vérifier si on a un utilisateur en bdd grâce au pseudo + mail + mdp
    {
        $query = $this->db->where('pseudo', $pseudo)
            ->where('email', $email)
            ->where('password', $password)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function cb_users_bis($identifiant, $password) // Vérifier si on a un utilisateur en bdd grâce à l'email OU le pseudo + mdp
    {
        $query = $this->db->where('pseudo', $identifiant)
            ->where('password', $password)
            ->or_where('email', $identifiant)
            ->where('password', $password)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function cb_users_password($email) // Vérifier si on a un utilisateur en bdd grâce à l'email pour reset mdp 
    {
        $query = $this->db->where('email', $email)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function cb_users_email($email) // Vérifier si on a un utilisateur en bdd grâce à l'email pour inscription avec from Validation
    {
        $query = $this->db->where('email', $email)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function cb_users_pseudo($pseudo) // Vérifier si on a un utilisateur en bdd grâce au pseudo pour inscription avec from Validation 
    {
        $query = $this->db->where('pseudo', $pseudo)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function get_id_user($identifiant)
    {
        $query = $this->db->select('id')
            ->where('email', $identifiant)
            ->or_where('pseudo', $identifiant)
            ->from('users')
            ->get()
            ->row();
        return ($query->id);
    }

    public function get_user($pseudo, $password)
    {
        $query =  $this->db->select("*")
            ->where('pseudo', $pseudo)
            ->where('password', $password)
            ->from($this->tableName)
            ->get()
            ->result();
        return $query;
    }

    public function get_first_name($id)
    {
        $query = $this->db->select('first_name')
            ->where('id', $id)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->first_name);
    }

    public function get_last_name($id)
    {
        $query = $this->db->select('last_name')
            ->where('id', $id)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->last_name);
    }

    public function add_user($gender, $lastName, $firstName, $pseudo, $email, $password) // Ajout d'un nouvel utilisateur en bdd 
    {
        $data = array(
            'gender' => $gender,
            'last_name' => $lastName,
            'first_name' => $firstName,
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('users', $data);
    }

    public function secret_code($code, $email)
    {
        $data = array(
            'secret_code' => $code
        );
        $this->db->set($data)
            ->where('email', $email)
            ->update('users');
    }

    public function get_secret_code($email)
    {
        $query = $this->db->select('secret_code, email')
            ->where('email', $email)
            ->from($this->tableName)
            ->get()
            ->result();
        return $query;
    }

    public function change_password($email, $password)
    {
        $data = array(
            'password' => $password
        );
        $this->db->set($data)
            ->where('email', $email)
            ->update('users');
    }

    public function get_gender($id)
    {
        $query = $this->db->select('gender')
            ->where('id', $id)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->gender);
    }

    public function get_email($id)
    {
        $query = $this->db->select('email')
            ->where('id', $id)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->email);
    }

    public function get_nb_conn($id)
    {
        $query = $this->db->select('nb_conn')
            ->where('id', $id)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->nb_conn);
    }

    public function set_nb_conn($id, $nbConn)
    {
        $data = array(
            'nb_conn' => $nbConn
        );
        $this->db->set($data)
            ->where('id', $id)
            ->update('users');
    }
}
