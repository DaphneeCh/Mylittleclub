<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * Classe Commentaire_Model
 * Modèle pour interagir avec la table 'commentaire' dans la base de données.
 * Gère les opérations de base telles que la mise à jour des commentaires.
 * @author Dorra Charkour <dora.charkour@gmail.com>
 */
class Commentaire_Model extends Model {
    protected $table = 'commentaire';
    protected $primaryKey = 'id_com';
    protected $allowedFields = ['id_user', 'id_pub','text','publie_at'];
    protected $useAutoIncrement = true;
}