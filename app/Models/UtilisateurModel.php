<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Classe UtilisateurModel
 * Modèle pour interagir avec la table 'Utilisateur' dans la base de données.
 * Gère les opérations de base telles que la mise à jour des utilisateurs.
 * @author Thi Chau <pnhichau1701@gmail.com>, Zineb Fennich <penpalzineb@gmail.com>, Jordan Crisosto <Jordanalaicrisosto@gmail.com>
 */
class UtilisateurModel extends Model
{
    protected $table = "Utilisateur";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nom_user', 'email', 'mdp','posts_count','last_post_at'];

    protected $beforeInsert =["beforeInsert"];
    protected $beforeUpdate =["beforeUpdate"];


    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    protected function passwordHash(array $data){
        if(isset($data['data']['mdp']))
    
            $data['data']['mdp']=password_hash($data['data']['mdp'], PASSWORD_DEFAULT);
        return $data;
    }
    protected function isAdmin($id_gr) {
        $db = \Config\Database::connect();
        $buidler = $db->table('groupe');
        $session=session();
        $id_user=$session->get('id');
        $id_admin = $buidler->select('id_admin')
                        ->where('id_gr',$id_gr)
                        ->get();

        return $id_admin == $id_user;

    }
    public function chercheUtilisateur($mot){
        if  (empty($mot)){
            return [];
        }
        return $this->like('nom_user',$mot,'both')->findAll();
    }

}