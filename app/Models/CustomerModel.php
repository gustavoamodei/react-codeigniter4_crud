<?php namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
   protected $table      = 'customer';
   protected $primaryKey = 'id';

   protected $returnType = 'array';
   protected $useSoftDeletes = false;

   protected $allowedFields = [
     'name',
     'email',
     'phone',
     'address'
   ];

   protected $useTimestamps = true;
   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deleted_at    = 'deleted_at';
}