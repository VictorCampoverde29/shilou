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
}
