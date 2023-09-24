<?php
defined('BASEPATH') or exit('No direct script access allowed');
$info['error'] = "";
$info['valid'] = "";
$info['tablename'] = "pros";
class Pros extends CI_Controller
{
    public function index()
    {
        if (isConnected()) {
            redirect('Pros/logged');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required');

        if ($this->form_validation->run()) {
            if ($this->Pros_model->cb_pros($this->input->post('email'), md5($this->input->post('password'))) == 1) {
                $_SESSION['id'] = $this->Pros_model->get_id($this->input->post('email'));
                $_SESSION['type'] = "pro";
                redirect('Pros/logged');
            } else {
                $info['error'] = "Identifiant ou mot de passe incorrect";
            }
        } else {
            $info['error'] = validation_errors();
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
        }

        $date = $this->input->get('date');
        if (!isset($date)) {
            $date = date('Y-m-d');
        }
        $id_pro = $_SESSION['id'];
        $info['infos'] = $this->Pros_model->get_all_where_id($_SESSION['id']);
        $_SESSION['name'] = $info['infos'][0]->name;
        $info['all_rdv'] = $this->Pros_model->get_all_rdv($date, $id_pro);
        $info['date'] = $date;
        $info['today'] = date('Y-m-d');
        $info['next_day'] = date('Y-m-d', strtotime($date . ' +1 day'));
        $info['previous_day'] = date('Y-m-d', strtotime($date . ' -1 day'));
        $this->load->view('espace_connexion/logged_pros', $info);
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
            // $info['address'] = $this->Pros_model->get_all_where_id($_SESSION['id'])[0]->address;
            // $info['postal_code'] = $this->Pros_model->get_all_where_id($_SESSION['id'])[0]->postal_code;
            // $info['email'] = $this->Pros_model->get_all_where_id($_SESSION['id'])[0]->email;
            $info['data'] = $this->Pros_model->get_all_where_id($_SESSION['id']);

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
            $config['max_width'] = 10000;
            $config['max_height'] = 10000;
            $config['file_name'] = $_SESSION['id'] . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('photos')) {
                $info['error'] = $this->upload->display_errors();
            } else {
                // $info['data'] = array('upload_data' => $this->upload->data());
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
            $info['error'] = "";
            $info['valid'] = "";
            $this->form_validation->set_rules('presta_name', 'Nom', 'trim|required');
            $this->form_validation->set_rules('presta_descr', 'Description', 'trim|required');
            $this->form_validation->set_rules(
                'presta_cost',
                'Coût',
                'trim|required|numeric|greater_than_equal_to[1]|less_than_equal_to[1000]',
                array(
                    'required' => 'Le champ Coût est requis.',
                    'numeric' => 'Le champ Coût doit être un nombre.',
                    'greater_than_equal_to' => 'Le coût doit être d\'au moins 1€.',
                    'less_than_equal_to' => 'Le coût ne peut pas dépasser 1000€.'
                )
            );

            if ($this->form_validation->run() == false) {
                if (!empty($_POST)) {
                    $info['error'] = validation_errors();
                }
            } else {
                $this->Pros_model->set_pro_prestation($_SESSION['id']);
                $info['valid'] = "Votre modifications ont bien été prise en compte";
                header('refresh: 3; url=http://[::1]/coiffhair/Pros/updateInfos');
            }
            $this->load->view('espace_pro/prestations', $info);
        }
    }

    public function modif_prestation()
    {
        if (isConnected() == false) {
            redirect('Pros');
        } else {
            $info['error'] = "";
            $info['valid'] = "";
            $info['presta'] = $this->Pros_model->get_presta_where_id($_GET['id']);
            $this->form_validation->set_rules('presta_name', 'Nom', 'trim|required');
            $this->form_validation->set_rules('presta_descr', 'Description', 'trim|required');
            $this->form_validation->set_rules(
                'presta_cost',
                'Coût',
                'trim|required|numeric|greater_than_equal_to[1]|less_than_equal_to[1000]',
                array(
                    'required' => 'Le champ Coût est requis.',
                    'numeric' => 'Le champ Coût doit être un nombre.',
                    'greater_than_equal_to' => 'Le coût doit être d\'au moins 1€.',
                    'less_than_equal_to' => 'Le coût ne peut pas dépasser 1000€.'
                )
            );

            if ($this->form_validation->run() == false) {
                if (!empty($_POST)) {
                    $info['error'] = validation_errors();
                }
            } else {
                $this->Pros_model->update_pro_prestation($_GET['id']);
                $info['valid'] = "Votre modifications ont bien été prise en compte";
                redirect('/Welcome/prestations?id=' . $_SESSION['id']);
            }
            $this->load->view('espace_pro/modif_prestation', $info);
        }
    }

