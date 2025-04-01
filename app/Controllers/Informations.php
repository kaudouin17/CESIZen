<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Informations extends BaseController
{
    public function index()
    {
        $articleModel = new \App\Models\ArticleModel();
        $articles = $articleModel->findAll();        

        return view('informations/index', ['articles' => $articles]);
    }

    public function show($id)
    {
        $model = new ArticleModel();
        $article = $model->find($id);

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article non trouvé");
        }

        return view('informations/show', ['article' => $article]);
    }
}
