<?php

namespace App\Models;

use CodeIgniter\Model;

class SeccionAreasModel extends Model
{
    protected $table      = 'seccion_areas';
    protected $primaryKey = 'idarea';
    protected $allowedFields = ['idarea', 'idseccion', 'titulo', 'titulo_resaltado', 'detalle', 'tipo_area', 'url_media', 'estado'];

    public function getAreasBySeccion($idseccion)
    {
        return $this->where('idseccion', $idseccion)->findAll();
    }
    public function exists($titulo, $id = null)
    {
        $query = $this->where('titulo', $titulo);
        if ($id !== null) {
            $query->where('idarea !=', $id);
        }
        return $query->first() !== null;
    }
}
