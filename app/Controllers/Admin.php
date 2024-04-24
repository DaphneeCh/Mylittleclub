<?php
namespace App\Controllers;
use App\Models\MembreGroupe;
use App\Models\GroupeModel;
use App\Models\UtilisateurModel;

class Admin extends BaseController{

    //Fonction pour accepter à rejoindre un groupe
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
    
    //Fonction pour rejeter ou supprimer 
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
    public function displayAdminPage($id_gr){
        $data = [];
        $groupe_model = new GroupeModel();
        $groupe = $groupe_model->find($id_gr);// Vérifier un groupe est existe
        if (!$groupe) {//Si un groupe n'existe pas
            $data['group_name'] = 'Ne pas trouvé';
    
            return view('Admin_page',$data);
        }

        $session=session();
        $id_user=session()->get('id');
        $query=$groupe_model->select('id_admin')->where('id_gr',$id_gr)->first();
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
        
        if($this->request->getMethod()== 'post'){ 
            if($this->request->getPost('decision')=='accept'){
                $this->approveDemande($id_gr,$this->request->getPost('id_user'));
            }
            else if($this->request->getPost('decision')=='refuse'){
                $this->rejeterDemande($id_gr,$this->request->getPost('id_user'));
            }
        }

        $user_model = new UtilisateurModel;
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