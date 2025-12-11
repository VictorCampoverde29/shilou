<?php

namespace App\Models;

use CodeIgniter\Model;

class SeccionAreasModel extends Model
{
    protected $table      = 'seccion_areas';
    protected $primaryKey = 'idarea';
    protected $allowedFields = ['idarea', 'idseccion', 'titulo', 'titulo_resaltado', 'detalle', 'telefono', 'url_media', 'estado', 'direccion'];

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
    public function getHead()
    {
        return $this->select('idarea, idseccion, titulo, titulo_resaltado, detalle, telefono, direccion')
            ->where('idseccion', 5) // HEAD
            ->first();
    }
    public function getServicios()
    {
        return $this->select('idarea, idseccion, titulo, titulo_resaltado, detalle')
            ->where('idseccion', 1) // SERVICIOS
            ->first();
    }
    public function getGaleria()
    {
        return $this->select('idarea, idseccion, titulo, titulo_resaltado, detalle')
            ->where('idseccion', 2) // GALERIA
            ->first();
    }
    public function getTestimonios()
    {
        return $this->select('idarea, idseccion, titulo, titulo_resaltado, detalle')
            ->where('idseccion', 3) // TESTIMONIOS
            ->first();
    }
    public function getContacto()
    {
        return $this->select('idarea, idseccion, titulo, detalle, telefono, direccion')
            ->where('idseccion', 4) // CONTACTO
            ->first();
    }
}
