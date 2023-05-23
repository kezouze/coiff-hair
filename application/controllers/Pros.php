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
        $this->load->view('espace_connexion/logged_pros');
    }
}
