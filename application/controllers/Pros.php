<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pros extends CI_Controller
{
    public function index()
    {
        if (isConnected() == true) {
            redirect('Pros/logged');
        }
        $info['error'] = "";
        $this->load->view('espace_connexion/login_pros', $info);
    }

    public function logged()
    {
        $this->load->view('espace_connexion/logged_pros');
    }
}
