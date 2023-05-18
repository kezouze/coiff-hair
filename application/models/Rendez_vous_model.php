<?php

class Rendez_vous_model extends CI_Model
{
    protected $tableName = "rendez_vous";

    // à déplacer dans Users_model ?
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

    public function set_new_rendez_vous($id_user, $date, $heure, $details)
    {
        $data = array(
            'date_rendez_vous' => $date,
            'heure_rendez_vous' => $heure,
            'id_user' => $id_user,
            'details_rendez_vous' => $details
        );

        $this->db->insert($this->tableName, $data);
    }

    public function get_all_rendez_vous($id_user)
    {
        $query = $this->db->select('*')
            ->from($this->tableName)
            ->where('id_user', $id_user)
            ->get()
            ->result();
        return $query;
    }

    public function delete_rdv($id_rdv){
        $this->db->delete($this->tableName, array('id_rendez_vous' => $id_rdv));
    }
}
