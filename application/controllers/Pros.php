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

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required');

        if ($this->form_validation->run() == false) {
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if ($this->Pros_model->cb_pros($email, md5($password)) == 1) {
                $_SESSION['id'] = $this->Pros_model->get_id($email);
                redirect('Pros/logged');
            } else $info['error'] = "Veuillez vérifier votre saisie";
        }
        $this->load->view('espace_connexion/login_pros', $info);
    }

    public function logged()
    {
        $date = date('Y-m-d');
        $id = $_SESSION['id']; // null
        $info['all_rdv'] = $this->Pros_model->get_all_rdv($date, $id);
        $this->load->view('espace_connexion/logged_pros', $info);
    }

    public function deconnect()
    {
        session_destroy();
        redirect('Pros');
    }
}
