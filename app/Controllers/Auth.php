<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Auth extends Controller {
    public function login() {
        return view('login');
        echo "Page de connexion OK"; // Test
        exit;
    }

    public function register() {
        return view('register');
    }

    public function processLogin() {
        $session = session();

        // Simuler un utilisateur existant
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($email === "test@cesizen.com" && $password === "123456") {
            $session->set([
                'user_email' => $email,
                'isLoggedIn' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Identifiants incorrects.');
        }
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}

