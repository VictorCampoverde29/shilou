function loguear(token) {
    var clave = $('#txtpassword').val().trim();
    var usuario = $('#txtusuario').val();

    // Validaciones antes de enviar la petición
    if (usuario === '' || usuario === null) {
        Swal.fire({
            icon: "error",
            title: "INICIO DE SESIÓN",
            text: "Ingrese el nombre de usuario"
        });
        return;
    }
    if (clave === '') {
        Swal.fire({
            icon: "error",
            title: "INICIO DE SESIÓN",
            text: "Ingrese la contraseña"
        });
        return;
    }
    if (!token) {
        Swal.fire({
            icon: "error",
            title: "INICIO DE SESIÓN",
            text: "No se pudo validar el reCAPTCHA."
        });
        return;
    }

    var parametros = $.param({ clave: clave, usuario: usuario, recaptcha: token });
    const url = baseURL + 'login/login';

    $.ajax({
        type: "POST",
        url: url,
        data: parametros,
        dataType: "json",
        success: function(response) {
            if (response.mensaje) {
                Swal.fire({
                    icon: "error",
                    title: "INICIO DE SESIÓN",
                    text: response.mensaje
                });
            } else {
                window.location.href = baseURL + 'dashboard';  // Redirige correctamente
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: "error",
                title: "ERROR EN LA PETICIÓN",
                text: "Ocurrió un problema al intentar iniciar sesión. Inténtelo de nuevo.",
                footer: "Detalles: " + textStatus + " - " + errorThrown
            });
        }
    });
}

$('#txtusuario, #txtpassword').on('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        grecaptcha.execute();
    }
});

$('#openModal').on('click', function(e) {
    e.preventDefault();
    $('#modalrecuperarpsw').modal('show');
});

function onSubmit(token) {
    loguear(token);
}

$('#togglePassword').on('click', function() {
    const input = $('#txtpassword');
    const icon = $('#iconPassword');
    if (input.attr('type') === 'password') {
      input.attr('type', 'text');
      icon.removeClass('fa-eye-slash').addClass('fa-eye');
    } else {
      input.attr('type', 'password');
      icon.removeClass('fa-eye').addClass('fa-eye-slash');
    }
});

function enviarCredencialesCorreo() {
    var usuario = $('#txtUsername').val().trim();
    var correo = $('#txtEmail').val().trim();

    if (usuario === '') {
        Swal.fire({
            icon: "error",
            title: "Restablecer Contraseña",
            text: "Ingrese el nombre de usuario."
        });
        return;
    }
    if (correo === '') {
        Swal.fire({
            icon: "error",
            title: "Restablecer Contraseña",
            text: "Ingrese el correo electrónico."
        });
        return;
    }
    $.ajax({
        type: "POST",
        url: baseURL + "login/enviar_credenciales_correo",
        data: { usuario: usuario, correo: correo },
        dataType: "json",
        success: function(response) {
            Swal.fire({
                icon: response.success ? "success" : "error",
                title: "Restablecer Contraseña",
                text: response.mensaje
            }).then(function() {
                if (response.success) {
                    $('#modalrecuperarpsw').modal('hide');
                    $('#txtUsername').val('');
                    $('#txtEmail').val('');
                    $('#txtpassword').val('');
                }
            });
        },
        error: function() {
            Swal.fire({
                icon: "error",
                title: "ERROR",
                text: "No se pudo enviar la solicitud."
            });
        }
    });
}