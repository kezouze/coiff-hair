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
        $this->load->view('info_salon', $data);
    }
}
