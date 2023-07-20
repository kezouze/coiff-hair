<?php

class Rendez_vous_model extends CI_Model
{
    protected $tableName = "rendez_vous";

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

    public function get_nb_next_rdv($id_user)
    {
        $query = $this->db->where('id_user', $id_user)
            ->where('date_rendez_vous >=', date('Y-m-d'))
            ->from($this->tableName)
            ->count_all_results();
        return $query;
    }

    public function get_time($id_rdv)
    {
        $query = $this->db->select('heure_rendez_vous')
            ->where('id_rendez_vous', $id_rdv)
            ->from($this->tableName)
            ->get()
            ->row();
        return ($query->heure_rendez_vous);
    }

    public function is_email_send($id_rdv)
    {
        $query = $this->db->select('rappel')
            ->from($this->tableName)
            ->where('id_rendez_vous', $id_rdv)
            ->get()
            ->row();
        return ($query->rappel);
    }

    public function set_email_sent($id_rdv)
    {
        $data = array(
            'rappel' => 1
        );
        $this->db->where('id_rendez_vous', $id_rdv)
            ->update($this->tableName, $data);
    }
}
