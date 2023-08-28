<?php

defined('BASEPATH') or exit('No direct script access allowed');
$info['error'] = "";
$info['valid'] = "";
class Pros extends CI_Controller
{
    public function index()
    {
        if (isConnected()) {
            redirect('Pros/logged');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required');

        $info['error'] = $this->form_validation->run() ? "Erreur de saisie" : "";

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
            $_SESSION['name'] = $info['infos'][0]->name;
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
        $this->form_validation->set_rules(
            'email',
            'Adresse email',
            'trim|required|valid_email|is_unique[pros.email]',
            array('is_unique' => 'Cet email est déjà utilisé', 'valid_email' => 'Veuillez saisir un email valide')
        );
        $this->form_validation->set_rules(
            'password',
            '"Mot de passe"',
            'trim|min_length[6]',
            array(
                'min_length' => 'Le champ %s doit contenir au moins 6 caractères.'
            )
        );
        $this->form_validation->set_rules(
            'passwordConf',
            '"Confirmez votre mot de passe"',
            'trim|matches[password]',
            array(
                'matches' => 'Les mots de passe ne correspondent pas.'
            )
        );
        if ($this->form_validation->run() == false) {
            if (!empty($_POST)) {
                $info['error'] = validation_errors();
            }
        } else {
            $this->Pros_model->set_pro();
            $info['valid'] = "Votre inscription a bien été prise en compte";
            header('refresh: 3; url=http://[::1]/coiffhair/Pros');
        }
        $this->load->view('espace_inscription/inscription_pros', $info);
    }

    public function updateInfos()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $data['infos'] = $this->Pros_model->get_all_where_id($_SESSION['id']);
            $this->load->view('espace_pro/update_infos', $data);
        }
    }

    public function informations()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {

            $info['error'] = "";
            $info['valid'] = "";
            $this->form_validation->set_rules('address', 'Adresse', 'trim|required');
            $this->form_validation->set_rules('postal_code', 'Code postal', 'trim|required|numeric');
            $this->form_validation->set_rules('city', 'Ville', 'trim|required');
            $this->form_validation->set_rules('telephone', 'Téléphone', 'trim|required|numeric|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email', 'Adresse email', 'trim|required|valid_email');
            $info['email'] = $this->Pros_model->get_all_where_id($_SESSION['id'])[0]->email;
            if ($this->form_validation->run() == false) {
                if (!empty($_POST)) {
                    $info['error'] = validation_errors();
                }
            } else {
                $this->Pros_model->set_pro_infos($_SESSION['id']);
                $info['valid'] = "Votre modifications ont bien été prise en compte";
                header('refresh: 3; url=http://[::1]/coiffhair/Pros/updateInfos');
            }
            $this->load->view('espace_pro/informations', $info);
        }
    }

    public function presentation()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $info['error'] = "";
            $info['valid'] = "";
            $info['description'] = $this->Pros_model->get_all_where_id($_SESSION['id'])[0]->description;;
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            if ($this->form_validation->run() == false) {
                if (!empty($_POST)) {
                    $info['error'] = validation_errors();
                }
            } else {
                $this->Pros_model->set_pro_presentation($_SESSION['id']);
                $info['valid'] = "Votre modifications ont bien été prise en compte";
                header('refresh: 3; url=http://[::1]/coiffhair/Pros/updateInfos');
            }
            $this->load->view('espace_pro/presentation', $info);
        }
    }

    public function photos()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $info['error'] = "";
            $info['valid'] = "";
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg'; // svg|gif|webp ?
            $config['max_size'] = 10000000; // 10Mo
            $config['max_width'] = 7680;
            $config['max_height'] = 7680;
            $config['file_name'] = $_SESSION['id'] . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
            $key = 1;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photos')) {
                $info['error'] = $this->upload->display_errors();
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->Pros_model->set_pro_photo($_SESSION['id'], $config['file_name']);

                $info['valid'] = "Votre photo a bien été ajoutée";
                // header('refresh: 3; url=http://[::1]/coiffhair/Pros/updateInfos');
            }
            $this->load->view('espace_pro/photos', $info);
        }
    }

    public function horaires()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $this->load->view('espace_pro/horaires');
        }
    }

    public function prestations()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $this->load->view('espace_pro/prestations');
        }
    }
}
