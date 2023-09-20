<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	// Peut-on faire un seul controlleur pour pro et clients ? :
	// private $tableName = 'users';

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

		$this->form_validation->set_rules('identifiant', 'Identifiant', 'trim|required');
		$this->form_validation->set_rules('password', 'Mot de passe', 'trim|required');

		if ($this->form_validation->run()) {
			if ($this->usersManager->cb_users_bis($_POST["identifiant"], md5($_POST["password"])) == 1) {
				$_SESSION['pseudo'] = trim(htmlspecialchars($_POST["identifiant"]));
				$_SESSION['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);
				$_SESSION['type'] = "client";
				redirect('Users/logged');
			} else {
				$info['error'] = "Identifiant ou mot de passe incorrect";
			}
		} else {
			$info['error'] = validation_errors();
		}
		$this->load->view('espace_connexion/login', $info);
	}

	public function inscription()
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
			'trim',
			// Ancienne façon :
			'trim|required',
			array(
				'required' => 'Champ %s obligatoire',
			)
		);

		$this->form_validation->set_rules(
			'last_name',
			'"Nom"',
			'trim'
		);

		$this->form_validation->set_rules(
			'first_name',
			'"Prénom"',
			'trim'
		);

		$this->form_validation->set_rules(
			'pseudo',
			'"Pseudo"',
			'trim|min_length[3]|is_unique[users.pseudo]',
			array(
				'is_unique' => 'Ce pseudo est déjà pris.',
				'min_length' => 'Le champ %s doit contenir au moins 3 caractères.'
			)
		);
		$this->form_validation->set_rules(
			'email',
			'"Email"',
			'trim|valid_email|is_unique[users.email]',
			array(
				'valid_email' => 'Vous devez saisir une adresse email valide.',
				'is_unique' => 'Cette adresse email est déjà enregistrée.'
			)
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
			'confirm_password',
			'"Confirmez votre mot de passe"',
			'trim|matches[password]',
			array(
				'matches' => 'Les mots de passe ne correspondent pas.'
			)
		);

		if ($this->form_validation->run() == false) {
			$info['error'] = validation_errors();
		} else {
			$gender = $this->input->post('gender');
			$lastName = htmlspecialchars($this->input->post('last_name'));
			$firstName = htmlspecialchars($this->input->post('first_name'));
			$pseudo = htmlspecialchars($this->input->post('pseudo'));
			$email = htmlspecialchars($this->input->post('email'));
			$password = md5($this->input->post('password'));
			$this->usersManager->add_user($gender, $lastName, $firstName, $pseudo, $email, $password);
			$info['valid'] = "Votre compte est bien enregistré ! Redirection à la page d'accueil pour vous connecter...";
			header('refresh: 3; url=http://[::1]/coiffhair/Users');
		}
		$this->load->view('espace_inscription/inscription', $info);
	}

	public function logged()
	{
		if ($_SESSION['type'] !== "client") {
			session_destroy();
			redirect('Users');
		}
		// on appelle la fonction isConnected() qui est dans le dossier helper
		if (isConnected() == false || $_SESSION['type'] !== "client") {
			redirect('Users');
		} else {
			$info['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);
			$_SESSION['id_user'] = $info['id_user'];
		}
		if (!isset($_SESSION['counted']) || $_SESSION['counted'] == false) {
			$info['nbConn'] = $this->usersManager->get_nb_conn($info['id_user']);
			$info['nbConn']++;
			$this->usersManager->set_nb_conn($info['id_user'], $info['nbConn']);
			$_SESSION['counted'] = true;
		}
		$info['pseudo'] = $_SESSION['pseudo'];
		$info['all_rdv'] = $this->rdvManager->get_all_rendez_vous($info['id_user']);
		$info['old_rdv'] = []; // on initialise les tableaux pour éviter une erreur undefined dans la vue
		$info['next_rdv'] = [];
		$info['now'] = time();
		$email = $this->usersManager->get_email($info['id_user']);
		$info['first_name'] = $this->usersManager->get_first_name($info['id_user']);
		$firstName = $info['first_name'];
		$info['gender'] = $this->usersManager->get_gender($info['id_user']);

		foreach ($info['all_rdv'] as $rdv) {
			$info['rdvDateTime'] = strtotime($rdv->date_rendez_vous . ' ' . $rdv->heure_rendez_vous);
			if ($info['rdvDateTime'] > $info['now']) {
				$info['next_rdv'][] = $rdv; // on stocke les rdv à venir
				// condition pour rappel du rdv 24h avant
				if ($rdv->date_rendez_vous == date('Y-m-d', strtotime('+1 day'))) {
					$time = $this->rdvManager->get_time($rdv->id_rendez_vous);
					$details = $this->rdvManager->get_details($rdv->id_rendez_vous);
					// $this->load->library('email'); autoloadé dans config/autoload.php
					$this->email->from('coiff_hair@laposte.net', '💈Coiff\'Hair💈');
					$this->email->to($email);
					$this->email->subject('Rappel de votre rendez-vous');
					$this->email->message('Bonjour ' . $firstName . ',
							<br>Ceci est un petit message pour vous rappeler votre prochain rendez-vous demain à ' . substr($time, 0, 5) . '.<br>
							Vous avez rendez-vous pour : <i>' . $details . '</i>.
							<br>N\'hésitez pas à nous contacter si besoin, ou modifier / annuler le rendez-vous directement sur votre espace personnel.
							<br>Cordialement, L\'équipe de Coiff\'Hair :-)');
					// désactivation du mail pour éviter de spammer
					// $this->email->send();
					// $this->rdvManager->set_email_sent($rdv->id_rendez_vous);
				}
			} else {
				$info['old_rdv'][] = $rdv; // on stocke les rdv passés
			}
		}
		$this->load->view('espace_connexion/logged', $info);
	}

	public function deconnect()
	{
		session_destroy();
		redirect('Welcome');
	}

	public function forgot_password()
	{
		$info['error'] = "";
		$info['valid'] = "";

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('valid_email' => 'Vous devez saisir une adresse email valide.'));
		if ($this->form_validation->run()) {
			$email = $_POST['email'];
			$result = $this->usersManager->cb_users_password($email, 'users');
			if ($result == 0) {
				$info['error'] = "Aucune correspondance trouvée";
			} else if ($result == 1) {
				$code = random_string();
				$this->usersManager->secret_code($code, $email, 'users');
				$this->load->library('email');
				$this->email->to($email);
				$this->email->from('coiff_hair@laposte.net', '💈Coiffhair💈');
				$this->email->subject('Réinitialisation de votre mot de passe');
				$this->email->message('Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe : ' . anchor(base_url() . 'Users/new_password' . '?code=' . $code . '&email=' . $email));
				$this->email->send();
				$info['valid'] = "Un mail de réinitialisation à été envoyé. Retour à la page de connexion...";
				// Le lien devrait avoir une limite de validité
				header('refresh: 3; url=http://[::1]/coiffhair/Users');
			}
		} else {
			$info['error'] = validation_errors();
		}
		$this->load->view('espace_mdp/password', $info);
	}

	public function new_password()
	{

		$info['error'] = "";
		$info['valid'] = "";
		$code = $_GET['code'];
		$email = $_GET['email'];

		if (!isset($code) || !isset($email)) {
			redirect('Welcome');
		} else {
			// cela renvoie un objet contenant le code
			$result = $this->usersManager->get_secret_code($email, 'users');
			// cela accède au contenu de l'objet qui nous intéresse : la chaine de caractères
			$secret_code = $result[0]->secret_code;
			$user_email = $result[0]->email;

			if ($secret_code === $code && $user_email === $email) {
				$this->form_validation->set_rules('new_password', 'Nouveau mot de passe', 'trim|required|min_length[6]', array('min_length' => 'Le champ %s doit contenir au moins 6 caractères.'));
				$this->form_validation->set_rules('confirm_new_password', 'Confirmation du nouveau mot de passe', 'trim|required|matches[new_password]', array('matches' => 'Les deux saisies ne correspondent pas.'));

				if ($this->form_validation->run()) {
					$new_password = $_POST['new_password'];
					$this->usersManager->change_password($email, md5($new_password), 'users');
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

	public function rendez_vous()
	{
		// faire le tri là-dedans :
		$info['error'] = "";
		$info['valid'] = "";
		$info['today'] = date('Y-m-d');
		$today = $info['today'];
		$info['one'] = 1;
		$one = $info['one'];
		$seven = 7;
		$thirtyOne = 31;
		$info['year'] = 365;
		$year = $info['year'];
		$info['now'] = date('H:i');
		$tomorrow = date('Y-m-d', strtotime($today . " + $one days"));
		$info['tomorrow'] = $tomorrow;
		$info['aWeekLater'] = date('Y-m-d', strtotime($today . " + $seven days"));
		$info['aMonthLater'] = date('Y-m-d', strtotime($today . " + $thirtyOne days"));
		$info['aYearLater'] = date('Y-m-d', strtotime($today . " + $year days"));
		// $info['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);
		$info['nb_rdv'] = $this->rdvManager->get_nb_next_rdv($_SESSION['id_user']);
		// $info['salons'] = array_column($this->Pros_model->get_all(), 'name'); // Très pratique !
		$info['salons'] = $this->Pros_model->get_all();
		$id_user = $this->usersManager->get_id_user($_SESSION['pseudo']);
		$email = $this->usersManager->get_email($id_user);

		if (isConnected() == false) {
			redirect('Users');
		} else {
			$this->load->database();
			$this->form_validation->set_rules('proSelect', 'Salon', 'trim|required');
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			$this->form_validation->set_rules('time', 'Heure', 'trim|required');
			$this->form_validation->set_rules('details', 'Détails', 'trim|required|max_length[500]', array('max_length' => 'Le champ %s ne peut pas contenir plus de 500 caractères'));

			if ($this->form_validation->run() == false) {
				$info['error'] = validation_errors();
			} else {
				$id_pro = $this->input->post('proSelect');
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				$time = str_replace('h', ':', $time);
				$details = htmlspecialchars($this->input->post('details'));
				$this->rdvManager->set_new_rendez_vous($id_pro, $id_user, $date, $time, $details);
				$info['valid'] = "Votre rdv est enregistré, retour à la page précédente...";
				$this->load->library('email');
				$this->email->to($email);
				$this->email->from('coiff_hair@laposte.net', '💈Coiff\'Hair💈');
				$this->email->subject('Confirmation de votre rendez-vous');
				// Enlever les liens sinon la Poste bloque l'envoi du mail
				$message = 'Bonjour ' . $this->usersManager->get_first_name($id_user) . ',
				<br>Votre rendez-vous est bien enregistré pour le ' . date('d/m', strtotime($date)) . ' à ' . substr($time, 0, 5) . ' au salon ' . $this->Pros_model->get_name($id_pro) . '
				<br>Vous avez rendez-vous pour : <i>' . $details . '</i>.
				<br>Cordialement, L\'équipe de Coiff\'Hair :-)';
				$this->email->message($message);

				// désactivation du mail pour éviter de spammer
				// if ($this->email->send()) {
				$info['valid'] = "Votre rdv est enregistré, retour à la page précédente...";
				header('refresh:3; url = http://[::1]/coiffhair/Users/logged');
				// } else {
				// 	echo $this->email->print_debugger();
				// 	return;
				// }
			}
		}
		if ($info['nb_rdv'] >= 3) {
			redirect('Users/logged');
		} else {
			$this->load->view('espace_rendez_vous/rendez_vous', $info);
		}
	}

	public function modify_rdv()
	{
		$info['error'] = "";
		$info['valid'] = "";
		$id_rdv = $_GET['id_rdv'];
		// l' utilisateur ne peut modifier que ses propres rdv :
		if (!isset($id_rdv) || $id_rdv === "" || $this->rdvManager->is_rdv_exists($id_rdv, $_SESSION['id_user']) == 0) {
			redirect('Users/logged');
		}
		$info['date'] = $this->rdvManager->get_date($id_rdv);
		$info['time'] = $this->rdvManager->get_time($id_rdv);
		$info['time'] = str_replace(':', 'h', $info['time']);
		$info['today'] = date('Y-m-d');
		$info['now'] = date('H:i');
		$today = $info['today'];
		$one = 1;
		$info['year'] = 365;
		$year = $info['year'];
		$tomorrow = date('Y-m-d', strtotime($today . " + $one days"));
		$info['tomorrow'] = $tomorrow;
		$info['aYearLater'] = date('Y-m-d', strtotime($today . " + $year days"));
		$info['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);
		// $info['details'] = $this->rdvManager->get_details($id_rdv);
		$info['details'] = $this->rdvManager->get_data_rdv_where_id($_GET['id_rdv']);
		$id_pro = $info['details'][0]->id_pro;

		if (isset($_POST['date']) && isset($_POST['time'])) {
			$date = $_POST['date'];
			$time = $_POST['time'];
		} else {
			$date = $tomorrow;
			$time = date('H:i');
		}

		if (isConnected() == false) {
			redirect('Users');
		} else {
			$this->load->database();
			$this->form_validation->set_rules('date', 'Date', 'trim|required');
			$this->form_validation->set_rules('time', 'Heure', 'trim|required');
			$this->form_validation->set_rules('details', 'Détails', 'trim|required|max_length[500]', array('max_length' => 'Le champ %s ne peut pas contenir plus de 500 caractères'));

			if ($this->form_validation->run() == false) {
				$info['error'] = validation_errors();
			} else {
				$date = $this->input->post('date');
				$time = $this->input->post('time');
				$time = str_replace('h', ':', $time);
				$details = htmlspecialchars($this->input->post('details'));
				$this->rdvManager->modify_rdv($id_rdv, $date, $time, $details);
				// $this->rdvManager->set_email_not_sent($id_rdv);
				$this->load->library('email');
				$this->email->to($this->usersManager->get_email($info['id_user']));
				$this->email->from('coiff_hair@laposte.net', '💈Coiff\'Hair💈');
				$this->email->subject('Modification de votre rendez-vous');
				$this->email->message('Bonjour ' . $this->usersManager->get_first_name($info['id_user']) . ',
						<br>Votre rendez-vous est bien modifié pour le ' . date('d/m', strtotime($date)) . ' à ' . substr($time, 0, 5) . ' au salon ' . $this->Pros_model->get_name($id_pro) . '.
						<br>Vous avez rendez-vous pour : <i>' . $details . '</i>.
						<br>Vous avez la possibilité de modifier ou annuler ce rendez-vous directement sur votre espace personnel : ' . anchor(base_url() . 'Users/') . '.
						<br>Cordialement, L\'équipe de Coiff\'Hair ;-)');
				// désactivation du mail pour éviter de spammer
				// if ($this->email->send()) {
				$info['valid'] = "Votre rdv a bien été modifié, retour à la page précédente..";
				header('refresh:3; url = http://[::1]/coiffhair/Users/logged');
				// } else echo $this->email->print_debugger();
				// return;
			}
		}
		$this->load->view('espace_rendez_vous/modifier_rendez_vous', $info);
	}

	public function get_available_times()
	{
		$selectedPro = $this->input->post('pro');
		$selectedDate = $this->input->post('date');
		$info['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);

		// Le tableau de nos créneaux horaires
		$availableTimes = [
			"09:00:00", "09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00", "12:00:00",
			"13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00", "16:00:00", "16:30:00", "17:00:00"
		];

		// On boucle sur le tableau des créneaux horaires pour chaque possibilités
		foreach ($availableTimes as &$key) {
			// On vérifie si le créneau horaire est présent dans la table rdv ou non
			$result = $this->rdvManager->isAvailable($selectedDate, $key, $selectedPro);
			if ($result > 0) {
				// Si le créneau horaire est déjà pris, on le remplace par indisponible
				$key = "indisponible";
			} else {
				$key = substr($key, 0, 5);
				$key = str_replace(':', 'h', $key);
			}
		}
		// On formule la réponse de la requête jQuery
		$response = array(
			'times' => $availableTimes
		);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function delete_rdv()
	{
		$rdv = $_GET['id_rdv'];
		// l' utilisateur ne peut supprimer que ses propres rdv :
		if (!isConnected() || !isset($rdv) || $rdv === "" || $this->rdvManager->is_rdv_exists($rdv, $_SESSION['id_user']) === 0) {
			redirect('Users/');
		}
		$this->rdvManager->delete_rdv($rdv);
		$this->load->library('email');
		$this->email->to($this->usersManager->get_email($_SESSION['id_user']));
		$this->email->from('coiff_hair@laposte.net', '💈Coiff\'Hair💈');
		$this->email->subject('Annulation de votre rendez-vous');
		$this->email->message('Bonjour ' . $this->usersManager->get_first_name($_SESSION['id_user']) . ',
				<br>Votre rendez-vous est bien annulé, nous sommes désolé de vous voir partir :-(.
				<br>Cordialement, L\'équipe de Coiff\'Hair ;-)');
		// désactivation du mail pour éviter de spammer		
		// if ($this->email->send()) {
		// 	$info['valid'] = "Votre rdv a bien été annulé, retour à la page précédente..";
		redirect('/Users');
		// } else echo $this->email->print_debugger();
		// return;
	}

	public function delete_old_rdv()
	{
		if (isConnected() == false) {
			redirect('Users');
		} else {
			$info['id_user'] = $this->usersManager->get_id_user($_SESSION['pseudo']);
			$info['all_rdv'] = $this->rdvManager->get_all_rendez_vous($info['id_user']);
			foreach ($info['all_rdv'] as $rdv) {
				if ($rdv->date_rendez_vous < date('Y-m-d') || ($rdv->date_rendez_vous == date('Y-m-d') && $rdv->heure_rendez_vous < date('H:i'))) {
					$this->rdvManager->delete_rdv($rdv->id_rendez_vous);
				}
			}
			redirect('/Users/logged');
		}
	}
}
