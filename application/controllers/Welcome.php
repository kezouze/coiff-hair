<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome');
    }

    public function deconnect()
    {
        session_destroy();
        redirect('Welcome/');
    }

    public function infos()
    {
        $data['all_data'] = $this->Pros_model->get_all();
        $this->load->view('espace_salons/info_salon', $data);
    }

    public function details()
    {
        $data['id'] = $_GET['id'];
        $data['all_data'] = $this->Pros_model->get_all_where_id($_GET['id']);

        if (!$data['all_data'] || !is_numeric($data['id']) || $data['id'] < 1) {
            redirect('404');
            return;
        }

        $this->load->view('espace_salons/details_salon', $data);
    }

    public function likes()
    {
        $id = $_GET['id'];
        $this->Pros_model->set_nb_likes($id);
        redirect('Welcome/details?id=' . $id);
    }
}
