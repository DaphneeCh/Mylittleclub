<?php
namespace App\Controllers;

use App\Models\GroupeModel;
use App\Models\MembreGroupe;
use \App\Validation\UserRules;
use \App\Models\UtilisateurModel;

/**
 * Classe Utilisateur
 * Contrôleur pour gérer les fonctionnalités utilisateur telles que l'inscription, la connexion, la déconnexion et la recherche.
 * @author Thi Chau <pnhichau1701@gmail.com>, Zineb Fennich <penpalzineb@gmail.com>, Jordan Crisosto <Jordanalaicrisosto@gmail.com>
 */

class Utilisateur extends BaseController
{
    /**
     * Gère le processus d'inscription des utilisateurs.
     * Valide les entrées de l'utilisateur, enregistre les nouveaux utilisateurs et redirige après une inscription réussie.
     * @return mixed Retourne une vue avec les données, un message de succès ou des erreurs basées sur la validation des entrées.
     */

    public function inscrire()
    {
        $donnees=[];
        helper(['form']);
        $methode = $this->request->getMethod();
        if ($methode == "post") {
            $rules = [
                "nom"=>[
                    'rules' => "required|max_length[20]|min_length[3]",
                    'errors'=>[
                        'required'=>"Veuillez saisir le nom",],
                    ],

                "email"=> [
                        'rules'=> "required|valid_email|is_unique[Utilisateur.email]",
                        'errors'=>[
                            'required'=>"Veuillez saisir email",
                            'is_unique'=>"Email est existe. Veillez choisir un autre",],
                        ],

                "mdp"=> [
                    'rules'=>"required|min_length[8]",
                    'errors'=>[
                        'required'=>"Veuillez saisir mot de passe",
                    ],
                    ],
                "confirmerMdp"=> [
                    'rules'=>"required|matches[mdp]",
                    'errors'=>[
                        'required'=>"Veuillez confirmer mot de passe",
                        'matches'=>"Le mot de passe ne correspond pas"]
                    ],
            ];
            //$donnees['mdp'] = password_hash((string) $donnees['mdp'], PASSWORD_BCRYPT);
            if($this->validate($rules)){
                $utilisateur= new UtilisateurModel();

                $n_donnees = [
                    "nom_user"=>$this->request->getVar("nom"),
                    "email"=>$this->request->getVar("email"),
                    "mdp"=>$this->request->getVar("mdp")
                ];
                $utilisateur->save($n_donnees);
                $session = session();
                $session ->setFlashdata('success','Inscription avec Sucess');
                return redirect()->to(site_url('/connexion'));
            }
            
            else{//Affichage d'error
                $donnees['validation']=$this->validator;
                
            }
        }
            
        
        return view("inscription",$donnees,$donnees);
    }
        /**
     * Gère la connexion des utilisateurs.
     * Valide les identifiants des utilisateurs et configure la session de l'utilisateur si les identifiants sont valides, sinon retourne des erreurs.
     *
     * @return mixed Redirige vers Homepage si réussi ou affiche le formulaire de connexion avec des erreurs de validation.
     */
    public function connecter()
    {
        $data=[];
        helper(['form']);
       
        if ($this->request->getMethod()=='post'){
            $rules=[
                'email'=> 'required|min_length[6]|max_length[50]|valid_email',
                'mdp'=>'required|min_length[8]|max_length[255]|validateUser[email,mdp]',
            ];
            
            $errors = [
                'mdp' =>[
                    'required'=>'Veuillez remplir le champs Mot de passe',
                    'validateUser'=> 'Email ou Mot de passe est incorrect',
                ],
                'email'=>[
                    'required'=>'Veuillez remplir le champs email'
                ]
            ];
            if(! $this->validate($rules,$errors)){
                $data['validation']=$this->validator;
            }else{
                $model= new UtilisateurModel();
                $utilisateur= $model->where('email',$this->request->getVar('email'))->first();
                $this->setUserSession($utilisateur);
                
                return redirect()->to(site_url('/homepage'));
            }
        }
        //echo view('template/header', $data);
        return view('connexion',$data,$data);
       // echo view('template/footer');
    }
        /**
     * Configure les données de session pour un utilisateur connecté.
     *
     * @param array $utilisateur Tableau contenant les données de l'utilisateur.
     * @return bool Retourne vrai après avoir configuré les données de session avec succès.
     */
    private function setUserSession($utilisateur){
        $data=[
            'id'=>$utilisateur['id'],
            'nom'=>$utilisateur['nom_user'],
            'email'=>$utilisateur['email'],
            'isLoggedIn'=>true,
        ];
        session()->set($data);
        return true;
    }
    /**
     * Gère la recherche de groupes.
     * Recherche les groupes correspondant au terme de recherche et renvoie les résultats.
     *
     * @return mixed Retourne une vue avec les données des groupes correspondant au terme de recherche.
     */

