<?php
namespace App\Controllers;

use App\Models\Commentaire_Model;
use App\Models\MembreGroupe;
use App\Models\GroupeModel;
use App\Models\Publication_Model;

class Groupe extends BaseController {

    
    public function index()
    {
        helper(['form']);
        $data=[];
        $data['Statut']=[
            'Public',
            'Privé'];

        $data['Nb_groupe']=[
            '20',
            '50',
            '100'
        ];
        if($this->request->getMethod()== 'post'){ 
            { 
                //la règle de création du groupe
                $rules=[
                    "Nom_du_groupe"=>[
                        'rules'=>'required|min_length[5]|max_length[30]|is_unique[Groupe.nom_gr]',
                        'label'=>'Nom du groupe',
                        'errors'=>[
                        'is_unique'=>"Le nom est existe. Veuillez choisir un autre",
                        'required'=>"Veuillez saisir le nom du groupe"],
                        ],

                    "Statut_du_groupe"=>[
                        'rules'=>'required',
                        'label'=>'Statut du groupe',
                        'errors'=>[
                            'required'=>"Veuillez choisir statut du groupe",
                        ],],

                    "Nombre_de_membre"=>[
                        'rules'=>'required|in_list[20,50,100]',
                        'label'=>'Nombre de membre du groupe',
                        'errors'=>[
                            'required'=>"Veuillez choisir le nombre de membre du groupe",
                        ],]
                ];
                

                if($this->validate($rules)){ //La règle valide
                    $this->saugarder();
                    echo "Sucess";
                    $gr= new GroupeModel();
                    $id_g=$gr->select('id_gr')->where('nom_gr',$this->request->getPost('Nom_du_groupe'))->first();
                    $id=$id_g['id_gr'];
                    return redirect()->to(base_url('/admin/'.$id));
    
                }
                else{//Affichage d'error
                    $data['validation']=$this->validator;
                    
                }
            
                //return redirect()->to(base_url('/publication'));
            }
        }
        return view("formulaire_groupe",$data,$data);
    
        }
    protected function saugarder() // sauvegarder des informations dans la BDD
    {
        $session = session();
        $gr= new GroupeModel();
        $id_a= $session->get('id');
        //$ss_data=$session->get('data');
        $data=[
            'nom_gr'=>$this->request->getPost('Nom_du_groupe'),
            'statut'=>$this->request->getPost('Statut_du_groupe'),
            'nb_membre'=>$this->request->getPost('Nombre_de_membre'),
            'id_admin'=>$id_a,
            
        ];
        $gr->save($data);
        $id_g=$gr->select('id_gr')->where('nom_gr',$data['nom_gr'])->first();
        $membre= new MembreGroupe();
        $new_data=[
            'id_groupe'=>$id_g['id_gr'],
            'id_user'=>$id_a,
            'Demande_adhesion'=>False,

        ];
        $membre->save($new_data);
        return $new_data;

        
    }

    public function rejoindreUnGroupe($id_gr){
            $data=[];
            $group_model = new GroupeModel();
            $group = $group_model->find($id_gr);// Vérifier si un groupe est existe
            $nb_max=$group['nb_membre'];
            if (!$group) {
                $data['alertMessage']="<script> alert('Le groupe n'est pas existe')</script>";
                return $data;
            }
            $session = session();
            $id_u = $session->get('id');
    
            $membre = new MembreGroupe();
            $resultat = $membre->where('id_groupe',$id_gr)->where('id_user',$id_u)->where('Demande_adhesion=0')->countAllResults();//requête pour vérifier un utilisateur est un membre d'un groupe
            $query=$membre->selectCount('id_user')->where('id_groupe',$id_gr)->where('Demande_adhesion=0');//requête pour consulter le nb de membre d'un groupe
            $nb_res=$query->countAllResults();
            //echo $nb_res;
            if($resultat){ // vérifier si l'uitilisateur est un membre d'un groupe
                $data['alertMessage']="Vous êtes un membre de groupe";
                return $data;
            }
            if($nb_res>=$nb_max){// verifier si la limite est dépasse
                $data['alertMessage']="La limite est depasse";
                return $data;
            }
            if($group['statut']!='Public'){
                if($this->request->getMethod()=='post'){
                    if ($membre->rejoindreGroupePrive($id_gr,$id_u)) {
                        $data['alertMessage']="Demande d'ahésion a été envoyé";
                        return $data;
                    } 
                    else {
                        $data['alertMessage']="Demande d'ahésion n'a pas été envoyé";
                        return $data;

                    }
                }
            }

            else{
                if($this->request->getMethod()=='post'){
                    if ($membre->rejoindreGroupePublic($id_gr,$id_u)) {
                        $data['alertMessage']="Vous avez rejoint groupe";
                        return $data;
                    } 

                    else {
                        $data['alertMessage']="Vous n'avez pas rejoint groupe)";
                        return $data;
                    }
                }

            }
            
        
        return $data;
        // return view('Groupe_page');
    }
    
