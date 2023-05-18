<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Connexion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Users_model", "usersManager"); // usersManager est un alias de Users_model
	}

	// public function index()
	// {
	// 	if (isConnected() == true) {
	// 		redirect('Connexion/logged');
	// 	}

	// 	$data['error'] = "";

	// 	if (isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["password"])) {

	// 		// on vérifie si il y a bien un tuple correspondant dans la BDD // 
	// 		if ($this->usersManager->cb_users($_POST["pseudo"], $_POST["email"], md5($_POST["password"])) == 1) {

	// 			$_SESSION['pseudo'] = $_POST["pseudo"];
	// 			redirect('Connexion/logged');
	// 		} else $data['error'] = 'Veuillez vérifier votre saisie';
	// 	}

	// 	$this->load->view('espace_connexion/login', $data);
	// }

	public function index()
	{
		if (isConnected() == true) {
			redirect('Connexion/logged');
		}

		$data['error'] = "";

		if (isset($_POST["identifiant"]) && isset($_POST["password"])) {

			// on vérifie si il y a bien un tuple correspondant dans la BDD // 
			if ($this->usersManager->cb_users_bis($_POST["identifiant"], md5($_POST["password"])) == 1) {

				$_SESSION['pseudo'] = $_POST["identifiant"];

				redirect('Connexion/logged');
			} else $data['error'] = 'Veuillez vérifier votre saisie';
		}

		$this->load->view('espace_connexion/login', $data);
	}

	public function logged()
	{
		// on appelle la fonction isConnected() qui est dans le dossier helper // 
		if (isConnected() == false) {
			redirect('Connexion');
		}

		$this->load->view('espace_connexion/logged');
	}

	public function deconnect()
	{
		session_destroy();
		redirect('Connexion');
	}

	public function forgot_password()
	{
		$this->load->view('espace_mdp/password');

		// if(isset($_POST['email']) && $_POST['email'] !== ""){
		// 	if($this->usersManager->cb_users_password($_POST['email']) == 1) {
		// 		$this->load->view()
		// 		$this->usersManager->reset_password()
		// 	}
		// }
	}
}
