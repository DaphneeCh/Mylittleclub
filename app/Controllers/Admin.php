<?php
namespace App\Controllers;
use App\Models\MembreGroupe;
use App\Models\GroupeModel;
use App\Models\UtilisateurModel;

/**
 * Classe Admin
 * Gère les fonctionnalités administratives comme l'approbation ou le rejet des demandes pour rejoindre des groupes.
 * @author Thi Chau <pnhichau1701@gmail.com>
 */
class Admin extends BaseController{

    /**
     * Approuve la demande d'un utilisateur pour rejoindre un groupe.
     * Met à jour la base de données pour refléter l'approbation de l'utilisateur au groupe spécifié.
     *
     * @param int $id_gr Identifiant du groupe.
     * @param int $id_user Identifiant de l'utilisateur.
     */
    public function approveDemande($id_gr,$id_user){
        $membre=new MembreGroupe();
        $groupe_model = new GroupeModel();
        $groupe = $groupe_model->find($id_gr);
        if (!$groupe) {//Si un groupe n'existe pas
            $data['group_name'] = 'Ne pas trouvé';
            echo 'Ne pas trouvé';
        }
        //mis-à-jour BDD
        $res = $membre->set('Demande_adhesion',0,false)->where('id_groupe',$id_gr)->where('id_user',$id_user)->update();

    }
    
    /**
     * Rejette ou supprime la demande d'un utilisateur pour rejoindre un groupe.
     * Supprime l'enregistrement de la demande de l'utilisateur pour le groupe spécifié dans la base de données.
     *
     * @param int $id_gr Identifiant du groupe.
     * @param int $id_user Identifiant de l'utilisateur.
     */
    public function rejeterDemande($id_gr,$id_user){
        $membre=new MembreGroupe();
        $groupe_model = new GroupeModel();
        $groupe = $groupe_model->find($id_gr);
        if (!$groupe) {//Si un groupe n'existe pas
            $data['group_name'] = 'Ne pas trouvé';
            echo 'Ne pas trouvé';
        }
        //mis-à-jour BDD
        $membre->where('id_groupe',$id_gr)->where('id_user',$id_user)->delete();

    }
    /**
     * Affiche la page d'administration d'un groupe.
     * Affiche les membres du groupe et les utilisateurs en attente d'approbation.
     *
     * @param int $id_gr Identifiant du groupe.
     *@return mixed Retourne une vue de la page d'administration avec les données pertinentes du groupe.
    */
    public function displayAdminPage($id_gr){
        $data = [];
        $groupe_model = new GroupeModel();
        $groupe = $groupe_model->find($id_gr);// Vérifier un groupe est existe
        if (!$groupe) {//Si un groupe n'existe pas
            $data['group_name'] = 'Ne pas trouvé';
    
            return view('Admin_page',$data);
        }
        //Vérifier si un utilisateur est connecté
        $id_user=session()->get('id');
        //Requête pour trouver l'admin d'un groupe
        $query=$groupe_model->select('id_admin')->where('id_gr',$id_gr)->first();
        //Requête pour trouver l'id du groupe
        $idG=$groupe_model->select('id_gr')->where('id_gr',$id_gr)->first();
        $data['group_id']=$idg=$idG['id_gr'];
        $id_admin=$query['id_admin'];



        if ($id_admin==$id_user){//Vérifier condition pour afficher admin page
            $data['group_name'] = $groupe['nom_gr'];
            $data['id_admin']=$id_admin;

        }
        else{
            $data['group_name']='Ne pas trouvé';
            $data['liste_membre'] = [];
        
            $data['liste_attente'] = [];

            return view('Admin_page',$data);
        }
        //Vérifier si un utilisateur a cliqué sur le bouton accepter ou refuser
        if($this->request->getMethod()== 'post'){ 
            if($this->request->getPost('decision')=='accept'){
                $this->approveDemande($id_gr,$this->request->getPost('id_user'));
            }
            else if($this->request->getPost('decision')=='refuse'){
                $this->rejeterDemande($id_gr,$this->request->getPost('id_user'));
            }
        }

        $user_model = new UtilisateurModel();
        //Requête pour trouver les membres d'un groupe
        $res = $user_model->select('id,nom_user')
                ->join('membre','id=membre.id_user AND membre.Demande_adhesion=0 AND membre.id_groupe='.$id_gr)->findAll();
        //Requête pour trouver les utilisateurs attendent l'acceptation d'admin 
        $resultat=$user_model->select('id,nom_user')
                ->join('membre','id=membre.id_user AND membre.Demande_adhesion=1 AND membre.id_groupe='.$id_gr)->findAll();
        
        $data['liste_membre'] = $res;
        
        $data['liste_attente'] = $resultat;
       
        return view('Admin_page',$data);
    }


}