<?php

namespace App\Controllers;
use App\Models\GroupeModel;
use App\Models\MembreGroupe;
use \App\Validation\UserRules;
use \App\Models\UtilisateurModel;

/**
 * ProfilController
 * Gère la fonctionnalité d'afficher du profil utilisateur.
 * @author Thi Chau <pnhichau1701@gmail.com>,Zineb Fennich <penpalzineb@gmail.com>
 */
class ProfilController extends BaseController
{
    /**
     * Affiche la page du profil utilisateur.
     * @return mixed Retourne une vue de la page du profil utilisateur.
     */
    public function afficher(): string
    {   $user= new UtilisateurModel();
        $nom_user=$user->select('nom_user')->where('id',session()->get('id'))->first();//mon profil
        $email_user=$user->select('email')->where('id',session()->get('id'))->first();//mon profil
        if($nom_user==null && $email_user==null){
            $data['nom_user']='';
            $data['email']='';
        }
        else{
            $data=[
                'nom_user'=>$nom_user['nom_user'],
                'email_user'=>$email_user['email']
            ];
        }
        return view('profil',$data);
    }
    public function profilUtilisateur($id_u){
        $user= new UtilisateurModel();
        $nom_user=$user->select('nom_user')->where('id',$id_u)->first();//profil des autres
        $email_user=$user->select('email')->where('id',$id_u)->first();//profil des autres
        $data=[
            'nom_user'=>$nom_user['nom_user'],
            'email_user'=>$email_user['email']
        ];
        return view('profil',$data);
    }
}