<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;
use App\Models\SeccionAreaDetModel;

class PageController extends Controller
{
    public function index()
    {
        //HEAD
        $head = new SeccionAreasModel();
        $headdetalle = new SeccionAreaDetModel();
        $data['head'] = $head->getHead();
        $data['headdetalle'] = $headdetalle->getDetalleHead();
        //SERVICIOS
        $servicios = new SeccionAreasModel();
        $serviciosdetalles = new SeccionAreaDetModel();
        $data['servicio'] = $servicios->getServicios();
        $data['serviciosdetalles'] = $serviciosdetalles->getDetalleServicios();
        // GALERIA
        $galeria = new SeccionAreasModel();
        $galeriadetalles = new SeccionAreaDetModel();
        $data['galeria'] = $galeria->getGaleria();
        $data['galeriadetalles'] = $galeriadetalles->getDetalleGaleria();
        // TESTIMONIOS
        $testimonios = new SeccionAreasModel();
        $testimoniosdetalles = new SeccionAreaDetModel();
        $data['testimonios'] = $testimonios->getTestimonios();
        $data['testimoniosdetalles'] = $testimoniosdetalles->getDetalleTestimonios();
        // CONTACTO
        $contacto = new SeccionAreasModel();
        $data['contacto'] = $contacto->getContacto();

        return view('pageweb/index', $data);
    }
}