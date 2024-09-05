<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Classe GroupeModel
 * Modèle pour interagir avec la table 'Groupe' dans la base de données.
 * Gère les opérations de base telles que la recherche et la mise à jour des informations de groupe.
 * @author ThiChau <pnhichau1701@gmail.com>
 */

class GroupeModel extends Model
{
    protected $table      = 'Groupe';
    protected $primaryKey = 'id_gr';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nom_gr', 'statut','nb_membre','id_admin','nb_vote','description','interet'];

    protected bool $allowEmptyInserts = false;

    /**
     * Recherche des groupes par nom en utilisant un terme de recherche.
     * Retourne tous les groupes dont le nom contient le terme spécifié.
     *
     * @param string $term Le terme de recherche pour filtrer les noms de groupe.
     * @return array Renvoie un tableau de groupes correspondant au terme de recherche ou un tableau vide si aucun terme n'est fourni.
     */
    public function chercheGroupe($term)
    {
        if (empty($term)) {
            return [];
        }
    
        return $this->like('nom_gr', $term, 'both')->findAll();
    }
}