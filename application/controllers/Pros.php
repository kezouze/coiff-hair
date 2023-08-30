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

    public function forgot_password_pro()
    {
        $info['error'] = "";
        $info['valid'] = "";

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('valid_email' => 'Vous devez saisir une adresse email valide.'));
        if ($this->form_validation->run()) {

            $result = $this->usersManager->cb_users_password($this->input->email, $info['tablename']);

            if ($result == 0) {
                $info['error'] = "Aucune correspondance trouvée";
            } else if ($result == 1) {

                $email = $this->input->email;
                $code = random_string();

                $this->usersManager->secret_code($code, $email);

                $this->load->library('email');
                $this->email->from('projet-pro@outil-web.fr', 'Coiffhair');
                $this->email->to($email);
                $this->email->subject('Réinitialisation de votre mot de passe');
                $this->email->message('Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe : ' . anchor(base_url() . 'Users/new_password' . '?code=' . $code . '&email=' . $email));
                $this->email->send();

                if ($this->email->send()) {
                    $info['valid'] = "Nous vous avons envoyé un mail de réinitialisation de votre mot de passe";
                    // Le lien devrait avoir une limite de validité
                } else {
                    echo $this->email->print_debugger();
                }
            } else {
                header('refresh: 3; url=http://[::1]/coiffhair/Users');
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
        $info['code'] = $_GET['code'];
        $info['email'] = $_GET['email'];

        if (!isset($info['code']) || !isset($info['email'])) {
            redirect('Welcome');
        } else {

            $result = $this->usersManager->get_secret_code($_GET['email']);
            // cela renvoie un objet contenant le code

            $secret_code = $result[0]->secret_code;
            // cela accède au contenu de l'objet qui nous intéresse : la chaine de caractères

            if ($secret_code === $info['code']) {
                $this->form_validation->set_rules('new_password', 'Nouveau mot de passe', 'trim|required|min_length[6]', array('min_length' => 'Le champ %s doit contenir au moins 6 caractères.'));
                $this->form_validation->set_rules('confirm_new_password', 'Confirmation du nouveau mot de passe', 'trim|required|matches[new_password]', array('matches' => 'Les deux saisies ne correspondent pas.'));

                if ($this->form_validation->run()) {
                    $new_password = $this->input->password;
                    $this->usersManager->change_password($info['email'], md5($new_password));
                    $info['valid'] = 'Nous avons bien modifié votre mot de passe ! Redirection vers la page d\'accueil... ';
                    header('refresh: 3; url=http://[::1]/coiffhair/Users');
                } else {
                    $info['error'] = validation_errors();
                }
            } else {
                $info['error'] = "Une erreur est survenue";
                session_destroy();
                redirect('Welcome');
            }
        }
        $this->load->view('espace_mdp/new_password', $info);
    }
}
