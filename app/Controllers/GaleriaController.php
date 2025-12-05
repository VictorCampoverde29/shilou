<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;
use App\Models\SeccionAreaDetModel;

class GaleriaController extends Controller
{
    public function index()
    {
        return view('galeria/index');
    }
    public function obtenerAreas()
    {
        $seccionAreasModel = new SeccionAreasModel();
        $areas = $seccionAreasModel->getAreasBySeccion(1); // SERVICIOS
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
            return $this->response->setJSON(['error' => 'La forma de pago ingresada ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'titulo_resaltado' => $titulo_resaltado,
            'detalle' => $detalle
        ];

        try {
            $model->update($idarea, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Servicio actualizada exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el servicio: ' . $e->getMessage()]);
        }
    }
    public function insertar()
    {
        $model = new SeccionAreaDetModel();
        $idarea = $this->request->getPost('idarea');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');
        $icono_svg = $this->request->getPost('icono_svg');
        $estado = $this->request->getPost('estado');

        $data = [
            'idarea' => $idarea,
            'titulo' => $titulo,
            'detalle' => $detalle,
            'icono_svg' => $icono_svg,
            'estado' => $estado
        ];
        try {
            $model->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de servicio registrado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al registrar el detalle de servicio: ' . $e->getMessage()]);
        }
    }
    public function updateDetalle()
    {
        $model = new SeccionAreaDetModel();
        $iddetalle = $this->request->getPost('iddetalle');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');
        $icono_svg = $this->request->getPost('icono_svg');

        $data = [
            'titulo' => $titulo,
            'detalle' => $detalle,
            'icono_svg' => $icono_svg,
        ];

        try {
            $model->update($iddetalle, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de servicio actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el detalle de servicio: ' . $e->getMessage()]);
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

    public function actualizarFotoDetalle()
    {
        $iddetalle = $this->request->getPost('iddetalle');
        $imagen = $this->request->getFile('imagen');

        if (!$iddetalle || !$imagen || !$imagen->isValid() || $imagen->hasMoved()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Datos inválidos']);
        }

        $nombreOriginal = $imagen->getName();
        $imagen->move(ROOTPATH . 'public/uploads/', $nombreOriginal);
        $ruta = 'public/uploads/' . $nombreOriginal;

        $model = new SeccionAreaDetModel();
        $data = [
            'url_foto' => $ruta,
            'comentario' => $nombreOriginal
        ];

        try {
            $model->update($iddetalle, $data);
            return $this->response->setJSON(['status' => 'ok', 'ruta' => $ruta, 'nombre_original' => $nombreOriginal]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
