<?php

use App\Controllers\Groupe;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/acceuil', 'ControllerAcceuil::acceuil');
$routes->get('/profil', 'ProfilController::afficher');
$routes->get('/profil/(:num)','ProfilController::profilUtilisateur/$1');
$routes->post('/profil/(:num)','ProfilController::profilUtilisateur/$1');
$routes->get('/groupe', 'Groupe::creerGroupe');
$routes->post('/groupe', 'Groupe::creerGroupe');
$routes->match(['get','post'],'formulaire_groupe','Groupe::index');
$routes->match(['get','post'],'inscription','Utilisateur::inscrire');
$routes->match(['get','post'],'connexion','Utilisateur::connecter');
//$routes->get('/groupepage/(:num)','Groupe::ecrirePublication');
//$routes->post('/groupepage/(:num)', 'Groupe::ecrirePublication');
//$routes->match(['get','post'],'Groupe_page','Groupe::ecrirePublication');
//$routes->match(['get','post'],'rejoindre','Groupe::rejoindreUnGroupe');

$routes->get('/groupepage/(:num)','Groupe::gestionUnGroupe/$1');
// $routes->post('/groupepage/(:num)','Groupe::rejoindreUnGroupe/$1');
$routes->post('/groupepage/(:num)','Groupe::gestionUnGroupe/$1');
$routes->post('groupepage/vote', 'Groupe::voter');
$routes->get('groupepage/vote', 'Groupe::voter');



$routes->get('/admin/(:num)','Admin::displayAdminPage/$1');
$routes->post('/admin/(:num)','Admin::displayAdminPage/$1');
$routes->get('admin/groupepage/(:num)','Groupe::displaygroup/$1');

$routes->get('/homepage','Utilisateur::afficheHomePage');
$routes->post('/homepage','Utilisateur::afficheHomePage');

$routes->post('/homepage/recherche','Utilisateur::barreRecherche');
$routes->get('/homepage/recherche','Utilisateur::barreRecherche');

$routes->post('/logout','Utilisateur::logout');
$routes->get('/logout','Utilisateur::logout');
// service('auth')->routes($routes);