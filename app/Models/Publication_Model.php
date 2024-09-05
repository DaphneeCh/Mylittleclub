<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Classe Publication_Model
 * Modèle pour interagir avec la table 'Publication' dans la base de données.
 * Gère les opérations de base telles que la mise à jour des publications.
 * @author Dorra Charkour <dora.charkour@gmail.com>
 */
class Publication_Model extends Model{
    protected $table ='Publication';
    protected $primaryKey = 'id_pub';
    protected $allowedFields =['text','id_user','id_gr','publie_at','signaler'];
    protected $useAutoIncrement = true;

    public function signaler($id_pub){
        $builder = $this->db->table('Publication'); 

        $data = ['signaler' => 'signaler + 1']; 

        $builder->where('id_pub', $id_pub); 
        $builder->update($data);

    }
}
