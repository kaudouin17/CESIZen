<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard extends Controller {
    public function index() {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté.');
        }

        return view('dashboard');
    }
}
