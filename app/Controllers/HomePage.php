



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