    function ecrirePublication(){
        helper(['form']);
        if($this->request->getMethod()== 'post'){ 
            {
                $rules=[
                    "publication"=>[
                    'rules'=>'required|min_length[0]|max_length[300]',
                    'errors'=>[
                        'required'=>"Veillez écrire la publication avant de publier",
                        'max_length'=>"Votre publication dépasse la limite de 300 caractères"
                    ],
                ],
                ];
                }
            if ($this->validate($rules)){
                $id_gr=$this->request->getPost('id_gr');
                $session = session();
                $sv= new Publication_Model();
                $text=$this->request->getPost('publication');
                $data=[ 'text'=>$text,
                        'id_user'=>$session->get('id'),
                        'id_gr'=>$id_gr
                ];

                $n_data['id_gr']=$id_gr;
        
                $sv->save($data);
                return $n_data;
                //echo"Votre publication a été enregistrée avec succès.";
            }
            else{//Affichage d'error
                $id_gr=$this->request->getPost('id_gr');
                $data['id_gr']=$id_gr;
                $data['validation']=$this->validator;
                return $data;
            
                
            }

        }
       // return view('Groupe_page',$data);
    }
    function ecrireCommentaire(){
        helper(['form']);
        if($this->request->getMethod()== 'post'){ 
            {
                $rules=[
                    'commentaire'=>[
                    'rules'=>'required|min_length[0]|max_length[300]',
                    'errors'=>[
                        'required'=>"Veillez écrire la commentaire avant de publier",
                        'max_length'=>"Votre commentaire dépasse la limite de 300 caractères"
                    ],
                ],
                ];
                }
            if ($this->validate($rules)){
                $id_pub=$this->request->getPost('id_publication');
                $session = session();
                $cm= new Commentaire_Model();
                $text=$this->request->getPost('commentaire');
                $data=[ 'text'=>$text,
                        'id_user'=>$session->get('id'),
                        'id_pub'=>$id_pub
                ];

                $n_data['id_publication']=$id_pub;
        
                $cm->save($data);
                return $n_data;

            }
            else{//Affichage d'error
                $id_pub=$this->request->getPost('id_publication');
                $data['id_pub']=$id_pub;
                $data['validation']=$this->validator;
                return $data;
            
                
            }

        }
       // return view('Groupe_page',$data);
    }
    public function affichePublication($id_gr){
        $data=[];
        $publicationModel = new Publication_Model();
        //$publication = $publicationModel->find($id_gr);// Vérifier un groupe existe ou pas depuis la base de données
        $pub_utilisateur = $publicationModel->select('Utilisateur.nom_user, Publication.text, Publication.id_pub')
                                     ->join('Utilisateur', 'Utilisateur.id = Publication.id_user')
                                     ->where('Publication.id_gr', $id_gr)
                                     ->findAll();


        if($pub_utilisateur){
            foreach ($pub_utilisateur as &$pub) {
                $pub['commentaire']=$this->afficheCommentaire($pub['id_pub']);
            }
            $data['publication']=$pub_utilisateur;
            return $data;
        }
        else{
            $data['publication']=[];
            return $data;
        }


    }
    public function quitterGroupe(){
        //temporaire
        $data=[];
        $db = \Config\Database::connect();
        $id_gr=$this->request->getPost('id_gr');
        $buider=$db->table('Groupe');
        $id_admin=$buider->select('id_admin')->where('id_gr',$id_gr)->get('id_admin');
        if(session()->get('id') == $id_admin){
            $data['alertMessage']="Vous ne pouvez pas quitter car vous êtes admin";
            return $data;
        }
        $db->table('membre')->where('id_user', session()->get('id'))->where('id_groupe',$id_gr )->delete();
        return [];
    }
    public function afficheCommentaire($id_pub){

        $commentaireM= new Commentaire_Model();
        $all_com=$commentaireM->select('Utilisateur.nom_user, commentaire.text')
                            ->join('Utilisateur','Utilisateur.id = commentaire.id_user')
                            ->where('commentaire.id_pub',$id_pub)
                            ->findAll();
        if($all_com){
            return $all_com;

        }
        else{
            return [];
        }

    }
    public function displaygroup($id_gr){// Fonction pour afficher la page d'un groupe

        $group_model = new GroupeModel();
        $group = $group_model->find($id_gr);// Vérifier un groupe est existe

        if (!$group) {//Si un groupe n'existe pas
            $data = [
                'group_id' => 'Ne pas trouvé',
                'group_name' => 'Ne pas trouvé',
                'group_status' => 'Ne pas trouvé',
                'group_max_mem' => 'Ne pas trouvé',
                'nb_mem'=>'Ne pas trouvé',
                'rejoindre_show' => 'hidden',
                'quitter_show'=> 'hidden',
                'contenu_show'=>"hidden",
                'alertMessage'=>"Le groupe n'est pas existe",
                'publication'=>[]
                
            ];
            return $data;
        }
        $id_admin=$group_model->select('id_admin')->where('id_gr',$id_gr)->first();
        $is_admin=$id_admin['id_admin'];
        // Ajouter des données pour afficher sur la page d'un groupe
        $data = [
            'group_id' => $id_gr,
            'group_name' => $group['nom_gr'],
            'group_status' => $group['statut'],
            'group_max_mem' => $group['nb_membre'],
            'alertMessage'=>""
        ];

        $session = session();
        $id_u = $session->get('id');
        $data += $this->affichePublication($id_gr);

        $member = new MembreGroupe();
        $res = $member->where('id_user',$id_u)->where('id_groupe',$id_gr)->where('id_user !=',$is_admin)->where('Demande_adhesion=0')->first();//requête pour vérifier un utilisateur est un membre d'un groupe
        $mem=$member->selectCount('id_user')->where('id_groupe',$id_gr)->where('Demande_adhesion=0')->countAllResults();//requête pour consulter le nb de membre d'un groupe
        if ($is_admin==$id_u){
            
            $data['rejoindre_show']='hidden';
            $data['quitter_show']='hidden';
            $data['contenu_show']="";
            $data['nb_mem']=$mem;
            return $data;
                
            }
        if ($res) {//Condition pour afficher ou pas le bottom rejoindre
            $data['rejoindre_show']='hidden';
            $data['quitter_show']='';
            $data['contenu_show']="";
            $data['nb_mem']=$mem;

            
        } 
        else {// Condition pour afficher le bottom quitter
            $data['rejoindre_show']='';
            $data['quitter_show']='hidden';
            $data['contenu_show']="hidden";
            $data['nb_mem']=$mem;
        }
        return $data;
    }
    public function voter($id_gr){
        $data=[];
        $db = \Config\Database::connect();
        $choix = $this->request->getVar('choix');
        $mem=new MembreGroupe();
        $res=$mem->where('id_user', session()->get('id'))->where('id_groupe',$id_gr)->where('vote=1')->findAll();
        //echo print_r($res);
        if($res){
            $data['alertMessage']="Vous avez voté";
            return $data;
        }
        if ($choix == "Oui") {
            $db->query('UPDATE Groupe SET nb_vote = nb_vote + 1 WHERE id_gr',$id_gr);
            $db->table('membre')->set('vote', True)->where("id_groupe",$id_gr)->where("id_user", session()->get('id'))->update();
            $data['alertMessage']="Vous avez voté avec succès";
            return $data;
        } elseif ($choix== 'Non') {
            $db->query('UPDATE Groupe SET nb_vote = nb_vote - 1 WHERE id_gr',$id_gr );
            $db->table('membre')->set('vote', True)->where("id_groupe",$id_gr)->where("id_user", session()->get('id'))->update();
            $data['alertMessage']="Vous avez voté avec succès";
            return $data;
        }
        //$db->table('membre')->set('vote', True)->where("id_groupe",$id_gr)->where("id_user", session()->get('id'))->update();
        $nb_vote=$db->table('Groupe')->select('nb_vote')->where('id_gr',$id_gr);
        
        $nb_membre=$db->table('membre')->selectCount('id_user')->where('id_groupe',$id_gr)->where('Demande_adhesion=0')->countAllResults();

        if($nb_vote>intdiv($nb_membre, 2)){
            $db->table('Groupe')->where('id_gr',$id_gr)->delete();
            $data['alertMessage']="Le groupe a été dissourd";
            return $data;

        }
    
        $db->table('membre')->set('vote', 'Vrai')->where("id_groupe", 1)->where("id", session()->get('id'))->update();
        return redirect()->to(base_url('groupe'));
    }
    function gestionUnGroupe($id_gr){
        $data=[];
        if ($this->request->getMethod()=='post') {
            $operation = $this->request->getPost('operation');
            switch ($operation) {
                case 'rejoint_gr':
                    $data+=$this->rejoindreUnGroupe($id_gr);
                    break;
                case 'ecrire_publication':
                    $data += $this->ecrirePublication();
                    break;
                case 'ecrire_commentaire':
                    $data +=$this->ecrireCommentaire();
                    break;
                case 'dissolve_gr':
                    $data +=$this->voter($id_gr);
                    break;
                case 'quitter_gr':
                    $data +=$this->quitterGroupe();
                    break;
            }
        }
        $data += $this->displaygroup($id_gr);
        return view('Groupe_page',$data);
    }

}
