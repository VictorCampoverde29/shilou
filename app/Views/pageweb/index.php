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
      <a href="<?= base_url('head/index') ?>" class="logo">
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

      <a href="#contacto" class="btn btn-primary btn-small">
        Reservar Cita
      </a>
    </div>
  </header>

  <!-- HERO -->
  <section id="inicio" class="hero">
    <div class="container hero-grid">
      <div class="hero-text">
        <?php
          $partesTitulo = explode('|', $head['titulo']);
          $tituloPrincipal = isset($partesTitulo[0]) ? trim($partesTitulo[0]) : '';
          $tituloSecundario = isset($partesTitulo[1]) ? trim($partesTitulo[1]) : '';
        ?>
        <h1>
          <?= esc($tituloPrincipal) ?> <span class="text-gold italic"><?= esc($head['titulo_resaltado']) ?></span><br>
          <?= esc($tituloSecundario) ?>
        </h1>
        <p class="hero-subtitle">
          <?= esc($head['detalle']) ?>
        </p>

        <div class="hero-actions">
          <a href="#contacto" class="btn btn-primary">
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

      <form class="contact-form" id="contactForm">
        <div class="form-group">
          <label for="txttunombre">Nombre completo</label>
          <input type="text" id="txttunombre" name="txttunombre" placeholder="Tu nombre" />
        </div>
        <div class="form-group">
          <label for="txttutelefono">Teléfono</label>
          <input type="tel" id="txttutelefono" name="txttutelefono" placeholder="+51 ..." />
        </div>
        <div class="form-group">
          <label for="txttumensaje">Mensaje</label>
          <textarea id="txttumensaje" name="txttumensaje" rows="4" placeholder="Cuéntanos qué tratamiento te interesa"></textarea>
        </div>
          <button type="button" class="btn btn-primary btn-full" onclick="enviarConsulta()">
            Enviar consulta
          </button>
          <input type="hidden" id="recaptcha_token" name="recaptcha_token" />
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

  <?php
    $telefonoWsp = preg_replace('/\D/', '', $contacto['telefono']);
    if (strpos($telefonoWsp, '51') !== 0) {
      $telefonoWsp = '51' . $telefonoWsp;
    }
  ?>
  <a href="https://wa.me/<?= $telefonoWsp ?>" target="_blank" id="wsp-float" aria-label="WhatsApp" rel="noopener">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="52" height="52" style="display:block;">
  </a>

<script>
  var baseURL = '<?= base_url(); ?>';
</script>

<script>
  window.serviciosData = <?= json_encode($serviciosdetalles) ?>;
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?= esc(env('RECAPTCHA_SITE_KEY')) ?>"></script>
<script>
  const RECAPTCHA_SITE_KEY = '<?= esc(env('RECAPTCHA_SITE_KEY')) ?>';
</script>
<script src="<?= base_url('public/dist/js/pages/shilou.js?v=' . env('VERSION')) ?>"></script>

</body>
</html>

