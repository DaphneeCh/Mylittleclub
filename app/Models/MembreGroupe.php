<?php

namespace App\Models;

use CodeIgniter\Model;

class  MembreGroupe extends Model
{
    protected $table      = 'membre';
    protected $allowedFields = ['id_groupe', 'id_user','Demande_adhesion'];
    

    // Fonction ajouter un utilisateur à un groupe public
    public function rejoindreGroupePublic($groupId, $userId) {
            $db = \Config\Database::connect();
            $builder = $db->table('membre');
            $data = [
                'id_user' => $userId,
                'id_groupe'=>$groupId,
                'Demande_adhesion'=>False, // False car pas besoin d'un acceptation d'un admin
        ];
            return $builder->insert($data);
        }

    // Fonction ajouter un utilisateur à un groupe privé

    public function rejoindreGroupePrive($groupId, $userId){
        $db = \Config\Database::connect();
        $builder = $db->table('membre');
        $data = [
            'id_user' => $userId,
            'id_groupe'=>$groupId,
            'Demande_adhesion'=>True, // True en attendant un acceptation d'un admin
    ];
        return $builder->insert($data);
    }
        
    }

