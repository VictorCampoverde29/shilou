function mostrarServiciosGrid() {
  const grid = document.getElementById('servicesGrid');
  if (grid) grid.style.visibility = 'visible';
}

document.addEventListener('DOMContentLoaded', function () {
  const servicesGrid = document.getElementById('servicesGrid');
  const sPrevBtn = document.getElementById('servicesPrev');
  const sNextBtn = document.getElementById('servicesNext');
  let sPage = 0;
  const serviciosData = window.serviciosData || [];

  function getVisibleCount() {
    return window.innerWidth <= 960 ? 1 : 6;
  }

  function actualizarVisibilidadFlechas() {
    const sVisible = getVisibleCount();
    const hayMasPaginas = serviciosData.length > sVisible;
    sPrevBtn.style.display = hayMasPaginas ? '' : 'none';
    sNextBtn.style.display = hayMasPaginas ? '' : 'none';
  }

  function renderServices() {
    const sVisible = getVisibleCount();
    servicesGrid.innerHTML = '';
    const start = sPage * sVisible;
    const end = start + sVisible;
    const pageItems = serviciosData.slice(start, end);
    pageItems.forEach(servicio => {
      const card = document.createElement('article');
      card.className = 'card';
      card.innerHTML = `
				<h3>
					${servicio.icono_svg ? `<span class="card-icon" style="vertical-align:middle; margin-right:6px;">${servicio.icono_svg}</span>` : ''}
					${servicio.titulo}
				</h3>
				<p>${servicio.detalle}</p>
			`;
      servicesGrid.appendChild(card);
    });
    sPrevBtn.disabled = sPage === 0;
    sNextBtn.disabled = end >= serviciosData.length;
    mostrarServiciosGrid();
    actualizarVisibilidadFlechas();
  }

  sPrevBtn.addEventListener('click', function () {
    if (sPage > 0) {
      sPage--;
      renderServices();
    }
  });

  sNextBtn.addEventListener('click', function () {
    const sVisible = getVisibleCount();
    if ((sPage + 1) * sVisible < serviciosData.length) {
      sPage++;
      renderServices();
    }
  });

  window.addEventListener('resize', function () {
    sPage = 0;
    renderServices();
  });

  renderServices();
});
document.addEventListener('DOMContentLoaded', function () {
  const testimonialsGrid = document.getElementById('testimonialsGrid');
  if (!testimonialsGrid) return;
  const testimonialItems = Array.from(testimonialsGrid.querySelectorAll('.testimonial'));
  const tVisible = 2;
  let tStart = 0;
  let tAutoInterval;

  function updateTestimonialsCarousel() {
    const itemWidth = testimonialItems[0].offsetWidth;
    const gap = 1.4 * 16;
    testimonialsGrid.style.transform = `translateX(-${tStart * (itemWidth + gap)}px)`;
  }

  function nextTestimonial() {
    if (tStart + tVisible < testimonialItems.length) {
      tStart++;
    } else {
      tStart = 0;
    }
    updateTestimonialsCarousel();
  }

  function startTestimonialsAuto() {
    clearInterval(tAutoInterval);
    tAutoInterval = setInterval(nextTestimonial, 4000);
  }

  window.addEventListener('resize', updateTestimonialsCarousel);

  updateTestimonialsCarousel();
  startTestimonialsAuto();

  testimonialItems.forEach(item => {
    item.addEventListener('click', function () {
      clearInterval(tAutoInterval);
      setTimeout(startTestimonialsAuto, 4000);
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const galleryGrid = document.getElementById('galleryGrid');
  if (!galleryGrid) return;
  const galleryItems = Array.from(galleryGrid.querySelectorAll('.gallery-item'));
  let start = 0;
  let autoInterval;

  function getVisibleCount() {
    return window.innerWidth <= 960 ? 1 : 4;
  }

  function getAutoTime() {
    return window.innerWidth <= 960 ? 3000 : 1800;
  }

  function updateCarousel() {
    const visible = getVisibleCount();
    const itemWidth = galleryItems[0].offsetWidth;
    const gap = 0.7 * 16;
    galleryGrid.style.transform = `translateX(-${start * (itemWidth + gap)}px)`;
  }

  function nextSlide() {
    const visible = getVisibleCount();
    if (start + visible < galleryItems.length) {
      start++;
    } else {
      start = 0;
    }
    updateCarousel();
  }

  function startAuto() {
    clearInterval(autoInterval);
    autoInterval = setInterval(nextSlide, getAutoTime());
  }

  function resetAuto() {
    clearInterval(autoInterval);
    startAuto();
  }

  window.addEventListener('resize', function () {
    const visible = getVisibleCount();
    if (start > galleryItems.length - visible) {
      start = Math.max(0, galleryItems.length - visible);
    }
    updateCarousel();
    resetAuto();
  });

  updateCarousel();
  startAuto();

  galleryItems.forEach(item => {
    item.addEventListener('click', function () {
      clearInterval(autoInterval);
      setTimeout(startAuto, 3000);
    });
  });
});

function enviarConsulta() {
  let nombre = $('#txttunombre').val().trim();
  let numero = $('#txttutelefono').val().trim();
  let mensaje = $('#txttumensaje').val().trim();
  var $btn = $('.contact-form button[type="button"]');

  if (nombre === '') {
    Swal.fire('Campo requerido', 'El nombre es obligatorio.', 'warning');
    $('#txttunombre').focus();
    return;
  }
  if (numero === '') {
    Swal.fire('Campo requerido', 'El número es obligatorio.', 'warning');
    $('#txttutelefono').focus();
    return;
  }
  let numLimpio = numero.replace(/\s+/g, '');
  if (numLimpio.startsWith('+51')) {
    numLimpio = numLimpio.substring(3);
  } else if (numLimpio.startsWith('51')) {
    numLimpio = numLimpio.substring(2);
  }
  if (!/^\d+$/.test(numLimpio)) {
    Swal.fire('Número inválido', 'El número solo debe contener dígitos.', 'warning');
    $('#txttutelefono').focus();
    return;
  }
  if (numLimpio.length !== 9 || !numLimpio.startsWith('9')) {
    Swal.fire('Número inválido', 'Ingrese un número celular válido (9 dígitos, empieza con 9).', 'warning');
    $('#txttutelefono').focus();
    return;
  }
  if (mensaje === '') {
    Swal.fire('Campo requerido', 'El mensaje es obligatorio.', 'warning');
    $('#txttumensaje').focus();
    return;
  }

  $btn.prop('disabled', true).addClass('btn-disabled');
  Swal.fire({
    title: 'Enviando...',
    text: 'Por favor espera un momento.',
    allowOutsideClick: false,
    allowEscapeKey: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  grecaptcha.ready(function() {
    grecaptcha.execute(RECAPTCHA_SITE_KEY, {action: 'contact'}).then(function(token) {
      var parametros = {
        nombre: nombre,
        numero: numero,
        mensaje: mensaje,
        recaptcha_token: token
      };
      $.ajax({
        url: baseURL + 'enviar_correo',
        type: 'POST',
        data: parametros,
        success: function (response) {
          $btn.prop('disabled', false).removeClass('btn-disabled');
          Swal.close();
          if (response.success) {
            Swal.fire('Enviado', response.message, 'success');
            $('.contact-form')[0].reset();
          } else {
            Swal.fire('Error', response.error || 'No se pudo enviar la consulta.', 'error');
          }
        },
        error: function () {
          $btn.prop('disabled', false).removeClass('btn-disabled');
          Swal.close();
          Swal.fire('Error', 'No se pudo enviar la consulta.', 'error');
        }
      });
    });
  });
}