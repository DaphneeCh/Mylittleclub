<?php
namespace App\Models;
use CodeIgniter\Model;
class Commentaire_Model extends Model {
    protected $table = 'commentaire';
    protected $primaryKey = 'id_cpm';
    protected $allowedFields = ['id_user', 'id_pub','text'];
    protected $useAutoIncrement = true;
}