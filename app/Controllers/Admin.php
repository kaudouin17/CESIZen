<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function users()
    {
        $userModel = new UserModel();

        // Récupérer les paramètres GET
        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');
        $status = $this->request->getGet('status');

        // Construire la requête avec les filtres
        $query = $userModel;

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        if ($role === 'admin') {
            $query = $query->where('is_admin', 1);
        } elseif ($role === 'user') {
            $query = $query->where('is_admin', 0);
        }

        if ($status === 'active') {
            $query = $query->where('is_active', 1);
        } elseif ($status === 'inactive') {
            $query = $query->where('is_active', 0);
        }

        $data['users'] = $query->findAll();
        $data['search'] = $search;
        $data['role'] = $role;
        $data['status'] = $status;

        return view('admin/users', $data);
    }


    public function toggleStatus($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $newStatus = $user['is_active'] ? 0 : 1;
            $userModel->update($id, ['is_active' => $newStatus]);
        }

        return redirect()->to('/admin/users');
    }

    public function editUser($id)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Utilisateur introuvable.');
        }

        return view('admin/edit_user', ['user' => $user]);
    }


    public function updateUser($id)
    {
        $userModel = new \App\Models\UserModel();

        // Récupération des données du formulaire
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0, // Vérifie si l'admin est coché
        ];

        // Si un mot de passe est fourni, on le met à jour
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Mise à jour dans la base de données
        $userModel->update($id, $data);

        return redirect()->to('/admin/users')->with('success', 'Utilisateur mis à jour avec succès.');
    }


    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/admin/users')->with('success', 'Utilisateur supprimé.');
    }

    public function filterUsers()
    {
        $userModel = new \App\Models\UserModel();

        $search = $this->request->getGet('search');
        $role = $this->request->getGet('role');
        $status = $this->request->getGet('status');

        $query = $userModel;

        if (!empty($search)) {
            $query = $query->like('username', $search)
                ->orLike('email', $search);
        }

        if ($role === 'admin') {
            $query = $query->where('is_admin', 1);
        } elseif ($role === 'user') {
            $query = $query->where('is_admin', 0);
        }

        if ($status === 'active') {
            $query = $query->where('is_active', 1);
        } elseif ($status === 'inactive') {
            $query = $query->where('is_active', 0);
        }

        $data['users'] = $query->findAll();

        return view('admin/users_table', $data); // Juste le tableau, pas toute la page
    }

    public function createUser()
    {
        return view('admin/create_user');
    }

    public function storeUser()
    {
        $userModel = new \App\Models\UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'is_admin' => $this->request->getPost('is_admin') ? 1 : 0,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $userModel->insert($data);
        return redirect()->to('/admin/users')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function informations()
    {
        $articleModel = new \App\Models\ArticleModel();

        $search = $this->request->getGet('search');

        if ($search) {
            $articles = $articleModel
                ->like('title', $search)
                ->orLike('summary', $search)
                ->findAll();
        } else {
            $articles = $articleModel->findAll();
        }

        return view('admin/informations', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    public function filterInformations()
    {
        $model = new \App\Models\ArticleModel();
        $search = $this->request->getGet('search');

        $articles = $model->like('title', $search)->findAll();

        return view('admin/informations_table', ['articles' => $articles]);
    }

    public function createArticle()
    {
        return view('admin/create_informations');
    }

    public function storeArticle()
    {
        $articleModel = new \App\Models\ArticleModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'summary' => $this->request->getPost('summary'),
            'content' => $this->request->getPost('content'),
            'image' => $this->request->getPost('image') // ou un champ d'upload plus tard
        ];

        $articleModel->insert($data);

        return redirect()->to('/admin/informations')->with('success', 'Article ajouté avec succès.');
    }

    public function editArticle($id)
    {
        $model = new \App\Models\ArticleModel();
        $article = $model->find($id);

        if (!$article) {
            return redirect()->to('/admin/informations')->with('error', 'Article introuvable.');
        }

        return view('admin/edit_informations', ['article' => $article]);
    }

    public function updateArticle($id)
    {
        $model = new \App\Models\ArticleModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'summary' => $this->request->getPost('summary'),
            'content' => $this->request->getPost('content'),
            'image' => $this->request->getPost('image'),
        ];

        $model->update($id, $data);
        return redirect()->to('/admin/informations')->with('success', 'Article mis à jour.');
    }

    public function deleteArticle($id)
    {
        $model = new \App\Models\ArticleModel();
        $article = $model->find($id);

        if (!$article) {
            return redirect()->to('/admin/informations')->with('error', 'Article introuvable.');
        }

        $model->delete($id);
        return redirect()->to('/admin/informations')->with('success', 'Article supprimé avec succès.');
    }
}
