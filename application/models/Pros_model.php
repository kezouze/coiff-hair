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
        $query = $this->db->select('id_pro, name, telephone, email, likes, address, postal_code, city, description, photos, boss')
            ->from($this->tableName)
            ->get()
            ->result(); // retourne un tableau d'objets
        return $query;
    }

    public function get_all_where_id($id)
    {
        $query = $this->db->select('*')
            ->from($this->tableName)
            // ->join('prestations', 'pros.id_pro = prestations.id_pro', 'left')
            ->where('id_pro', $id)
            ->get()
            ->result();
        return $query;
    }

    // Pas moyen de faire une jointure entre ces deux-là sans faire un bug de l'impossible

    public function get_prestas_where_id_pro($id)
    {
        $query = $this->db->select('*')
            ->from('prestations')
            ->where('id_pro', $id)
            ->get()
            ->result();
        return $query;
    }

    public function get_presta_where_id($id)
    {
        $query = $this->db->select('*')
            ->from('prestations')
            ->where('presta_id', $id)
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

    public function get_all_rdv($date, $id_pro)
    {
        $query = $this->db->select('*')
            ->from('rendez_vous')
            ->where('date_rendez_vous', $date)
            ->where('id_pro', $id_pro)
            ->order_by('heure_rendez_vous')
            ->join('users', 'users.id = rendez_vous.id_user', 'left')
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

    public function get_photos($id)
    {
        $query = $this->db->select('file_access')
            ->from('photos')
            ->where('id_pro', $id)
            ->get()
            ->result();
        return $query;
    }

    public function set_new_line_likes($id_user, $id_pro, $liked)
    {
        $data = array(
            'id_user' => $id_user,
            'id_pro' => $id_pro,
            'liked' => $liked
        );

        $this->db->insert('likes', $data);
    }

    public function set_liked($id_user, $id_pro, $like)
    {
        $this->db->set('liked', $like)
            ->where('id_user', $id_user)
            ->where('id_pro', $id_pro)
            ->update('likes');
    }

    public function set_pro_likes_up($id_pro)
    {
        $this->db->set('likes', 'likes+1', false)
            ->where('id_pro', $id_pro)
            ->update($this->tableName);
    }

    public function set_pro_likes_down($id_pro)
    {
        $this->db->set('likes', 'likes-1', false)
            ->where('id_pro', $id_pro)
            ->update($this->tableName);
    }

    public function isLiked($id_user, $id_pro)
    {
        $query = $this->db->select('liked')
            ->where('id_user', $id_user)
            ->where('id_pro', $id_pro)
            ->from('likes')
            ->get()
            ->row();
        if ($query) {
            return $query->liked;
        } else {
            return 0;
        }
    }

    public function count_isLiked($id_user, $id_pro)
    {
        $query = $this->db->select('*')
            ->where('id_user', $id_user)
            ->where('id_pro', $id_pro)
            ->from('likes')
            ->count_all_results();
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

    public function set_pro_infos($id)
    {
        $data = array(
            'address' => $this->input->post('address'),
            'postal_code' => $this->input->post('postal_code'),
            'city' => ($this->input->post('city')),
            'telephone' => ($this->input->post('telephone')),
            'email' => $this->input->post('email'),
        );
        $this->db->where('id_pro', $id)
            ->update($this->tableName, $data);
    }

    public function set_pro_presentation($id)
    {
        $data = array(
            'description' => $this->input->post('description'),
        );
        $this->db->where('id_pro', $id)
            ->update($this->tableName, $data);
    }

    public function set_pro_prestation($id)
    {
        $data = array(
            'presta_name' => $this->input->post('presta_name'),
            'presta_descr' => $this->input->post('presta_descr'),
            'presta_cost' => $this->input->post('presta_cost'),
            'id_pro' => $id
        );
        $this->db->insert('prestations', $data);
    }

    public function update_pro_prestation($id)
    {
        $data = array(
            'presta_name' => $this->input->post('presta_name'),
            'presta_descr' => $this->input->post('presta_descr'),
            'presta_cost' => $this->input->post('presta_cost'),
        );
        $this->db->where('presta_id', $id)
            ->update('prestations', $data);
    }

    public function delete_prestation($id)
    {
        $this->db->delete('prestations', array('presta_id' => $id));
    }

    public function set_pro_photo($id, $newFileName)
    {
        $data = array(
            'file_access' => $newFileName,
            'id_pro' => $id
        );
        $this->db->insert('photos', $data);
    }

    public function cb_pros_password($email) // Vérifier si on a un utilisateur en bdd grâce à l'email pour reset mdp 
    {
        $query = $this->db->where('email', $email)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function is_id_exists($selection, $tableName, $id)
    {
        $query = $this->db->select('*')
            ->from($tableName)
            ->where($selection, $id)
            ->count_all_results();
        if ($query == 0) {
            return false;
        } else return true;
    }
}
