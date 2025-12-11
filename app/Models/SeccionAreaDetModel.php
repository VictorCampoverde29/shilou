<?php
namespace App\Models;
use CodeIgniter\Model;

class SeccionAreaDetModel extends Model
{
    protected $table      = 'seccion_area_detalle';
    protected $primaryKey = 'iddetalle';
    protected $allowedFields = ['iddetalle', 'idarea', 'titulo', 'detalle', 'usuario', 'url_foto', 'estado', 'comentario', 'icono_svg', 'servicio'];

    public function getDetallesByArea($idarea)
    {
        return $this->where('idarea', $idarea)->findAll();
    }
    public function eliminar($cod)
    {
        $detalle = $this->find($cod);
        if (!$detalle) {
            return false;
        }
        return $this->where('iddetalle', $cod)->delete();
    }
    public function getServicios()
    {
        return $this->select('titulo, iddetalle')
            ->where('idarea', 1)
            ->findAll();
    }
    public function getDetalleHead()
    {
        return $this->select('iddetalle, idarea, titulo, detalle, icono_svg')
            ->where('idarea', 5) // HEAD
            ->first();
    }
    public function getDetalleServicios()
    {
        return $this->select('iddetalle, idarea, titulo, detalle, icono_svg')
            ->where('idarea', 1) // SERVICIOS
            ->findAll();
    }
    public function getDetalleGaleria()
    {
        return $this->select('iddetalle, idarea, titulo, detalle, url_foto')
            ->where('idarea', 2) // GALERIA
            ->findAll();
    }
    public function getDetalleTestimonios()
    {
        return $this->select('iddetalle, idarea, usuario, servicio, comentario')
            ->where('estado', 'ACTIVO')
            ->where('idarea', 3) // TESTIMONIOS
            ->findAll();
    }
}
