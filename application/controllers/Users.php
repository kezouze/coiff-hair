<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{


	public function __construct() // Lien vers les modèles
	{
		parent::__construct();
		$this->load->model("Users_model", "usersManager"); // usersManager est un alias de Users_model
		$this->load->model("Rendez_vous_model", "rdvManager");
		// On peut aussi mettre les Models en autoload
	}

	public function index()
	{
		if (isConnected() == true) {
			redirect('Users/logged');
		}

		$info['error'] = "";

		if (isset($_POST["identifiant"]) && isset($_POST["password"])) {

			// on vérifie si il y a bien une ligne correspondant avec les infos données dans la BDD //
			if ($this->usersManager->cb_users_bis($_POST["identifiant"], md5($_POST["password"])) == 1) {

				$_SESSION['pseudo'] = $_POST["identifiant"];

				redirect('Users/logged');
			} else $info['error'] = 'Veuillez vérifier votre saisie';
		}

		$this->load->view('espace_connexion/login', $info);
	}

	public function inscription() // Avec form_validation
	{
		$this->load->library('form_validation');
		$this->load->database();
		$info['error'] = "";
		$info['valid'] = "";
		$lastName = "";
		$firstName = "";
		$pseudo = "";
		$email = "";
		$password = "";
		$gender = "M";


		$this->form_validation->set_rules(
			'gender',
			'"Genre"',
			'required',
			array(
				'required' => 'Vous devez remplir le champ %s',
			)
		);

		$this->form_validation->set_rules(
			'last_name',
			'"Nom"',
			'required',
			array(
				'required' => 'Vous devez remplir le champ %s',
			)
		);

		$this->form_validation->set_rules(
			'first_name',
			'"Prénom"',
			'required',
			array(
				'required' => 'Vous devez remplir le champ %s',
			)
		);

		$this->form_validation->set_rules(
			'pseudo',
			'"Pseudo"',
			'required|min_length[3]|max_length[12]|is_unique[users.pseudo]',
			array(
				'is_unique' => 'Ce pseudo est déjà pris',
				'required' => 'Vous devez remplir le champ %s',
				'min_length' => 'Le champ %s doit contenir au moins 3 caractères',
				'max_length' => 'Le champ %s doit contenir au maximum 12 caractères'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'"Email"',
			'required|valid_email|is_unique[users.email]',
			array(
				'required' => 'Vous devez remplir le champ %s',
				'valid_email' => 'Vous devez saisir une adresse email valide',
				'is_unique' => 'Cette adresse email est déjà enregistrée'
			)
		);
		$this->form_validation->set_rules(
			'password',
			'"Mot de passe"',
			'required|min_length[6]',
			array(
				'required' => 'Vous devez remplir le champ %s',
				'min_length' => 'Le champ %s doit contenir au moins 6 caractères'
			)
		);
		$this->form_validation->set_rules(
			'confirm_password',
			'"Confirmez votre mot de passe"',
			'required|matches[password]',
			array(
				'required' => 'Vous devez remplir le champ %s',
				'matches' => 'Les mots de passe ne correspondent pas'
			)
		);

		if ($this->form_validation->run() == false) {
			$info['error'] = validation_errors();
		} else {
			$gender = $this->input->post('gender');
			$lastName = $this->input->post('last_name');
			$firstName = $this->input->post('first_name');
			$pseudo = $this->input->post('pseudo'); // Même chose que $_POST['pseudo']
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->usersManager->add_user($gender, $lastName, $firstName, $pseudo, $email, $password);
			$info['valid'] = "Votre compte est bien enregstré ! Redirection à la page d'accueil pour vous connecter...";
			header('refresh: 3; url=http://localhost/code_igniter_arthur/Users');

			// if ($this->usersManager->cb_users_email($email) === 0) {
			// 	if ($this->usersManager->cb_users_pseudo($pseudo) > 0) {
			// 		$info['error'] = "Désolé, ce pseudo est déjà pris."; // cela redirige vers la page d'accueil, pourquoi ?
			// 	} else {
			// 		if ($pseudo !== "" && $email !== "" && $password !== "") {
			// 			$password = md5($password);
			// 			$this->usersManager->add_user($pseudo, $email, $password);
			// 			$info['valid'] = "Nous avons bien ajouté votre compte, veuillez retourner à la page d'accueil pour vous connecter !";
			// 		}
			// 	}
			// } else $info['error'] = "Vous adresse mail est déjà enregistrée, merci de retournez à la page de connexion.";
			// header('refresh: 3; url=http://localhost/code_igniter_arthur/Users'); // à cause de ça ('^-^)
		}
		$this->load->view('espace_inscription/inscription', $info);
	}

	public function logged()
	{
		// on appelle la fonction isConnected() qui est dans le dossier helper
		if (isConnected() == false) {
			redirect('Users');
		}
		$info['id_user'] = $this->rdvManager->get_id_user($_SESSION['pseudo']);
		$info['all_rdv'] = $this->rdvManager->get_all_rendez_vous($info['id_user']);
		$info['first_name'] = $this->usersManager->get_first_name($info['id_user']);
		$info['gender'] = $this->usersManager->get_gender($info['id_user']);
		$this->load->view('espace_connexion/logged', $info);
	}

	public function deconnect()
	{
		session_destroy();
		redirect('Users');
	}

	// à adapter en prenant plutôt l'id de l'utilisateur
	public function forgot_password(/*$code = "" */)
	{
		$info['error'] = "";
		$info['valid'] = "";

		if (isset($_POST['email']) && $_POST['email'] != "") {

			$result = $this->usersManager->cb_users_password($_POST['email']);

			if ($result == 0) {
				$info['error'] = "Veuillez vérifier votre saisie";
			} else if ($result == 1) {

				$email = $_POST['email'];
				$code = random_string();

				$this->usersManager->secret_code($code, $email);

				$this->load->library('email');
				$this->email->from('trouduc@outil-web.fr', 'Vincent');
				$this->email->to($email);
				$this->email->subject('Réinitialisation de votre mot de passe');
				$this->email->message('Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe : ' . anchor(base_url() . 'Users/new_password' . '?code=' . $code . '&email=' . $email));

				if ($this->email->send()) {
					$info['valid'] = "Nous vous avons envoyé un mail de réinitialisation de votre mot de passe";
					// Le lien devrait avoir une limite de validité
				} else {
					echo $this->email->print_debugger();
				}
			} else {
				$info['error'] = 'Une erreur est survenue';
				header('refresh: 3; url=http://[::1]/code_igniter_arthur/Users');
			}
		}
		$this->load->view('espace_mdp/password', $info);
	}

	// On ne devrait pas pouvoir accèder à la page de modif du mot de passe en rentrant de fausse infos
	public function new_password(/*$code, $email*/)
	{

		$info['error'] = "";
		$info['valid'] = "";
		$info['code'] = $_GET['code'];
		$info['email'] = $_GET['email'];

		if (!isset($info['code']) || !isset($info['email'])) {
			header('Location: http://[::1]/code_igniter_arthur/Users/');
			//redirection avec redirect() ou html 
			exit();
		} else {

			$result = $this->usersManager->get_secret_code($_GET['email']);
			// cela renvoie un objet contenant le code

			$secret_code = $result[0]->secret_code;
			// cela accède au contenu de l'objet qui nous intéresse : la chaine de caractères

			if ($secret_code === $info['code']) {
				if (isset($_POST['new_password']) && isset($_POST['confirm_new_password'])) {
					if ($_POST['new_password'] === $_POST['confirm_new_password']) {
						$new_password = $_POST['new_password'];
						$this->usersManager->change_password($info['email'], md5($new_password));
						$info['valid'] = 'Nous avons bien modifié votre mot de passe ! Redirection vers la page d\'accueil... ';
						header('refresh: 4; url=http://localhost/code_igniter_arthur/Users');
					} else $info['error'] = "Veuillez vérifier votre saisie";
				}
			} else $info['error'] = "Une erreur est survenue";
			$this->load->view('espace_mdp/new_password', $info);
		}
	}

	public function rendez_vous()
	{
		$info['error'] = "";
		$info['valid'] = "";
		$info['today'] = date('Y-m-d');
		$today = $info['today'];
		$info['one'] = 1;
		$one = $info['one'];
		$info['year'] = 365;
		$year = $info['year'];
		$info['now'] = date('H:i');
		$tomorrow = date('Y-m-d', strtotime($today . " + $one days"));
		$info['tomorrow'] = $tomorrow;
		$info['aYearLater'] = date('Y-m-d', strtotime($today . " + $year days"));
		$info['id_user'] = $this->rdvManager->get_id_user($_SESSION['pseudo']);

		if (isset($_POST['date']) && isset($_POST['heure'])) {
			$info['date'] = $_POST['date'];
			$info['heure'] = $_POST['heure'];
			$info['isAvailable'] = $this->rdvManager->isAvailable($_POST['date'], $_POST['heure']);
		} else {
			$info['date'] = $tomorrow;
			$info['heure'] = date('H:i');
		}
		$info['creneaux'] = [
			"09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00", "12:00:00",
			"13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00", "16:00:00", "16:30:00", "17:00:00"
		];
		foreach ($info['creneaux'] as &$key) { // Le '&' fait fonctionner le bazar. ???
			if ($this->rdvManager->isAvailable($info['date'], $key) > 0) {
				$key = "indisponible";
			}
		}
		if (isConnected() == false) {
			redirect('Users');
		} else {
			$this->load->database(); // Necéssaire ?

			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('time', 'Heure', 'required');
			$this->form_validation->set_rules('details', 'Détails');

			if ($this->form_validation->run() == false) {
				$info['error'] = validation_errors();
			} else {
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				$details = $this->input->post('details');
				$this->rdvManager->set_new_rendez_vous($info['id_user'], $date, $time, $details);
				$info['valid'] = "Votre rdv est enregistré, retour à la page précédente..";
				header('refresh:3; url = http://[::1]/code_igniter_arthur/Users/logged');
			}
		}
		$this->load->view('espace_rendez_vous/rendez_vous', $info);
	}

	public function delete_rdv()
	{

		$this->rdvManager->delete_rdv($_GET['id_rdv']);
		redirect('/Users');
	}

	public function modify_rdv()
	{
		$info['error'] = "";
		$info['valid'] = "";
		$info['id_rdv'] = $_GET['id_rdv'];

		if (isConnected() == false) {
			redirect('Users');
		} else {
			// $this->load->library('form_validation'); // Normalement en autoload
			$this->load->database(); // Necéssaire ?

			$this->form_validation->set_rules('date', 'Date', 'required');
			$this->form_validation->set_rules('time', 'Heure', 'required');
			// $this->form_validation->set_rules('details', 'Détails');

			if ($this->form_validation->run() == false) {
				$info['error'] = validation_errors();
			} else {
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				// $details = $this->input->post('details');
				$this->rdvManager->modify_rdv($info['id_rdv'], $date, $time/*, $details*/);
				$info['valid'] = "Votre rdv a bien été modifié, retour à la page précédente..";
				header('refresh:3; url = http://[::1]/code_igniter_arthur/Users/logged');
			}
		}
		$this->load->view('espace_rendez_vous/modifier_rendez_vous', $info);
	}
}
