<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    public function toggleActive($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $newStatus = $user['is_active'] ? 0 : 1; // Inverse l'état actuel
            $userModel->update($id, ['is_active' => $newStatus]);
            return redirect()->to('/admin/users')->with('success', 'Statut mis à jour');
        }

        return redirect()->to('/admin/users')->with('error', 'Utilisateur introuvable');
    }

    public function filter()
    {
        if ($this->request->isAJAX()) {
            $userModel = new \App\Models\UserModel();

            $search = $this->request->getGet('search');
            $role = $this->request->getGet('role');
            $status = $this->request->getGet('status');

            $query = $userModel->select('*');

            if (!empty($search)) {
                $query->groupStart()
                    ->like('username', $search)
                    ->orLike('email', $search)
                    ->groupEnd();
            }

            if ($role === 'admin') {
                $query->where('is_admin', 1);
            } elseif ($role === 'user') {
                $query->where('is_admin', 0);
            }

            if ($status === 'active') {
                $query->where('is_active', 1);
            } elseif ($status === 'inactive') {
                $query->where('is_active', 0);
            }

            $data['users'] = $query->findAll();

            return view('admin/users_table', $data); // Charge uniquement la vue du tableau
        }
    }
}
