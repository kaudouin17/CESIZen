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
        helper('url');

        if (!session()->get('user_id') || session()->get('is_admin') != 1) {
            redirect()->to('/')->send(); // redirection vers la page d’accueil
            exit;
        }
    }


    public function index()
    {
        $session = session();

        if (!$session->get('user_id') || $session->get('is_admin') != 1) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $articleModel = new \App\Models\ArticleModel();
        $db = \Config\Database::connect();

        $totalUsers = $userModel->countAll();
        $activeUsers = $userModel->where('is_active', 1)->countAllResults();
        $inactiveUsers = $totalUsers - $activeUsers;

        $totalExercisesToday = $db->table('exercice_sessions')
            ->where('DATE(date_session)', date('Y-m-d'))
            ->countAllResults();

        $lastArticle = $articleModel->orderBy('created_at', 'desc')->first();
        $lastArticleTitle = $lastArticle ? $lastArticle['title'] : 'Aucun article';

        // Préparer les données pour le graphique des types d'exos
        $exerciseQuery = $db->table('exercice_sessions')
            ->select('type_exercice, COUNT(*) as total')
            ->groupBy('type_exercice')
            ->get()
            ->getResultArray();

        // On sécurise les types 7-4-8, 5-5 et 4-6 même s'ils sont absents
        $exerciseTypes = ['7-4-8' => 0, '5-5' => 0, '4-6' => 0];
        foreach ($exerciseQuery as $row) {
            $exerciseTypes[$row['type_exercice']] = (int) $row['total'];
        }

        return view('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'totalExercisesToday' => $totalExercisesToday,
            'lastArticle' => $lastArticleTitle,
            'exerciseTypes' => $exerciseTypes, // ✅ bien envoyé à la vue
        ]);
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

    public function dashboard()
    {
        $session = session();

        if (!$session->get('user_id') || $session->get('is_admin') != 1) {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $articleModel = new \App\Models\ArticleModel();
        $db = \Config\Database::connect();

        $totalUsers = $userModel->countAll();
        $activeUsers = $userModel->where('is_active', 1)->countAllResults();
        $inactiveUsers = $totalUsers - $activeUsers;

        $totalExercisesToday = $db->table('exercice_sessions')
            ->where('DATE(date_session)', date('Y-m-d'))
            ->countAllResults();

        $lastArticle = $articleModel->orderBy('id', 'desc')->first();
        $lastArticleTitle = $lastArticle ? $lastArticle['title'] : 'Aucun article';

        // Graphique : type d'exercices
        $exerciseQuery = $db->table('exercice_sessions')
            ->select('type_exercice, COUNT(*) as total')
            ->groupBy('type_exercice')
            ->get();

        if (!$exerciseQuery) {
            log_message('error', 'Erreur SQL exercice_sessions : ' . print_r($db->error(), true));
            throw new \RuntimeException('Erreur SQL dans dashboard');
        }

        $result = $exerciseQuery->getResultArray();

        $exerciseTypes = ['7-4-8' => 0, '5-5' => 0, '4-6' => 0];
        foreach ($result as $row) {
            $exerciseTypes[$row['type_exercice']] = (int) $row['total'];
        }

        // Graphiques
        $exerciseCounts = array_values($exerciseTypes);
        $userStatusCounts = [
            'Actifs' => $activeUsers,
            'Inactifs' => $inactiveUsers
        ];

        return view('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'totalExercisesToday' => $totalExercisesToday,
            'lastArticle' => $lastArticleTitle,
            'exerciseTypes' => $exerciseTypes,
            'exerciseCounts' => $exerciseCounts,
            'userStatusCounts' => $userStatusCounts
        ]);
    }
}
