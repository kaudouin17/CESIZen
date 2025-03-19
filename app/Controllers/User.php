<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class User extends Controller
{
    public function toggleActive($id) {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
    
        if ($user) {
            $newStatus = $user['is_active'] ? 0 : 1; // Inverse l'état actuel
            $userModel->update($id, ['is_active' => $newStatus]);
            return redirect()->to('/admin/users')->with('success', 'Statut mis à jour');
        }
    
        return redirect()->to('/admin/users')->with('error', 'Utilisateur introuvable');
    }
    
}
