<?php
namespace App\Controllers;

use App\Models\Commentaire_Model;
use App\Models\MembreGroupe;
use App\Models\GroupeModel;
use App\Models\Publication_Model;
use App\Models\UtilisateurModel;

/**
 * Classe Groupe
 * Contrôleur pour gérer les fonctionnalités de groupe telles que la création, rejoindre un groupe et la gestion des membres.
 * @author Thi Chau <pnhichau1701@gmail.com>, Dorra Charkour <dora.charkour@gmail.com>
 */
class Groupe extends BaseController {

    /**
     * Gère le processus de création de groupe.
     * Valide les entrées de l'utilisateur, enregistre les nouveaux groupes et redirige après une création réussie.
     * @return mixed Retourne une vue avec les données, un message de succès ou des erreurs basées sur la validation des entrées.
     */
    public function creerGroupe()
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
        $data['Interet']=[
            'Lecture',
            'Cuisine',
            'Musique',
            'Art',
            'Cinéma',
            'Sport',
            'Voyage',
            'Photographie',
            'Jardinage',
            'Jeux vidéo',
            'Ecriture',
            'Technologie',
            'Mode',
            'Danse',
            'Astronomie',
            'Théâtre',
            'Histoire',
            'Astrologie',
            'Maquillage',
            'Collectionner',
            'Anime/Manga',
            'Autres'
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
                        ],],
                    "Description"=>[
                        'rules'=>'required|max_length[200]',
                        'label'=>'Discription du groupe',
                        'errors'=>[
                            'required'=>"Veuillez décrire le groupe",
                            'max_length'=>"Vous avez dépassé la limite de caractère"
                        ],],
                    "Centres_intérêt"=>[
                        'rules'=>'required',
                        'label'=>"Centres d'intérêt",
                        'errors'=>[
                            'required'=>"Veuillez choisir des centres d'intérêt",
                        ],],
                    ];
                

                if($this->validate($rules)){ //La règle valide
                    $this->saugarder();
                    $gr= new GroupeModel();
                    $id_g=$gr->select('id_gr')->where('nom_gr',$this->request->getPost('Nom_du_groupe'))->first();
                    $id=$id_g['id_gr'];
                    return redirect()->to(site_url('/admin/'.$id));
    
                }
                else{//Affichage d'error
                    $data['validation']=$this->validator;
                    
                }
            
                //return redirect()->to(site_url('/publication'));
            }
        }
        return view("formulaire_groupe",$data,$data);
    
        }
    /**
     * Sauvegarder les informations dans la base de données.
     * @return mixed Retourne un tableau de données pour afficher sur la page d'un groupe.
     */
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
            'description'=>$this->request->getPost('Description'),
            'interet'=>$this->request->getPost('Centres_intérêt'),
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
    /**
     * Gère le processus de rejoindre un groupe.
     * Vérifie si un groupe existe, si un utilisateur est déjà membre d'un groupe, si la limite de membre est dépassée et si un utilisateur peut rejoindre un groupe.
     * @return mixed Retourne un message d'alerte si un groupe n'existe pas, si un utilisateur est déjà membre d'un groupe, si la limite de membre est dépassée ou si un utilisateur a rejoint un groupe avec succès.
     */
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
                        $data['alertMessage']="Vous avez rejoint groupe avec succès";
                        return $data;
                    } 

                    else {
                        $data['alertMessage']="Vous ne pouvez pas rejoindre le groupe)";
                        return $data;
                    }
                }

            }
            
        
        return $data;
        // return view('Groupe_page');
    }
    /**
     * Gère le processus de création de publication.
     * Valide les entrées de l'utilisateur, enregistre les nouvelles publications et redirige après une création réussie.
     * @return mixed Retourne une vue avec les données, un message de succès ou des erreurs basées sur la validation des entrées.
     */
    function ecrirePublication(){
        helper(['form']);
        if($this->request->getMethod()== 'post'){ 
            {
                $rules=[
                    "publication"=>[
                    'rules'=>'required|min_length[0]|max_length[500]',
                    'errors'=>[
                        'required'=>"Veillez écrire la publication avant de publier",
                        'max_length'=>"Votre publication dépasse la limite de 500 caractères"
                    ],
                ],
                ];
                }
            if ($this->validate($rules)){
                $id_gr=$this->request->getPost('id_gr');
                $session = session();
                $id_user=$session->get('id');
                $model_u= new UtilisateurModel();
                $user=$model_u->find($id_user);
                $sv= new Publication_Model();
                $DateTime = date('Y-m-d');
                $fulldatetime=date('Y-m-d H:i:s');
                $last_post_at =strtotime($user['last_post_at']);
                $last_post_at=date('Y-m-d',$last_post_at);
                if ($last_post_at == $DateTime && $user['posts_count'] >= 6) { 
                    $data['alertMessage']="Vous avez dépasse la limite de post par jour";
                    return $data;
                }
                if ($last_post_at != $DateTime) {
                    $model_u->set('posts_count', '0', FALSE)->where('id', $id_user)->update();
                    $model_u->set('last_post_at',"'$fulldatetime'", FALSE)->where('id', $id_user)->update();
                }
                $text=$this->request->getPost('publication');
                $data=[ 'text'=>$text,
                        'id_user'=>$session->get('id'),
                        'id_gr'=>$id_gr,
                        'publie_at'=>$fulldatetime
                ];
                
                $n_data['id_gr']=$id_gr;
        
                $sv->save($data);
                $model_u->set('posts_count', 'posts_count + 1', FALSE)->where('id', $id_user)->update();
                $model_u->set('last_post_at',"'$fulldatetime'", FALSE)->where('id', $id_user)->update();

                return $n_data;
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
    /**
     * Gère le processus d'écriture de commentaire.
     * Valide les entrées de l'utilisateur, enregistre les nouveaux commentaires et redirige après une création réussie.
     * @return mixed Retourne un message de succès ou des erreurs basées sur la validation des entrées.
     */
    function ecrireCommentaire($id_pub){
        helper(['form']);
        if($this->request->getMethod()== 'post'){ 
            {
                $rules=[
                    'commentaire'=>[
                        'rules'=>'required|min_length[0]|max_length[500]',
                        'errors'=>[
                            'required'=>"Veillez écrire la commentaire avant de publier",
                            'max_length'=>"Votre commentaire dépasse la limite de 500 caractères"
                        ],
                    ],
                ];
            }
            if ($this->validate($rules)){
                $session = session();
                $cm= new Commentaire_Model();
                $text=$this->request->getJsonVar('commentaire');
                $currentDateTime = date('Y-m-d H:i:s');
                $data=[ 'text'=>$text,
                        'id_user'=>$session->get('id'),
                        'id_pub'=>$id_pub,
                        'publie_at'=>$currentDateTime
                ];
        
                $cm->save($data);
                return ['success' => true];
            }
            else{//Affichage d'error
                return ['success' => false,
                        'id_pub' => $id_pub  
                ];
                
            }

        }
    }
    /**
     * Supprimer un commentaire.
     * @param int $id_com L'identifiant du commentaire.
     * @return mixed Retourne un message d'alerte si un utilisateur n'est pas l'auteur du commentaire ou si un commentaire a été supprimé avec succès.
     */
    public function supprimerCommentaire($id_com,$id_pub){
        $session = session();
        $id_u = $session->get('id');
        $cm= new Commentaire_Model();
        $id_author=$cm->select('id_user')->where('id_com',$id_com)->first();
        if((!is_null($id_author))){
            if($id_u != $id_author['id_user']){
                return ['success' => false,
                        'id_pub'=>$id_pub,
                        'message'=>"Vous n'êtes pas l'auteur de ce commentaire"];
            }
            else{
                $cm->where('id_com',$id_com)->where('id_user',$id_u)->delete();
                return ['success' => true,
                        'id_pub'=>$id_pub,
                        'message'=>"Le commentaire a été supprimé"];
            }
        }
        else{
            return ['success' => false,
                    'id_pub'=>$id_com,
                    'message'=>"Le commentaire n'existe pas"];
        }
    }
    /**
     * Signaler une publication.
     * @param int $id_pub L'identifiant de la publication.
     * @return mixed Retourne un message d'alerte si une publication a été signalée avec succès.
     */
    public function signalerPublication($id_pub){
        $pub= new Publication_Model();
        $pub->signaler($id_pub);
        $count_signaler=$pub->select('signaler')->where('id_pub',$id_pub)->countAllResults();
        if($count_signaler>=10){
            $pub->where('id_pub',$id_pub)->delete();
            return ['success' => true,
                    'message'=>"La publication a été supprimée"];
        }
        return ['success' => true,
                'message'=>"La publication a été signalée"];
    }
    /**
     * Affiche les publications d'un groupe.
     * @param int $id_gr L'identifiant du groupe.
     * @return mixed Retourne un tableau de publications ou un message d'erreur.
     */
    public function affichePublication($id_gr){
        $data=[];
        $publicationModel = new Publication_Model();
        //$publication = $publicationModel->find($id_gr);// Vérifier un groupe existe ou pas depuis la base de données
        //Récupérer les publications d'un groupe
        $pub_utilisateur = $publicationModel->select('Utilisateur.nom_user,Utilisateur.id, Publication.text, Publication.id_pub, Publication.publie_at')
                                     ->join('Utilisateur', 'Utilisateur.id = Publication.id_user')
                                     ->where('Publication.id_gr', $id_gr)
                                     ->orderBy('Publication.publie_at', 'DESC') 
                                     ->findAll();
        if($pub_utilisateur){//Si un groupe existe
            // foreach ($pub_utilisateur as &$pub) {
            //     $pub['commentaire']=$this->afficheCommentaire($pub['id_pub']);
            // }
    
            return ['success' => true,
                    'publication' => $pub_utilisateur];
            
        }
        else{
            return ['success' => false,
                    ];
        }


    }
    /**
     * Quitter un groupe.
     * @return mixed Retourne un message d'alerte si un utilisateur est un administrateur d'un groupe ou si un utilisateur a quitté un groupe avec succès.
     */
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
    /**
     * Affiche les commentaires d'une publication.
     * @param int $id_pub L'identifiant de la publication.
     * @return mixed Retourne un tableau de commentaires ou un message d'erreur.
     */
    public function afficheCommentaire($id_pub){

        $commentaireM= new Commentaire_Model();
        //Récupérer les commentaires d'une publication
        $all_com = $commentaireM->select('Utilisateur.nom_user, Utilisateur.id, commentaire.text, commentaire.publie_at, commentaire.id_com, commentaire.id_pub')
                        ->join('Utilisateur', 'Utilisateur.id = commentaire.id_user')
                        ->where('commentaire.id_pub', $id_pub)
                        ->orderBy('commentaire.publie_at', 'DESC') 
                        ->findAll();

    
        if($all_com){
            return ['success' => true,
                    'comments' => $all_com];
        }
        else{
            return ['succes'=>false,
                    'message'=>"Il n'y a pas de commentaires"];
        }

    }
    /**
     * Affiche la page d'un groupe.
     * Vérifie si un groupe existe, si un utilisateur est un membre d'un groupe et affiche les publications d'un groupe.
     * @param int $id_gr L'identifiant du groupe.
     * @return mixed Retourne un tableau de données pour afficher sur la page d'un groupe.
     */
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
                'description'=>"hidden",
                'interet'=>"hidden",
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
            'description'=>$group['description'],
            'interet'=>$group['interet'],
            'alertMessage'=>""
        ];

        $session = session();
        $id_u = $session->get('id');
        //$data += $this->affichePublication($id_gr);

        $member = new MembreGroupe();
        $res = $member->where('id_user',$id_u)->where('id_groupe',$id_gr)->where('id_user !=',$is_admin)->where('Demande_adhesion=0')->first();//requête pour vérifier un utilisateur est un membre d'un groupe
        $mem=$member->selectCount('id_user')->where('id_groupe',$id_gr)->where('Demande_adhesion=0')->countAllResults();//requête pour consulter le nb de membre d'un groupe
        if ($is_admin==$id_u){//Condition pour afficher ou pas le bottom rejoindre
            
            $data['rejoindre_show']='hidden';
            $data['quitter_show']='hidden';
            $data['contenu_show']="";
            $data['icon']="";
            $data['nb_mem']=$mem;
            return $data;
                
            }
        if ($res) {//Condition pour afficher ou pas le bottom rejoindre
            $data['rejoindre_show']='hidden';
            $data['quitter_show']='';
            $data['contenu_show']="";
            $data['icon']="hidden";
            $data['nb_mem']=$mem;

            
        } 
        else {// Condition pour afficher le bottom quitter
            $data['rejoindre_show']='';
            $data['quitter_show']='hidden';
            $data['contenu_show']="hidden";
            $data['icon']="hidden";
            $data['nb_mem']=$mem;
        }
        return $data;
    }
    /**
     * Supprimer une publication.
     * @param int $id_pub L'identifiant de la publication.
     * @param int $id_gr L'identifiant du groupe.
     * @return mixed Retourne un message d'alerte si un utilisateur n'est pas l'auteur de la publication ou si une publication a été supprimée avec succès.
     */
    public function supprimerPublication($id_pub,$id_gr){
        $session = session();
        $id_u = $session->get('id');
        $pub= new Publication_Model();
        $id_author=$pub->select('id_user')->where('id_pub',$id_pub)->first();
        if($id_u != $id_author['id_user']){
            //redirect()->to(site_url('groupegroup/'.$id_gr));
            return ['success' => false,
                    'message'=>"Vous n'êtes pas l'auteur de cette publication"];
        }
        else{
            $pub->where('id_pub',$id_pub)->where('id_user',$id_u)->delete();
            return ['success' => true,
                    'message'=>"La publication a été supprimée"];
        }
    }
    /**
     * Modifier une publication.
     * @param string $text Le texte de la publication.
     * @param int $id_pub L'identifiant de la publication.
     * @return mixed Retourne un message d'alerte si un utilisateur n'est pas l'auteur de la publication ou si une publication a été modifiée avec succès.
     */
    public function modifierPub($text,$id_pub){
        $session = session();
        $id_u = $session->get('id');
        $pub= new Publication_Model();
        $id_author=$pub->select('id_user')->where('id_pub',$id_pub)->first();
        if($id_u != $id_author['id_user']){
            return ['success' => false,
                    'message'=>"Vous n'êtes pas l'auteur de cette publication"];
        }
        else{
            $pub->set('text', $text)->where('id_pub',$id_pub)->where('id_user',$id_u)->update();
            return ['success' => true,
                    'message'=>"La publication a été modifiée"];
        }
    }
    /**
     * Voter pour dissoudre un groupe.
     * @param int $id_gr L'identifiant du groupe.
     * @return mixed Retourne un message d'alerte si un utilisateur a déjà voté pour dissoudre un groupe ou si un groupe a été dissous avec succès.
     */
    public function voter($id_gr){
        $data=[];
        $db = \Config\Database::connect();
        $choix = $this->request->getVar('choix');
        $mem=new MembreGroupe();
        //requete pour vérifier si un utilisateur a déjà voté pour dissoudre un groupe
        $res=$mem->where('id_user', session()->get('id'))->where('id_groupe',$id_gr)->where('vote=1')->findAll();
        //echo print_r($res);
        if($res){//Si un utilisateur a déjà voté pour dissoudre un groupe
            $data['alertMessage']="Vous avez déjà voté pour dissoudre ce groupe";
            return $data;
        }
        if ($choix == "Oui") {//Si un utilisateur a voté Oui pour dissoudre un groupe
            $db->query('UPDATE Groupe SET nb_vote = nb_vote + 1 WHERE id_gr',$id_gr);//requete pour incrémenter le nombre de vote
            $db->table('membre')->set('vote', True)->where("id_groupe",$id_gr)->where("id_user", session()->get('id'))->update();//requete pour mettre à jour le vote d'un utilisateur
            $data['alertMessage']="Vous avez voté avec succès";
            return $data;
        } elseif ($choix== 'Non') {//Si un utilisateur a voté Non pour dissoudre un groupe
            $db->query('UPDATE Groupe SET nb_vote = nb_vote - 1 WHERE id_gr',$id_gr );//requete pour décrémenter le nombre de vote
            $db->table('membre')->set('vote', True)->where("id_groupe",$id_gr)->where("id_user", session()->get('id'))->update();//requete pour mettre à jour le vote d'un utilisateur
            $data['alertMessage']="Vous avez voté avec succès";
            return $data;
        }
        //requete pour consulter le nombre de vote
        $nb_vote=$db->table('Groupe')->select('nb_vote')->where('id_gr',$id_gr);
        //requete pour consulter le nombre de membre
        $nb_membre=$db->table('membre')->selectCount('id_user')->where('id_groupe',$id_gr)->where('Demande_adhesion=0')->countAllResults();

        if($nb_vote>intdiv($nb_membre, 2)){//Si le nombre de vote est supérieur à la moitié du nombre de membre
            $db->table('Groupe')->where('id_gr',$id_gr)->delete();
            $data['alertMessage']="Le groupe a été dissourd";
            return $data;

        }
        //requete pour mettre à jour le vote d'un utilisateur
        $db->table('membre')->set('vote', 'Vrai')->where("id_groupe", 1)->where("id", session()->get('id'))->update();
        return redirect()->to(site_url('groupe'));
    }
    /**
     * Gère les fonctionnalités d'un groupe comme écrit une publication, écrit un commentaire,quitter un groupe, affiche les publications d'un groupe, affiche les commentaires d'une publication, supprime une publication, modifie une publication.
     * @param int $id_gr L'identifiant du groupe.
     * @return mixed Retourne un tableau de données pour afficher sur la page d'un groupe.
     */
    function gestionUnGroupe($id_gr){
        $data=[];
        if ($this->request->isAJAX()) {//Si la requête est AJAX
            $operation = $this->request->getJsonVar('operation');//Récupérer l'opération
            $id_pub = $this->request->getJsonVar('id_pub');//Récupérer l'identifiant de la publication
            switch ($operation) {//Vérifier l'opération
                case 'fetch_commentaire'://Si l'opération est fetch_commentaire
                    $data = $this->afficheCommentaire($id_pub);
                    return $this->response->setJSON($data);
                case 'ecrire_commentaire'://Si l'opération est ecrire_commentaire
                    $data =$this->ecrireCommentaire($id_pub);
                    return $this->response->setJSON($data);
                case 'supprimer_publication'://Si l'opération est supprimer_publication
                    $data = $this->supprimerPublication($id_pub,$id_gr);
                    return $this->response->setJSON($data);
                case 'affiche_publication'://Si l'opération est affiche_publication
                    $data = $this->affichePublication($id_gr);
                    return $this->response->setJSON($data);
                case 'modifier_publication'://Si l'opération est modifier_publication
                    $text=$this->request->getJsonVar('text');
                    $data = $this->modifierPub($text,$id_pub);
                    return $this->response->setJSON($data);
                case 'signaler_publication':
                    $data = $this->signalerPublication($id_pub);
                    return $this->response->setJSON($data);
                case 'supprimer_commentaire':
                    $id_com=$this->request->getJsonVar('id_com');
                    $data = $this->supprimerCommentaire($id_com,$id_pub);
                    return $this->response->setJSON($data);
            }
            return $this->response->setJSON([
                'alert'=>'Ne pas trouvé'
            ]);
        }
        if ($this->request->getMethod()=='post') {//Si la requête est POST
            $operation = $this->request->getPost('operation');//Récupérer l'opération
            switch ($operation) {// Vérifier l'opération
                case 'rejoint_gr'://Si l'opération est rejoint_gr
                    $data+=$this->rejoindreUnGroupe($id_gr);
                    break;
                case 'ecrire_publication'://Si l'opération est ecrire_publication
                    $data += $this->ecrirePublication();
                    break;
                case 'dissolve_gr'://Si l'opération est dissolve_gr
                    $data +=$this->voter($id_gr);
                    break;
                case 'quitter_gr'://Si l'opération est quitter_gr
                    $data +=$this->quitterGroupe();
                    break;
            }
            $data += $this->displaygroup($id_gr);
            return view('Groupe_page',$data);
        }
        $data += $this->displaygroup($id_gr);
        return view('Groupe_page',$data);
    }

}
