<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Marche pas
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.infomaniak.com';
$config['smtp_user'] = 'projet-pro@outil-web.fr';
$config['smtp_pass'] = 'TSA-corp69';
$config['smtp_port'] = 465;
$config['smtp_crypto'] = 'starttls';
// $config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
*/

// Marche pas
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.office365.com';
$config['smtp_user'] = 'vincent-c51@hotmail.fr';
$config['smtp_pass'] = $mdp;
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'starttls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
*/

// Marche pas
/*
$config['protocol'] = 'IMAP';
$config['smtp_host'] = 'outlook.office365.com';
$config['smtp_user'] = 'vincent-c51@hotmail.fr';
$config['smtp_pass'] = $mdp;
$config['smtp_port'] = 993;
$config['smtp_crypto'] = 'TLS';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
*/

// Marche pas
/*
$config['protocol'] = 'POP';
$config['smtp_host'] = 'outlook.office365.com';
$config['smtp_user'] = 'vincent-c51@hotmail.fr';
$config['smtp_pass'] = $mdp;
$config['smtp_port'] = 995;
$config['smtp_crypto'] = 'TLS';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
*/

// OK
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.laposte.net';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'coiff_hair@laposte.net';
$config['smtp_pass'] = 'TzF2d{8peymxR6';
$config['smtp_crypto'] = 'ssl';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
// .gitignore