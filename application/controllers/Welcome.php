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
        // $data['search_result'] = "";
        $this->form_validation->set_rules('search-input', 'de recherche', 'required|trim|max_length[50]|min_length[3]', array(
            'required' => 'Le champ %s est requis',
            'max_length' => 'Le champ %s doit contenir au maximum 50 caractères',
            'min_length' => 'Le champ %s doit contenir au minimum 3 caractères'
        ));
        $search = $this->input->post('search-input');
        if ($this->form_validation->run()) {
            $data['search_result'] = $this->Pros_model->do_search($search);
        } else {
            $data['search_result'] = "";
            $data['error'] = validation_errors();
        }
        $data['search'] = $search;
        $data['all_data'] = $this->Pros_model->get_all();
        $this->load->view('espace_salons/info_salon', $data);
    }

    public function details()
    {
        $data['id'] = $_GET['id'];
        $data['all_data'] = $this->Pros_model->get_all_where_id($_GET['id']);
        $data['name'] = $data['all_data'][0]->name;
        $data['likes'] = $data['all_data'][0]->likes;
        $data['photos'] = $this->Pros_model->get_photos($_GET['id']);
        $data['likeBtnColor'] = "#2f4f4f";
        if (isConnected() && isset($_SESSION['id_user'])) {
            $data['isLiked'] = $this->Pros_model->isLiked($_SESSION['id_user'], $data['id']);
            if ($data['isLiked'] == 1) {
                $data['likeBtnColor'] = "#0964cc";
            } else if ($data['isLiked'] == 0) {
                $data['likeBtnColor'] = "#2f4f4f";
            }
        }

        if (!$data['all_data'] || !is_numeric($data['id']) || $data['id'] < 1 || !$data['name']) {
            redirect('/Welcome/quatreCentQuatre');
            return;
        }

        // On n'autorise pas les pros à accéder à une autre page que la leur
        if (isConnected() && $_SESSION['type'] === 'pro' && $_GET['id'] !== $_SESSION['id']) {
            redirect('Welcome/details?id=' . $_SESSION['id']);
        }

        $this->load->view('espace_salons/details_salon', $data);
    }

    public function likes()
    {
        $id_pro = $_GET['id'];

        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $isLineLike = $this->Pros_model->count_isLiked($id_user, $id_pro);
        } else {
            $id_user = null;
            $isLineLike = 0;
        }

        if (!isConnected() || $_SESSION['type'] !== "client" || $id_user == null) {
            $response = array(
                'likes' => $this->Pros_model->get_all_where_id($id_pro)[0]->likes,
                'redirect' => true
            );
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {

            // Gère l'ajout de like si l'utilisateur n'a pas encore liké
            if ($isLineLike == 0) {
                $this->Pros_model->set_new_line_likes($id_user, $id_pro, 1);
                $this->Pros_model->set_pro_likes_up($id_pro);
                $response = array(
                    'likes' => $this->Pros_model->get_all_where_id($id_pro)[0]->likes,
                    'color' => "#0964cc"
                );
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $isLiked = $this->Pros_model->isLiked($id_user, $id_pro);
                // Gère le cas où l'utilisateur a déjà liké
                if ($isLiked == 0) {
                    $this->Pros_model->set_pro_likes_up($id_pro);
                    $this->Pros_model->set_liked($id_user, $id_pro, 1);
                    $response = array(
                        'likes' => $this->Pros_model->get_all_where_id($id_pro)[0]->likes,
                        'color' => "#0964cc"
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
                // Gère le cas où l'utilisateur veut retirer son like
                else if ($isLiked == 1) {
                    $this->Pros_model->set_pro_likes_down($id_pro);
                    $this->Pros_model->set_liked($id_user, $id_pro, 0);
                    $response = array(
                        'likes' => $this->Pros_model->get_all_where_id($id_pro)[0]->likes,
                        'color' => "#2f4f4f"

                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
        }
    }

    public function quatreCentQuatre()
    {
        $this->load->view('404');
    }

    public function about()
    {
        $this->load->view('about');
    }

    public function prestations()
    {
        $exists = $this->Pros_model->is_id_exists('id_pro', 'pros', $_GET['id']);

        if (isConnected() && $_SESSION['type'] === "pro") {
            $data['exists'] = $exists;
            if ($exists == false || !is_numeric($_GET['id']) || $_GET['id'] < 1 || $_GET['id'] !== $_SESSION['id']) {
                redirect('Welcome/prestations?id=' . $_SESSION['id']);
            }
        }

        // if $get['id] !== $session['id] redirect Welcome/details?id=$session['id'] ?

        if (!isConnected() || (isConnected() && $_SESSION['type'] === "client")) {
            if ($exists == false) {
                redirect('Welcome/quatrecentquatre');
                return;
            }
        }
        $data['name'] = $this->Pros_model->get_all_where_id($_GET['id'])[0]->name;
        $data['all_prestas'] = $this->Pros_model->get_prestas_where_id_pro($_GET['id']);

        $this->load->view('espace_salons/info_prestations', $data);
    }
}
