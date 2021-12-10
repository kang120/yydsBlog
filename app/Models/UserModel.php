<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'email', 'picture'];

    public function getUsers(){
        return $this->findAll();
    }
}