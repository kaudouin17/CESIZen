<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Exercises extends Controller
{
    public function index()
    {
        return view('exercises');
    }

    public function terminer()
    {
        $duree = $this->request->getPost('duree'); // durée en secondes
        $type = $this->request->getPost('type'); // ex: "7-4-8", "5-5", "4-6"

        // Vérification simple
        if (!$duree || !$type || !is_numeric($duree)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Données manquantes ou invalides.'
            ]);
        }

        $db = \Config\Database::connect();

        $db->table('exercice_sessions')->insert([
            'user_id' => session()->get('user_id'),
            'duree_seconds' => (int) $duree,
            'type_exercice' => $type
        ]);

        return $this->response->setJSON(['success' => true]);
    }
}