    public function barreRecherche(){
        $searchTerm = $this->request->getPost('searchTerm');//Récupère le terme de recherche
        
        if (empty($searchTerm)) {//Si le terme de recherche est vide
            $data['groups'] = [];
            $data['users'] = [];
        } else {
            $groupModel = new GroupeModel();
            $groupSearch= $groupModel->chercheGroupe($searchTerm);
            $utilisateurModel = new UtilisateurModel();
            $utilisateurSearch = $utilisateurModel->chercheUtilisateur($searchTerm);
            //print_r($utilisateurSearch);
            if(!$groupSearch){
                $data['groups'] = [];
            }
            else{
                foreach ($groupSearch as $group) {
                    $data['groups'][] = [
                        'id_gr' => $group['id_gr'],
                        'nom_gr' => $group['nom_gr']
                    ];
                }
            }
            if(!$utilisateurSearch){
                $data['users'] = [];
            }
            else{
                foreach ($utilisateurSearch as $utilisateur) {
                    $data['users'][] = [
                        'id' => $utilisateur['id'],
                        'nom_user' => $utilisateur['nom_user']
                    ];
                }
        
            }
            //print_r($data['groups']);
            //print_r($data['users']);

    
        return view('search_results', $data);
    }
}
    /**
     * Affiche Homepage.
     * Affiche les groupes que l'utilisateur a rejoint et les groupes suggérés.
     *
     * @return mixed Retourne une vue avec les groupes que l'utilisateur a rejoint et les groupes suggérés.
     */

    public function afficheHomePage(){
        $data=[];
        $session=session();
        $id_user=$session->get('id');
        $log_in=$session->get('isLoggedIn');
        $gr_mem = new MembreGroupe();
        $gr=new GroupeModel();
        $nb_gr=$gr->selectMax('id_gr')->first();
        //echo print_r($nb_gr);
        $db = \Config\Database::connect();
        $builder = $db->table('membre');
        $subQuery = $builder->select('id_groupe')
                ->where('id_user', $id_user)
                ->getCompiledSelect();
       
        
        // Requête pour les groupes que l'utilisateur n'a pas rejoint
        $id_all = $gr->select('id_gr AS id_groupe, nom_gr')
            ->where("id_gr NOT IN ($subQuery)", NULL, FALSE) 
            ->findAll();
        $id_suggest = array();
        if(count($id_all) > 5){
            foreach( array_rand($id_all, 5) as $idall ) {
                $id_suggest[] = $id_all[$idall];
                }
        }else{
            $id_suggest = [];
        }
        //$all_gr=$gr->select('id_gr AS id_groupe, nom_gr')->findAll();
        //echo print_r($id_all);
        $id_max=$nb_gr['id_gr'];
        //Requête pour trouver tous les groupes que l'utilisateur a rejoint
        $gr_rejoint = $gr_mem->select('Groupe.id_gr AS id_groupe, Groupe.nom_gr')
                     ->join('Groupe', 'membre.id_groupe = Groupe.id_gr')
                     ->where('membre.Demande_adhesion = 0')
                     ->where('membre.id_user', $id_user)
                     ->findAll();
        //echo print_r($gr_rejoint);



        if($log_in){//Si l'utilisateur est connecté
            $data['liste_rejoint']=$gr_rejoint;
            $data['liste_suggest']=$id_suggest;
            return view('Home_page',$data);

        }
        else{//Si l'utilisateur n'est pas connecté
            echo 'IL FAUT CONNEXION';
            $data['liste_rejoint']=[];
            $data['liste_suggest']=[];
            return view('Home_page',$data);
        }

    }
    /**
     * Déconnecte l'utilisateur.
     * Détruit la session de l'utilisateur et redirige vers la page de connexion.
     *
     * @return mixed Redirige vers la page de connexion.
     */
    public function logout(){
        session()->destroy();
        return redirect()->to(site_url('/connexion'));
    }
}