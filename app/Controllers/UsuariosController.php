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
    public function getUsuarios()
    {
        $model = new UsuariosModel();
        $data = $model->getUsuarios();
        return $this->response->setJSON(['data' => $data]);
    }
    public function usuariosXcod()
    {
        $usuariosModel = new UsuariosModel();
        $cod = $this->request->getGet('cod');
        $data = $usuariosModel->usuariosXcod($cod);
        return $this->response->setJSON([$data]);
    }
    public function insertar()
    {
        $model = new UsuariosModel();
        $nombre = $this->request->getPost('nombre');
        $contra = $this->request->getPost('contra');
        $correo = $this->request->getPost('correo');
        $perfil = $this->request->getPost('perfil');
        $estado = $this->request->getPost('estado');

        if ($model->exists($nombre)) {
            return $this->response->setJSON(['error' => 'El usuario ingresado ya existe.']);
        }


        $hash = password_hash($contra, PASSWORD_DEFAULT);
        $data = [
            'nombre' => $nombre,
            'clave' => $hash,
            'correo' => $correo,
            'perfil' => $perfil,
            'estado' => $estado
        ];

        try {
            $model->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Usuario registrado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al registrar el usuario: ' . $e->getMessage()]);
        }
    }
    public function update()
    {
        $model = new UsuariosModel();
        $idusuario = $this->request->getPost('idusuario');
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $perfil = $this->request->getPost('perfil');
        $estado = $this->request->getPost('estado');

        if ($model->exists($nombre, $idusuario)) {
            return $this->response->setJSON(['error' => 'El usuario ingresado ya existe']);
        }

        $data = [
            'nombre' => $nombre,
            'correo' => $correo,
            'perfil' => $perfil,
            'estado' => $estado
        ];

        try {
            $model->update($idusuario, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Usuario actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el usuario: ' . $e->getMessage()]);
        }
    }
}