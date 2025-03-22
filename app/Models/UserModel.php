<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users'; // Nom de la table
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'is_admin', 'is_active', 'avatar'];

    public function saveUser($data) {
        if ($this->insert($data)) {
            return true;
        } else {
            print_r($this->errors()); // Affiche les erreurs d'insertion
            return false;
        }
    }
    
    
}
