<?php
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idusuario';
    protected $allowedFields = ['idusuario', 'nombre', 'clave', 'correo'];

    public function getUser($usuario, $clave)
    {
        // Obtener el usuario desde la base de datos
        $user = $this->select('idusuario, nombre, clave, correo')
                     ->where('nombre', $usuario)
                     ->first();        
        // Verificar si el usuario fue encontrado
        if ($user) {
            $passwordCheck = password_verify($clave, $user['clave']);            
            if ($passwordCheck) {
                return $user; // La contraseña es correcta
            }
        }        
        return null; // Usuario desactivado o contraseña incorrecta
    } 
    public function getCredenciales($usuario, $correo)
    {
        // Busca el usuario por nombre y valida que el correo le pertenezca
        return $this->select('idusuario, nombre, correo')
                    ->where('nombre', $usuario)
                    ->where('correo', $correo)
                    ->first();
    }

    public function updatePassword($idusuario, $newPassword)
    {
        // Encripta la nueva contraseña antes de guardar
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($idusuario, ['clave' => $hashed]);
    }
}

