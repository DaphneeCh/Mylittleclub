<?php
namespace App\Models;
use CodeIgniter\Model;
class Publication_Model extends Model{
    protected $table ='Publication';
    protected $primaryKey = 'id_pub';
    protected $allowedFields =['text','id_user','id_gr'];
    protected $useAutoIncrement = true;
}
