<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Exercises extends Controller
{
    public function index()
    {
        return view('exercises');
    }
}
