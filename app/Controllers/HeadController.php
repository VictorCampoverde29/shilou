<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;
use App\Models\SeccionAreaDetModel;

class HeadController extends Controller
{
    public function index()
    {
        return view('head/index');
    }
    public function obtenerAreas()
    {
        $seccionAreasModel = new SeccionAreasModel();
        $areas = $seccionAreasModel->getAreasBySeccion(5); // HEAD
        return $this->response->setJSON($areas);
    }
    public function update()
    {
        $model = new SeccionAreasModel();
        $idarea = $this->request->getPost('cod');
        $titulo = $this->request->getPost('titulo');
        $titulo_resaltado = $this->request->getPost('titulo_resaltado');
        $detalle = $this->request->getPost('detalle');
        $direccion = $this->request->getPost('direccion');
        $telefono = $this->request->getPost('telefono');

        if ($model->exists($titulo, $idarea)) {
            return $this->response->setJSON(['error' => 'El título ingresado ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'titulo_resaltado' => $titulo_resaltado,
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
    public function updateDetalle()
    {
        $model = new SeccionAreaDetModel();
        $iddetalle = $this->request->getPost('iddetalle');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');

        $data = [
            'titulo' => $titulo,
            'detalle' => $detalle
        ];

        try {
            $model->update($iddetalle, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de servicio actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el detalle de servicio: ' . $e->getMessage()]);
        }
    }
}