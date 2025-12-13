<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('usuarios/index');
    }
    public function getAllUsers()
    {
        $model = new UsuariosModel();
        $data = $model->getAllUsers();
        return $this->response->setJSON(['data' => $data]);
    }
}