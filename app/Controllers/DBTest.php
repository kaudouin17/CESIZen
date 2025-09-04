<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DbTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();

            if ($db->connID) {
                echo "✅ Connexion réussie à la base : " . $db->database . "<br>";

                // Test simple : afficher les tables
                $query = $db->query("SHOW TABLES");
                $results = $query->getResultArray();

                echo "<h3>Tables disponibles :</h3>";
                echo "<pre>";
                print_r($results);
                echo "</pre>";
            } else {
                echo "❌ Échec de la connexion";
            }
        } catch (\Throwable $e) {
            echo "❌ Erreur : " . $e->getMessage();
        }
    }
}
