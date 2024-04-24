<?php

namespace App\Controllers;

use \App\Models\UtilisateurModel;

class Authentification extends BaseController
{
    public function inscrire()
    {
        $methode = $this->request->getMethod();

        if ($methode == "post") {
            $donnees = [
                "nom"=>$this->request->getPost("nom"),
                "email"=>$this->request->getPost("email"),
                "mdp"=>$this->request->getPost("mdp")
            ];

            $rules = [
                "nom"=> "required|max_length[20]|min_length[3]",
                "email"=> "required|valid_email|is_unique[utilisateur.email]",
                "mdp"=> "required|min_length[1]",
                "confirmerMdp"=> "required|matches[mdp]",
            ];

            if(!$this->validate($rules)) {
                session()->setFlashdata("errors",$this->validator->getErrors());
                echo(session()->getFlashdata("errors"));
                //return redirect()->back()->withInput();
            }
            $donnees['mdp'] = password_hash(strval($donnees['mdp']), PASSWORD_BCRYPT);

            $utilisateurModel = new UtilisateurModel();
            $utilisateurModel->insert($donnees);
            echo("insert avec sucess");
            // return redirect()->to(base_url('connexion'));
        }


    return view("inscription");
    }

    public function connecter()
    {
        return view("connexion");
    }

}