    public function delete_prestation()
    {
        if (isConnected() == false) {
            redirect('Welcome');
        }
        $this->Pros_model->delete_prestation($_GET['id']);
        redirect('Welcome/prestations?id=' . $_SESSION['id']);
    }

    public function forgot_password_pro()
    {
        $info['error'] = "";
        $info['valid'] = "";

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('valid_email' => 'Vous devez saisir une adresse email valide.'));
        if ($this->form_validation->run()) {
            // $email = $this->input->email; marche pas de cette façon
            $email = $_POST['email'];
            $result = $this->Users_model->cb_users_password($email, 'pros');

            if ($result == 0) {
                $info['error'] = "Aucune correspondance trouvée";
            } else if ($result == 1) {
                $code = random_string();
                $this->Users_model->secret_code($code, $email, 'pros');
                $this->load->library('email');
                $this->email->to($email);
                $this->email->from('coiff_hair@laposte.net', 'Coiffhair');
                $this->email->subject('Réinitialisation de votre mot de passe');
                $this->email->message('Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe : ' . anchor(base_url() . 'Pros/new_password_pro' . '?code=' . $code . '&email=' . $email));
                $this->email->send();
                $info['valid'] = "Nous vous avons envoyé un mail de réinitialisation de votre mot de passe";
                header('refresh: 3; url=http://[::1]/coiffhair/Pros');
            }
        } else {
            $info['error'] = validation_errors();
        }
        $this->load->view('espace_mdp/password_pro', $info);
    }

    public function new_password_pro()
    {

        $info['error'] = "";
        $info['valid'] = "";
        $code = $_GET['code'];
        $email = $_GET['email'];

        if (!isset($code) || !isset($email)) {
            redirect('Welcome');
        } else {

            // cela renvoie un objet contenant le code
            $result = $this->Users_model->get_secret_code($email, 'pros');

            // cela accède au contenu de l'objet qui nous intéresse : la chaine de caractères
            $secret_code = $result[0]->secret_code;
            $email_pro = $result[0]->email;

            if ($secret_code === $code && $email_pro === $email) {
                $this->form_validation->set_rules('new_password', 'Nouveau mot de passe', 'trim|required|min_length[6]', array('min_length' => 'Le champ %s doit contenir au moins 6 caractères.'));
                $this->form_validation->set_rules('confirm_new_password', 'Confirmation du nouveau mot de passe', 'trim|required|matches[new_password]', array('matches' => 'Les deux saisies ne correspondent pas.'));

                if ($this->form_validation->run()) {
                    $new_password = $_POST['new_password'];
                    $this->Users_model->change_password($email, md5($new_password), 'pros');
                    $info['valid'] = 'Nous avons bien modifié votre mot de passe ! Redirection vers la page d\'accueil... ';
                    header('refresh: 3; url=http://[::1]/coiffhair/Pros');
                } else {
                    $info['error'] = validation_errors();
                }
            } else {
                $info['error'] = "Une erreur est survenue";
                session_destroy();
                redirect('Welcome');
            }
        }
        $this->load->view('espace_mdp/new_password_pro', $info);
    }

    public function printPdf()
    {
        if (!isConnected() || $_SESSION['type'] !== "pro") {
            redirect('Welcome');
        }
        $data['all_data'] = $this->Pros_model->get_all_rdv(date('Y-m-d'), $_SESSION['id']);
        $this->load->view('espace_pro/print_pdf', $data);
    }
}
