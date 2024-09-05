<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Classe MembreGroupe
 * Modèle pour interagir avec la table 'membre' dans la base de données.
 * Gère les opérations de base telles que rejoindre un group et la mise à jour des informations de membre.
 * @author Thi Chau <pnhichau@gmail.com>
 */
class  MembreGroupe extends Model
{
    protected $table      = 'membre';
    protected $allowedFields = ['id_groupe', 'id_user','Demande_adhesion'];
    

    /**
     * Permet à un utilisateur de rejoindre directement un groupe public.
     * Insère une nouvelle entrée dans la table 'membre' indiquant que l'utilisateur a rejoint le groupe sans nécessiter d'approbation.
     *
     * @param int $groupId Identifiant du groupe que l'utilisateur souhaite rejoindre.
     * @param int $userId Identifiant de l'utilisateur.
     * @return bool Renvoie true si l'insertion est réussie, false sinon.
     */
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

    /**
     * Ajoute une demande pour qu'un utilisateur rejoigne un groupe privé.
     * Insère une nouvelle entrée dans la table 'membre' avec une demande d'adhésion en attente d'approbation par l'administrateur du groupe.
     * @param int $groupId Identifiant du groupe que l'utilisateur souhaite rejoindre.
     * @param int $userId Identifiant de l'utilisateur.
     * @return bool Renvoie true si l'insertion est réussie, false sinon.
     */
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

