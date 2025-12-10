<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto/index');
    }
    public function obtenerAreas()
    {
        $seccionAreasModel = new SeccionAreasModel();
        $areas = $seccionAreasModel->getAreasBySeccion(4); // CONTACTO
        return $this->response->setJSON($areas);
    }
    public function update()
    {
        $model = new SeccionAreasModel();
        $idarea = $this->request->getPost('cod');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');
        $direccion = $this->request->getPost('direccion');
        $telefono = $this->request->getPost('telefono');

        if ($model->exists($titulo, $idarea)) {
            return $this->response->setJSON(['error' => 'El título ingresado ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'detalle' => $detalle,
            'direccion' => $direccion,
            'telefono' => $telefono
        ];

        try {
            $model->update($idarea, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Contacto actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el contacto: ' . $e->getMessage()]);
        }
    }
}