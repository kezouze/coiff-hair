<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pros extends CI_Controller
{
    public function index()
    {
        if (isConnected()) {
            redirect('Pros/logged');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required');

        $info['error'] = $this->form_validation->run() ? "Veuillez vérifier votre saisie" : "";

        if (
            $this->form_validation->run()
            && $this->Pros_model->cb_pros($this->input->post('email'), md5($this->input->post('password'))) == 1
        ) {
            $_SESSION['id'] = $this->Pros_model->get_id($this->input->post('email'));
            $_SESSION['type'] = "pro";
            redirect('Pros/logged');
        }

        $this->load->view('espace_connexion/login_pros', $info);
    }


    public function logged()
    {
        if ($_SESSION['type'] !== "pro") {
            session_destroy();
            redirect('Pros');
        }

        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $date = date('Y-m-d');
            $id = $_SESSION['id'];
            $info['all_rdv'] = $this->Pros_model->get_all_rdv($date, $id);
            $this->load->view('espace_connexion/logged_pros', $info);
        }
    }

    public function deconnect()
    {
        session_destroy();
        redirect('Welcome');
    }
}
