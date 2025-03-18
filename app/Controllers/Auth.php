<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller 
{
    public function login() 
    {
        return view('login');
    }

    public function register() 
    {
        return view('register');
    }

    public function processLogin() {
        $session = session();
        $userModel = new \App\Models\UserModel();
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $user = $userModel->where('email', $email)->first();
    
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'user_email' => $user['email'],
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        }
    
        return redirect()->to('/login')->with('error', 'Identifiants incorrects.');
    }
    

    public function processRegister() {
        helper(['form']);
    
        // Validation des données
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Sauvegarde en BDD
        $userModel = new \App\Models\UserModel();
        $userModel->saveUser([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);
    
        return redirect()->to('/login')->with('success', 'Compte créé avec succès');
    }
    

    public function logout() 
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
