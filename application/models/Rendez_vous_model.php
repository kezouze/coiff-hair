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
            ->order_by('date_rendez_vous', 'ASC')
            ->order_by('heure_rendez_vous', 'ASC')
            ->get()
            ->result();
        return $query;
    }

    public function delete_rdv($id_rdv)
    {
        $this->db->delete($this->tableName, array('id_rendez_vous' => $id_rdv));
    }

    public function modify_rdv($id_rdv, $date, $heure/*, $details*/)
    {
        $data = array(
            'date_rendez_vous' => $date,
            'heure_rendez_vous' => $heure,
            // 'id_rdv' => $id_rdv,
            // 'details_rendez_vous' => $details
        );
        $this->db->where('id_rendez_vous', $id_rdv)
            ->update($this->tableName, $data);
    }

    public function isAvailable($date, $heure)
    {
        $query = $this->db->where('date_rendez_vous', $date)
            ->where('heure_rendez_vous', $heure)
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function getHours()
    {
        $query = $this->db->select('heure_rendez_vous')->from($this->tableName)->get()->result();
        var_dump($query);
    }

}
