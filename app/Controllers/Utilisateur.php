<?php
namespace App\Controllers;

use App\Models\GroupeModel;
use App\Models\MembreGroupe;
use \App\Validation\UserRules;
use \App\Models\UtilisateurModel;

class Utilisateur extends BaseController
{
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
                        'rules'=> "required|valid_email|is_unique[utilisateur.email]",
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
                        'required'=>"Veuillez comfirmer mot de passe",
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
                return redirect()->to(base_url('/connexion'));
            }
            
            else{//Affichage d'error
                $donnees['validation']=$this->validator;
                
            }
        }
            
        
        return view("inscription",$donnees,$donnees);
    }
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
                    'required'=>'Veillez remplir le champs Mot de passe',
                    'validateUser'=> 'Email ou Mot de passe est incorrect',
                ],
                'email'=>[
                    'required'=>'Veillez remplir le champs email'
                ]
            ];
            if(! $this->validate($rules,$errors)){
                $data['validation']=$this->validator;
            }else{
                $model= new UtilisateurModel();
                $utilisateur= $model->where('email',$this->request->getVar('email'))->first();
                $this->setUserSession($utilisateur);
                
                return redirect()->to(base_url('/homepage'));
            }
        }
        //echo view('template/header', $data);
        return view('connexion',$data,$data);
       // echo view('template/footer');
    }
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

    public function barreRecherche(){
        $search=new GroupeModel();
        $inputName=$this->request->getPost('inputName');
        $id_gr=$search->select('id_gr')->where('nom_gr',$inputName)->first();
        echo print_r($id_gr);
        if($this->request->getMethod()=='post'){
            if((!empty($inputName))&&isset($id_gr)){
                //$name=$search->like(['nom_gr'.$inputName])->findAll();

                return redirect()->to(base_url('/groupepage/'.$id_gr['id_gr']));
            }
        }
        else{
            echo "Trouve pas";
        }
    }

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
        foreach( array_rand($id_all, 10) as $idall ) {
            $id_suggest[] = $id_all[$idall];
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



        if($log_in){
            $data['liste_rejoint']=$gr_rejoint;
            $data['liste_suggest']=$id_suggest;
            

        }
        else{
            echo 'IL FAUT CONNEXION';
            $data['liste_rejoint']=[];
            $data['liste_suggest']=[];
        }
        return view('Home_page',$data);

    }
    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('/connexion'));
    }
}