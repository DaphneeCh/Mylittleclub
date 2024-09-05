<?php
namespace App\Controllers;
use App\Models\Publication_Model;
class publication extends BaseController{
    public function index()
    {
        //helper(['form']);
        if($this->request->getMethod()== 'post'){ 
            {
                $data=[];
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
            if (($this->validate($rules)&&($this->request->getPost('publier')=='sucess'))){
                $id_gr=$this->request->getPost('id_groupe');
                $this->sauvegarder();
                echo"Votre publication a été enregistrée avec succès.";
            }
            else{//Affichage d'error
                $id_gr=$this->request->getPost('id_groupe');
                $data['id_gr']=$id_gr;
                $data['validation']=$this->validator;
                
            }

}
        return $data;
        //return view("Ecrire_Publication");
}
    protected function sauvegarder()
    {
        $session = session();
        $sv= new Publication_Model();
        
        $text=$this->request->getPost('publication');
        $id_gr=$this->request->getPost('id_groupe');
        $currentDateTime = date('Y-m-d H:i:s');
        $data=['text'=>$text,
            'id_user'=>$session->get('id'),
            'id_gr'=>$id_gr,
            'publie_at'=>$currentDateTime
    ];
        
        $sv->save($data);
    }
    
    public function afficher_publications($id_gr){
        $data=[];
        $publicationModel = new Publication_Model();
        $publication = $publicationModel->find($id_gr);// Récupérer une publication  depuis la base de données
        $nom_utilisateur = $publicationModel->select('Utilisateur.nom_user, Publication.text, Publication.publie_at')
                                     ->join('Utilisateur', 'Utilisateur.id = Publication.id_user')
                                     ->where('Publication.id_gr', $id_gr)
                                     ->findAll();

        echo print_r($nom_utilisateur);
        if($publication){
            $data['publication']=$nom_utilisateur;
            echo print_r($nom_utilisateur);
            
            return redirect()->to(site_url('/groupepage/'.$id_gr));
        }
        
    }
}