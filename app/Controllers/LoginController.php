<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LoginController extends Controller
{
    public function index()
    {
        $session = session();
        if ($session->get('is_logged')) {
            return redirect()->to('/dashboard');
        }
        $data['version'] = env('VERSION');
        $data['recaptcha_site_key'] = env('RECAPTCHA_SITE_KEY');
        return view('login/index', $data);
    }

    public function salir()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function LogueoIngreso()
    {
        $clave = $this->request->getPost('clave');
        $usuario = strtoupper($this->request->getPost('usuario'));
        $recaptcha = $this->request->getPost('recaptcha');

        $secret = env('RECAPTCHA_SECRET_KEY');
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptcha);
        $responseData = json_decode($verifyResponse);

        if (!$responseData->success || $responseData->score < 0.5) {
            return $this->response->setJSON([
                'success' => false,
                'mensaje' => 'Verificación reCAPTCHA fallida. Intenta de nuevo.'
            ]);
        }

        try {
            $usuarioModel = new UsuariosModel();
            $userData = $usuarioModel->getUser($usuario, $clave);

            if ($userData) {
                session()->set([
                    'nombrepersonal' => $userData['nombre'],
                    'is_logged' => true
                ]);
                return $this->response->setJSON([
                    'success' => true
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'mensaje' => 'Usuario o Clave Incorrecto'
                ]);
            }
        } catch (\Exception $e) {
            return json_encode(['error' => ['text' => $e->getMessage()]]);
        }
    }

    public function EnviarCredencialesCorreo()
    {
        $userModel = new UsuariosModel();
        $payload = $this->request->getPost();
        $usuario = trim($payload['usuario'] ?? '');
        $correo = trim($payload['correo'] ?? '');

        $data = $userModel->getCredenciales($usuario, $correo);
        if (!$data) {
            return $this->response->setJSON(['success' => false, 'mensaje' => 'Usuario o correo no encontrado o no coinciden.']);
        } else {
            $newPassword = bin2hex(random_bytes(4));
            $userModel->updatePassword($data['idusuario'], $newPassword);
            try {
                $this->enviarCorreo($data, $newPassword, $correo);
                return $this->response->setJSON(['success' => true, 'mensaje' => 'Correo enviado exitosamente.']);
            } catch (\Exception $e) {
                return $this->response->setJSON(['success' => false, 'mensaje' => 'Error al enviar el correo: ' . $e->getMessage()]);
            }
        }
    }

    protected function enviarCorreo($datosUsuario, $newPassword, $correo)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mail.grupoasiu.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'electronico@grupoasiu.com';
            $mail->Password = 'canelita24.';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom('sistemas@grupoasiu.com', 'Sistemas Grupo Asiu');
            $mail->addAddress($correo, 'Usuario Grupo Asiu');
            $mail->addReplyTo('sistemas@grupoasiu.com', 'Sistemas Grupo Asiu');

            $mail->Subject = "CREDENCIALES DE ACCESO A SISTEMA SHILOU - " . date('Y-m-d H:i');

            $mensaje = "
            <link href='https://fonts.googleapis.com/css?family=Poppins&display=swap' rel='stylesheet'>
            <div style='font-family: Poppins, sans-serif; background-color: #f4f6f9; padding: 20px;'>
              <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px; margin:auto; background-color:#ffffff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.06);'>
                <tr>
                  <td style='background-color:#c89b5a; color:#ffffff; text-align:center; padding:16px 20px; border-top-left-radius:8px; border-top-right-radius:8px;'>
                    <h2 style='margin:0; font-size:20px; letter-spacing:0.3px;'>CREDENCIALES DE ACCESO - USUARIO</h2>
                  </td>
                </tr>               
                <tr>
                  <td style='padding:20px; font-size:14px; color:#333;'>
                    <p style='margin:0 0 10px 0;'>Se envia las credenciales de Acceso:</p>
                    <p style='margin:6px 0;'><strong>Nombre:</strong> " . htmlspecialchars($datosUsuario['nombre'] ?? '', ENT_QUOTES, 'UTF-8') . "</p>
                    <p style='margin:6px 0;'><strong>Password Temporal:</strong> " . htmlspecialchars($newPassword ?? '', ENT_QUOTES, 'UTF-8') . "</p>
                    <p style='margin:16px 0 0 0;'>Por favor, verificar esta información directamente en el sistema y proceder con el cambio.</p>
                  </td>
                </tr>
                <tr>
                  <td style='text-align:center; padding: 18px 20px 22px 20px;'>
                    <a href='" . base_url('login') . "' style='background-color:#1c7782; color:#ffffff; padding:10px 18px; border-radius:4px; text-decoration:none; display:inline-block; font-weight:600;'>Ir al sistema</a>
                  </td>
                </tr>
                <tr>
                  <td style='text-align:center; font-size: 12px; color: #999; padding: 0 20px 18px 20px;'>
                    <em>Este es un correo automático enviado desde el sistema.</em><br>
                    SHILOU © 2025 - Todos los derechos reservados
                  </td>
                </tr>
              </table>
            </div>
            ";

            $mail->isHTML(true);
            $mail->Body = $mensaje;
            $mail->AltBody = strip_tags(str_replace(['<br>', '<p>', '</p>'], "\n", $mensaje));

            $mail->send();
            return true;
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            throw new \RuntimeException('Error en PHPMailer: ' . $mail->ErrorInfo);
        }
    }
}
