<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;
use App\Models\SeccionAreaDetModel;

class TestimoniosController extends Controller
{
    public function index()
    {
        $servicios = new SeccionAreaDetModel();
        $data['servicios'] = $servicios->getServicios();
        return view('testimonios/index', $data);
    }
    public function obtenerAreas()
    {
        $seccionAreasModel = new SeccionAreasModel();
        $areas = $seccionAreasModel->getAreasBySeccion(3); // TESTIMONIOS
        return $this->response->setJSON($areas);
    }
    public function obtenerDetalles()
    {
        $seccionAreaDetModel = new SeccionAreaDetModel();
        $idarea = $this->request->getGet('idarea');
        $detalles = $seccionAreaDetModel->getDetallesByArea($idarea);
        return $this->response->setJSON($detalles);
    }
     public function update()
    {
        $model = new SeccionAreasModel();
        $idarea = $this->request->getPost('cod');
        $titulo = $this->request->getPost('titulo');
        $titulo_resaltado = $this->request->getPost('titulo_resaltado');
        $detalle = $this->request->getPost('detalle');

        if ($model->exists($titulo, $idarea)) {
            return $this->response->setJSON(['error' => 'El título ingresado ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'titulo_resaltado' => $titulo_resaltado,
            'detalle' => $detalle
        ];

        try {
            $model->update($idarea, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Testimonio actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el testimonio: ' . $e->getMessage()]);
        }
    }
    public function updateTestimonio()
    {
        $model = new SeccionAreaDetModel();
        $iddetalle = $this->request->getPost('iddetalle');
        $usuario = $this->request->getPost('usuario');
        $testimonio = $this->request->getPost('comentario');
        $estado = $this->request->getPost('estado');

        $data = [
            'usuario' => $usuario,
            'comentario' => $testimonio,
            'estado' => $estado,
        ];

        try {
            $model->update($iddetalle, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de servicio actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el detalle de servicio: ' . $e->getMessage()]);
        }
    }
    public function insertar()
    {
        $model = new SeccionAreaDetModel();
        $idarea = $this->request->getPost('idarea');
        $usuario = $this->request->getPost('usuario');
        $testimonio = $this->request->getPost('comentario');
        $servicio = $this->request->getPost('servicio');
        $estado = $this->request->getPost('estado');

        $data = [
            'idarea' => $idarea,
            'usuario' => $usuario,
            'comentario' => $testimonio,
            'servicio' => $servicio,
            'estado' => $estado
        ];
        try {
            $model->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de servicio registrado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al registrar el detalle de servicio: ' . $e->getMessage()]);
        }
    }
    public function delete()
    {
        $cod = $this->request->getPost('iddetalle');
        $modelo = new SeccionAreaDetModel();
        $resultado = $modelo->eliminar($cod);
        if ($resultado) {
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle eliminado correctamente.']);
        } else {
            return $this->response->setJSON(['error' => 'No se encontró el detalle o ya fue eliminado.']);
        }
    }
}