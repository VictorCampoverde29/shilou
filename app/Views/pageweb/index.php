<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="38" height="38"><circle cx="19" cy="19" r="19" fill="%23c89b5a"/><text x="50%" y="54%" text-anchor="middle" dominant-baseline="middle" fill="white" font-size="22" font-family="Arial" font-weight="700">S</text></svg>'>
  <title>Shilou Estética Médica | Tratamientos Estéticos en Chiclayo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Centro de estética médica en Chiclayo. Botox, rinomodelación, aumento de glúteos, reducción de medidas y más. Agenda tu cita: +51 902 597 938">
  <meta name="keywords" content="estética médica, botox, rinomodelación, aumento glúteos, Chiclayo, tratamientos faciales">
  <link rel="stylesheet" href="<?= base_url('public/dist/css/styles.css') ?>" />
</head>

<body>

  <!-- NAVBAR -->
  <header class="nav">
    <div class="container nav-inner">
      <a href="<?= base_url('dashboard') ?>" class="logo">
        <div class="logo-icon">S</div>
        <span class="logo-text">SHILOU</span>
        <span class="logo-sub">Estética Médica</span>
      </a>

      <nav class="nav-links">
        <a href="#servicios">Servicios</a>
        <a href="#galeria">Galería</a>
        <a href="#testimonios">Testimonios</a>
        <a href="#contacto">Contacto</a>
      </nav>

      <a href="tel:+51902597938" class="btn btn-primary btn-small">
        Reservar Cita
      </a>
    </div>
  </header>

  <!-- HERO -->
  <section id="inicio" class="hero">
    <div class="container hero-grid">
      <div class="hero-text">
        <h1>
          <?= esc($head['titulo']) ?> <span class="text-gold italic"><?= esc($head['titulo_resaltado']) ?></span><br>
          Natural
        </h1>
        <p class="hero-subtitle">
          <?= esc($head['detalle']) ?>
        </p>

        <div class="hero-actions">
          <a href="tel:+51902597938" class="btn btn-primary">
            Agenda tu Cita
          </a>
          <a href="#servicios" class="btn btn-outline">
            Ver Servicios
          </a>
        </div>

        <div class="hero-contact">
          <a href="tel:+51902597938" class="hero-link">
            📞 <span><?= esc($head['telefono']) ?></span>
          </a>
          <div class="hero-link">
            📍 <span><?= esc($head['direccion']) ?></span>
          </div>
        </div>
      </div>

      <div class="hero-card">
        <div class="hero-logo-circle">SH</div>
        <div class="hero-card-text">
          <p class="hero-card-title"><?= esc($headdetalle['titulo']) ?></p>
          <p class="hero-card-body">
            <?= esc($headdetalle['detalle']) ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICIOS -->
  <section id="servicios" class="section section-alt">
    <div class="container">
      <div class="section-header center">
        <span class="section-tag">Nuestros Tratamientos</span>
        <h2><?= esc($servicio['titulo']) ?> <span class="text-gold italic"><?= esc($servicio['titulo_resaltado']) ?></span></h2>
        <p>
          <?= esc($servicio['detalle']) ?>
        </p>
      </div>

      <div class="services-carousel-row">
        <button id="servicesPrev" class="services-arrow">&#8592;</button>
        <div class="cards-grid" id="servicesGrid">
          <?php foreach ($serviciosdetalles as $servicios): ?>
            <article class="card">
              <h3>
                <?php if (!empty($servicios['icono_svg'])): ?>
                  <span class="card-icon" style="vertical-align:middle; margin-right:6px;"><?= $servicios['icono_svg'] ?></span>
                <?php endif; ?>
                <?= esc($servicios['titulo']) ?>
              </h3>
              <p><?= esc($servicios['detalle']) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
        <button id="servicesNext" class="services-arrow">&#8594;</button>
      </div>

    </div>
  </section>

  <!-- GALERÍA -->
  <section id="galeria" class="section">
    <div class="container">
      <div class="section-header center">
        <span class="section-tag">Galería</span>
        <h2><?= esc($galeria['titulo']) ?> <span class="text-gold italic"><?= esc($galeria['titulo_resaltado']) ?></span></h2>
        <p>
          <?= esc($galeria['detalle']) ?>
        </p>
      </div>

      <div class="gallery-wrapper" style="position:relative;">
        <div class="gallery-grid" id="galleryGrid">
          <?php foreach ($galeriadetalles as $item): ?>
            <figure class="gallery-item">
              <div class="gallery-thumb">
                <img src="<?= esc($item['url_foto']) ?>" alt="<?= esc($item['titulo']) ?>" loading="lazy" class="gallery-img-fixed">
              </div>
              <figcaption><?= esc($item['titulo']) ?></figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- TESTIMONIOS -->
  <section id="testimonios" class="section section-alt">
    <div class="container">
      <div class="section-header center">
        <span class="section-tag">Testimonios</span>
        <h2><?= esc($testimonios['titulo']) ?> <span class="text-gold italic"><?= esc($testimonios['titulo_resaltado']) ?></span></h2>
        <p>
          <?= esc($testimonios['detalle']) ?>
        </p>
      </div>

      <div class="testimonials-wrapper" style="position:relative;">
        <div class="testimonials-grid" id="testimonialsGrid">
          <?php foreach ($testimoniosdetalles as $testimonio): ?>
            <article class="testimonial">
              <p class="testimonial-text">
                "<?= esc($testimonio['comentario']) ?>"
              </p>
              <div class="testimonial-footer">
                <div class="avatar">
                  <?= strtoupper(substr($testimonio['usuario'], 0, 2)) ?>
                </div>
                <div>
                  <p class="testimonial-name"><?= esc($testimonio['usuario']) ?></p>
                  <p class="testimonial-meta"><?= esc($testimonio['servicio']) ?></p>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACTO -->
  <section id="contacto" class="section">
    <div class="container contact-grid">
      <div>
        <div class="section-header">
          <span class="section-tag">Contacto</span>
          <h2><?= esc($contacto['titulo']) ?></h2>
          <p>
            <?= esc($contacto['detalle']) ?>
          </p>
        </div>

        <ul class="contact-list">
          <li><strong>Teléfono / WhatsApp:</strong> <a href="tel:+51902597938"><?= esc($contacto['telefono']) ?></a></li>
          <li><strong>Dirección:</strong> <?= esc($contacto['direccion']) ?></li>
        </ul>
      </div>

      <form class="contact-form">
        <div class="form-group">
          <label for="nombre">Nombre completo</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" />
        </div>
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="tel" id="telefono" name="telefono" placeholder="+51 ..." />
        </div>
        <div class="form-group">
          <label for="mensaje">Mensaje</label>
          <textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos qué tratamiento te interesa"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-full">
          Enviar consulta
        </button>
      </form>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container footer-inner">
      <p>© 2025 Shilou Estética Médica · Chiclayo, Perú</p>
      <div class="footer-links">
        <a href="#inicio">Inicio</a>
        <a href="#servicios">Servicios</a>
        <a href="#galeria">Galería</a>
        <a href="#contacto">Contacto</a>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const galleryGrid = document.getElementById('galleryGrid');
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
        const gap = 0.7 * 16; // 0.7rem en px
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

      window.addEventListener('resize', function() {
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
        item.addEventListener('click', function() {
          clearInterval(autoInterval);
          setTimeout(startAuto, 3000);
        });
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const testimonialsGrid = document.getElementById('testimonialsGrid');
      const testimonialItems = Array.from(testimonialsGrid.querySelectorAll('.testimonial'));
      const tVisible = 2;
      let tStart = 0;
      let tAutoInterval;

      function updateTestimonialsCarousel() {
        const itemWidth = testimonialItems[0].offsetWidth;
        const gap = 1.4 * 16; // 1.4rem en px
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
        tAutoInterval = setInterval(nextTestimonial, 4000); // 4 segundos
      }

      window.addEventListener('resize', updateTestimonialsCarousel);

      updateTestimonialsCarousel();
      startTestimonialsAuto();

      testimonialItems.forEach(item => {
        item.addEventListener('click', function() {
          clearInterval(tAutoInterval);
          setTimeout(startTestimonialsAuto, 4000);
        });
      });
    });
  </script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const serviciosData = <?= json_encode($serviciosdetalles) ?>;
    const servicesGrid = document.getElementById('servicesGrid');
    const sPrevBtn = document.getElementById('servicesPrev');
    const sNextBtn = document.getElementById('servicesNext');
    let sPage = 0;

    function getVisibleCount() {
      return window.innerWidth <= 960 ? 1 : 6;
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
    }

    sPrevBtn.addEventListener('click', function() {
      if (sPage > 0) {
        sPage--;
        renderServices();
      }
    });

    sNextBtn.addEventListener('click', function() {
      const sVisible = getVisibleCount();
      if ((sPage + 1) * sVisible < serviciosData.length) {
        sPage++;
        renderServices();
      }
    });

    window.addEventListener('resize', function() {
      sPage = 0; // Opcional: vuelve a la primera página al cambiar de tamaño
      renderServices();
    });

    renderServices();
  });
</script>
</body>

</html>