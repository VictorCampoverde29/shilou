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

    public function updateGaleria()
    {
        $model = new SeccionAreaDetModel();
        $iddetalle = $this->request->getPost('iddetalle');
        $imagen = $this->request->getPost('imagen');
        $nombre = $this->request->getPost('nombre');

        // Si la imagen viene del explorador
        if (strpos($imagen, 'data:image') === 0) {
            // Extraer extensión
            preg_match('/^data:image\/(\w+);base64,/', $imagen, $matches);
            $extension = isset($matches[1]) ? $matches[1] : 'png';

            $nombreSinExt = pathinfo($nombre, PATHINFO_FILENAME);
            $nombreArchivo = $nombreSinExt . '.' . $extension;
            $ruta = FCPATH . 'public/uploads/' . $nombreArchivo;

            // Verificar si ya existe
            if (file_exists($ruta)) {
                return $this->response->setJSON(['error' => 'Ya existe una imagen con ese nombre en la galería.']);
            }

            // Guardar imagen
            $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $imagen);
            $data = base64_decode($base64);
            file_put_contents($ruta, $data);

            $model->update($iddetalle, [
                'url_foto' => 'public/uploads/' . $nombreArchivo,
                'detalle' => $nombreArchivo
            ]);
            return $this->response->setJSON(['success' => true, 'message' => 'Imagen subida y datos actualizados']);
        }
        // Si la imagen viene de baseURL, solo actualizar la base de datos
        if (strpos($imagen, base_url()) === 0) {
            $model->update($iddetalle, [
                'url_foto' => str_replace(base_url(), '', $imagen),
                'detalle' => $nombre
            ]);
            return $this->response->setJSON(['success' => true, 'message' => 'Datos actualizados']);
        }

        return $this->response->setJSON(['error' => 'Formato de imagen no soportado']);
    }

    public function eliminarImagenLocal()
    {
        $nombre = $this->request->getPost('nombre');
        $ruta = FCPATH . 'public/uploads/' . $nombre;

        if (file_exists($ruta) && is_file($ruta)) {
            if (unlink($ruta)) {
                // Opcional: Actualizar la base de datos si tienes referencia
                $model = new SeccionAreaDetModel();
                $model->where('url_foto', 'public/uploads/' . $nombre)->set(['url_foto' => '', 'detalle' => ''])->update();

                return $this->response->setJSON(['success' => true, 'message' => 'Imagen eliminada correctamente']);
            } else {
                return $this->response->setJSON(['error' => 'No se pudo eliminar el archivo']);
            }
        } else {
            return $this->response->setJSON(['error' => 'Archivo no encontrado']);
        }
    }

    public function listarImagenesUploads()
    {
        $dir = FCPATH . 'public/uploads/';
        $imagenes = [];
        if (is_dir($dir)) {
            $archivos = scandir($dir);
            foreach ($archivos as $archivo) {
                if ($archivo === '.' || $archivo === '..') continue;
                $ruta = $dir . $archivo;
                if (is_file($ruta) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $archivo)) {
                    $imagenes[] = [
                        'nombre' => $archivo,
                        'url' => base_url('public/uploads/' . $archivo)
                    ];
                }
            }
        }
        return $this->response->setJSON(['data' => $imagenes]);
    }
}
