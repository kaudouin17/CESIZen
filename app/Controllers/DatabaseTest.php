<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DatabaseTest extends Controller
{
    public function testConnection()
    {
        try {
            $db = Database::connect();
            echo "✅ Connexion réussie à la base de données !";
        } catch (\Exception $e) {
            echo "❌ Erreur de connexion : " . $e->getMessage();
        }
    }
}
