<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Profile extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function edit()
    {
        $session = session();
        $userModel = new UserModel();
        $user = $userModel->find($session->get('user_id'));

        return view('profile_edit', ['user' => $user]);
    }

    public function update()
    {

        $session = session();
        $session->set('username', $this->request->getPost('username'));
        $session->set('user_email', $this->request->getPost('email'));
        $userModel = new UserModel();
        $userId = $session->get('user_id');
        $user = $userModel->find($userId);

        $validationRules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email'    => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
        ];

        // Vérifier si un mot de passe est fourni
        if ($this->request->getPost('password')) {
            $validationRules['password'] = 'required|min_length[6]';
            $validationRules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->to('/profile/edit')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Mise à jour des données
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);

        return redirect()->to('/profile?section=info')->with('success', 'Informations mises à jour.');
        session()->setFlashdata('success', 'Profil mis à jour avec succès !');
    }

    public function avatar()
    {
        $avatars = ['avatar1.png', 'avatar2.png', 'avatar3.png'];
        return view('profile/avatar', ['avatars' => $avatars]);
    }

    public function updateAvatar()
    {
        $avatar = $this->request->getPost('avatar');

        if (!$avatar || !file_exists(FCPATH . 'avatars/' . $avatar)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Avatar invalide.']);
        }

        $userModel = new \App\Models\UserModel();
        $userModel->update(session()->get('user_id'), ['avatar' => $avatar]);

        session()->set('avatar', $avatar);

        return redirect()->to('/profile')->with('success', 'Avatar mis à jour.');
        session()->setFlashdata('success', 'Avatar changé avec succès !');
    }
}
