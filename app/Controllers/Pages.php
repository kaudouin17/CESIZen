<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function mentionsLegales()
    {
        return view('pages/mentions_legales');
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function aPropos()
    {
        return view('pages/a_propos');
    }
}

