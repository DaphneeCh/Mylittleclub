<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = "utilisateur";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nom_user', 'email', 'mdp'];

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
}