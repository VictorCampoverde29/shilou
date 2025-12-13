<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SeccionAreasModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto/index');
    }
    public function obtenerAreas()
    {
        $seccionAreasModel = new SeccionAreasModel();
        $areas = $seccionAreasModel->getAreasBySeccion(4); // CONTACTO
        return $this->response->setJSON($areas);
    }
    public function update()
    {
        $model = new SeccionAreasModel();
        $idarea = $this->request->getPost('cod');
        $titulo = $this->request->getPost('titulo');
        $detalle = $this->request->getPost('detalle');
        $direccion = $this->request->getPost('direccion');
        $telefono = $this->request->getPost('telefono');

        if ($model->exists($titulo, $idarea)) {
            return $this->response->setJSON(['error' => 'El título ingresado ya existe']);
        }

        $data = [
            'titulo' => $titulo,
            'detalle' => $detalle,
            'direccion' => $direccion,
            'telefono' => $telefono
        ];

        try {
            $model->update($idarea, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Contacto actualizado exitosamente.']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Ocurrió un error al actualizar el contacto: ' . $e->getMessage()]);
        }
    }
    
    public function enviarCorreo()
    {
        $nombre = $this->request->getPost('nombre');
        $numero = $this->request->getPost('numero');
        $mensaje = $this->request->getPost('mensaje');
        $recaptchaToken = $this->request->getPost('recaptcha_token');

        // Validación básica
        if (empty(trim($nombre)) || empty(trim($numero)) || empty(trim($mensaje))) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Todos los campos son obligatorios.'
            ]);
        }
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteIp = $this->request->getIPAddress();
        $postData = http_build_query([
            'secret' => $recaptchaSecret,
            'response' => $recaptchaToken,
            'remoteip' => $remoteIp
        ]);
        $opts = ['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postData
        ]];
        $context = stream_context_create($opts);
        $recaptchaResponse = file_get_contents($recaptchaUrl, false, $context);
        $recaptchaData = json_decode($recaptchaResponse, true);


        if (empty($recaptchaData['success']) || (isset($recaptchaData['score']) && $recaptchaData['score'] < 0.5)) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'No se pudo validar el reCAPTCHA. Intenta nuevamente.'
            ]);
        }

        $mail = new PHPMailer(true);
        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.shilouestetica.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'contacto@shilouestetica.com';
            $mail->Password = 'shilou11122025';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->CharSet = 'UTF-8';
            $mail->setFrom('contacto@shilouestetica.com', 'Shilou');
            $mail->addAddress('contacto@shilouestetica.com', 'Shilou');

            $mail->isHTML(true);
            $mail->Subject = 'Nueva consulta desde la web';
            $mail->Body = '<div style="font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,sans-serif;max-width:480px;margin:0 auto;background:#f9f5f0;padding:24px 18px 18px 18px;border-radius:14px;border:1px solid #e5e7eb;box-shadow:0 6px 24px rgba(32,50,70,0.08);color:#1f2933;">
                <h2 style="color:#c89b5a;font-size:1.2rem;margin-bottom:18px;">Nueva consulta desde la web</h2>
                <table style="width:100%;font-size:1rem;margin-bottom:18px;">
                  <tr><td style="font-weight:600;padding:6px 0;width:110px;">Nombre:</td><td>' . htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') . '</td></tr>
                  <tr><td style="font-weight:600;padding:6px 0;">Teléfono:</td><td>' . htmlspecialchars($numero, ENT_QUOTES, 'UTF-8') . '</td></tr>
                </table>
                <div style="margin-bottom:8px;font-weight:600;">Mensaje:</div>
                <div style="background:#fff;border-radius:8px;padding:12px 14px;border:1px solid #e5e7eb;font-size:0.98rem;white-space:pre-line;">' . nl2br(htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8')) . '</div>
                <div style="margin-top:22px;font-size:0.93rem;color:#6b7280;">Consulta recibida el ' . date('d/m/Y H:i') . '.</div>
            </div>';

            $mail->send();
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Consulta enviada correctamente. Pronto nos comunicaremos contigo.'
            ]);
        } catch (Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'No se pudo enviar el correo. ' . $mail->ErrorInfo
            ]);
        }
    }
}
