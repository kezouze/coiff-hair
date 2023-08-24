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
            $info['infos'] = $this->Pros_model->get_all_where_id($_SESSION['id']);
            $info['all_rdv'] = $this->Pros_model->get_all_rdv($date, $id);
            $this->load->view('espace_connexion/logged_pros', $info);
        }
    }

    public function deconnect()
    {
        session_destroy();
        redirect('Welcome');
    }

    public function inscriptionPros()
    {
        $info['error'] = "";
        $info['valid'] = "";
        $this->form_validation->set_rules('name', 'Nom du salon', 'trim|required');
        $this->form_validation->set_rules('boss', 'Responsable', 'trim|required');
        $this->form_validation->set_rules('email', 'Adresse email', 'trim|required|valid_email|is_unique[pros.email]');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('passwordConf', 'Confirmation du mot de passe', 'trim|required|matches[password]');
        if ($this->form_validation->run() == false) {
            if (!empty($_POST)) {
                $info['error'] = "Veuillez vérifier votre saisie";
            }
        } else {
            $this->Pros_model->set_pro();
            $info['valid'] = "Votre inscription a bien été prise en compte";
            header('refresh: 3; url=http://[::1]/coiffhair/Pros');
        }
        $this->load->view('espace_inscription/inscription_pros', $info);
    }
}
