<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pros extends CI_Controller
{
    public function index()
    {

        if (isConnected() == true) {
            redirect('Pros/logged');
        }

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('espace_connexion/login_pros');
        } else {
            redirect('Pros/logged');
        }
    }

    public function logged()
    {
        $date = date('Y-m-d');
        $info['all_data'] = $this->Pros_model->get_all_rdv($date);
        $info['id'] = $info['all_data'][0]->id_user;
        $info['user'] = $this->Pros_model->get_user($info['id']);
        $this->load->view('espace_connexion/logged_pros', $info);
    }

    public function deconnect()
	{
		session_destroy();
		redirect('Pros');
	}
}
