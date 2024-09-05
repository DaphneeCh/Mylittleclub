<?php
namespace App\Controllers;

/**
 * ControllerAcceuil
 * Gère la fonctionnalité de la page d'accueil.
 * @author Dorra Charkour <dora.charkour@gmail.com>,Zineb Fennich <penpalzineb@gmail.com>
 */
class ControllerAcceuil extends BaseController {

    /**
     * Affiche la page d'accueil.
     * @return mixed Retourne une vue de la page d'accueil.
     */
    public function acceuil()
    {
        return(view('Acceuil.php'));

    }
}