<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inscription extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Users_model", "usersManager"); // Activer autoload des Models ?
    }

    public function index()
    {
        // on initialise les messages d'erreurs à une chaine vide //
        $info['error'] = "";

        // on vérifie que les champs sont remplis et ne sont pas une chaine de caractère vide // 
        if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            if ($_POST['pseudo'] !== "" && isset($_POST['email']) !== "" && $_POST['password'] !== "" && $_POST['confirm_password'] !== "") {

                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);

                // on vérifie que les 2 inputs contiennent la même chose //
                if ($_POST['password'] === $_POST['confirm_password']) {

                    // ajouter une vérif pour voir si il n'y a pas déjà un compte avec ces infos // 
                    if ($this->usersManager->cb_users($_POST["pseudo"], $_POST['email'], md5($_POST["password"])) === 0) {

                        $this->usersManager->add_user($pseudo, $email, $password);
                        echo 'Nous avons bien ajouté votre compte ! 
                  redirection vers la page d\'accueil pour vous connecter...';
                        header('refresh: 5; url=http://localhost/code_igniter_arthur/Connexion');
                    } else $info['error'] = 'Vous possédez déjà un compte, veuillez vous rendre sur la page de connexion';
                } else $info['error'] = 'Vérifier la saisie du mot de passe';
            } else $info['error'] = 'Veuillez vérifier votre saisie';
        }

        $this->load->view('espace_inscription/inscription', $info);
    }
}
