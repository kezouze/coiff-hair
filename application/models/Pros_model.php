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
        $query = $this->db->select('id_pro, name, telephone, email, likes, address, postal_code, city, description, photos, boss')
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
        return $query->liked;
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

    // public function set_pro_photo($id, $newFileName)
    // {
    //     $data = array(
    //         'photos' => $newFileName,
    //     );
    //     $this->db->where('id_pro', $id)
    //         ->update($this->tableName, $data);
    // }

    public function set_pro_photo($id, $newFileName)
    {
        // Récupérer les données actuelles de la colonne JSON 'photos'
        $proData = $this->db->select('photos')
            ->where('id_pro', $id)
            ->get($this->tableName)
            ->row();
        $photoPaths = json_decode($proData->photos); // Décode le JSON existant
        // Ajoute le nouveau chemin d'accès
        $photoPaths[] = $newFileName;
        // Encodage du tableau mis à jour en JSON
        $jsonPhotoPaths = json_encode($photoPaths);
        // Mise à jour de la colonne avec le nouveau chemin
        $this->db->where('id_pro', $id)
            ->update($this->tableName, ['photos' => $jsonPhotoPaths]);
    }

    public function cb_pros_password($email) // Vérifier si on a un utilisateur en bdd grâce à l'email pour reset mdp 
    {
        $query = $this->db->where('email', $email)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }
}
