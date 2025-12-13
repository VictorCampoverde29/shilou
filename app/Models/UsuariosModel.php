<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idusuario';
    protected $allowedFields = ['idusuario', 'nombre', 'clave', 'correo', 'perfil', 'estado'];

    public function getUser($usuario, $clave)
    {
        $user = $this->select('idusuario, nombre, clave, correo, perfil, estado')
                     ->where('estado', 'ACTIVO')
                     ->where('nombre', $usuario)
                     ->first();        
        if ($user) {
            $passwordCheck = password_verify($clave, $user['clave']);            
            if ($passwordCheck) {
                return $user;
            }
        }        
        return null;
    } 
    public function getCredenciales($usuario, $correo)
    {
        return $this->select('idusuario, nombre, correo, perfil, estado')
                    ->where('estado', 'ACTIVO')
                    ->where('nombre', $usuario)
                    ->where('correo', $correo)
                    ->first();
    }
    public function updatePassword($idusuario, $newPassword)
    {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($idusuario, ['clave' => $hashed]);
    }
    public function getUserData($usuario)
    {
        $user = $this->where('idusuario', $usuario)
                     ->where('estado', 'ACTIVO')
                     ->first();        
        return $user; 
    }
    public function getUsuarios()
    {
        return $this->select('idusuario, nombre, correo, perfil, estado')
                    ->findAll();
    }
    public function usuariosXcod($cod)
    {
        return $this->select('idusuario, nombre, correo, perfil, estado')
            ->where('idusuario', $cod)
            ->first();
    }
    public function exists($nombre, $id = null)
    {
        $query = $this->where('nombre', $nombre);
        if ($id !== null) {
            $query->where('idusuario !=', $id);
        }
        return $query->first() !== null;
    }
}

