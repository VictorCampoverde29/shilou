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
        $areas = $seccionAreasModel->getAreasBySeccion(2); // GALERIA
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
            return $this->response->setJSON(['error' => 'El nombre ingresado ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'titulo_resaltado' => $titulo_resaltado,
            'detalle' => $detalle
        ];

        try {
            $model->update($idarea, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Galería actualizada exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar la galería: ' . $e->getMessage()]);
        }
    }
    public function insertar()
    {
        $model = new SeccionAreaDetModel();
        $idarea = $this->request->getPost('idarea');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');
        $url_foto = $this->request->getPost('url_foto');
        $estado = $this->request->getPost('estado');

        // VALIDACION Y GUARDADO DE IMAGEN
        if (strpos($url_foto, 'data:image') === 0) {
            preg_match('/^data:image\/(\w+);base64,/', $url_foto, $matches);
            $extension = isset($matches[1]) ? $matches[1] : 'png';

            $nombreSinExt = pathinfo($detalle, PATHINFO_FILENAME);
            $nombreArchivo = $nombreSinExt . '.' . $extension;
            $ruta = FCPATH . 'public/uploads/' . $nombreArchivo;

            if (file_exists($ruta)) {
                return $this->response->setJSON(['error' => 'Ya existe una imagen con ese nombre en la galería.']);
            }

            // GUARDAR IMAGEN
            $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $url_foto);
            $data = base64_decode($base64);
            file_put_contents($ruta, $data);

            $url_foto = 'public/uploads/' . $nombreArchivo;
            $detalle = $nombreArchivo;
        } elseif (strpos($url_foto, base_url()) === 0) {
            $url_foto = str_replace(base_url(), '', $url_foto);
        }
        $data = [
            'idarea' => $idarea,
            'titulo' => $titulo,
            'detalle' => $detalle,
            'url_foto' => $url_foto,
            'estado' => $estado
        ];
        try {
            $model->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Detalle de galería registrado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al registrar el detalle de galería: ' . $e->getMessage()]);
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
        $titulo = $this->request->getPost('titulo');

        // SI LA IMAGEN VIENE DEL EXPLORADOR
        if (strpos($imagen, 'data:image') === 0) {
            // EXTRAER EXTENSION
            preg_match('/^data:image\/(\w+);base64,/', $imagen, $matches);
            $extension = isset($matches[1]) ? $matches[1] : 'png';

            $nombreSinExt = pathinfo($nombre, PATHINFO_FILENAME);
            $nombreArchivo = $nombreSinExt . '.' . $extension;
            $ruta = FCPATH . 'public/uploads/' . $nombreArchivo;

            if (file_exists($ruta)) {
                return $this->response->setJSON(['error' => 'Ya existe una imagen con ese nombre en la galería.']);
            }

            // GUARDAR IMAGEN
            $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $imagen);
            $data = base64_decode($base64);
            file_put_contents($ruta, $data);

            $model->update($iddetalle, [
                'url_foto' => 'public/uploads/' . $nombreArchivo,
                'detalle' => $nombreArchivo,
                'titulo' => $titulo
            ]);
            return $this->response->setJSON(['success' => true, 'message' => 'Imagen subida y datos actualizados']);
        }
        // SI LA IMAGEN VIENE DE BASEURL, SOLO ACTUALIZAR LA BASE DE DATOS
        if (strpos($imagen, base_url()) === 0) {
            $model->update($iddetalle, [
                'url_foto' => str_replace(base_url(), '', $imagen),
                'detalle' => $nombre,
                'titulo' => $titulo
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
