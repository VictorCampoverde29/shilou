<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="<?= base_url('public/dist/img/shilourec.png') ?>" type="image/png">
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
      <a href="#inicio" class="logo" style="display: flex; flex-direction: row; align-items: center; gap: 10px;">
        <img src="<?= base_url('public/dist/img/shilourec.png') ?>" alt="Shilou Estética Médica" style="height: 68px; width: auto; display: block; margin-left: 20px; margin-right: 90px;"/>
      </a>

      <nav class="nav-links">
        <a href="#inicio">Inicio</a>
        <a href="#mision">Mision</a>
        <a href="#objetivos">Objetivos</a>
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

  <!-- MISIÓN Y VISIÓN -->
  <section id="mision" class="section section-alt">
    <div class="container">
      <div class="mision-vision-grid">
        <div class="mision-vision-card">
          <div class="mv-icon">🎯</div>
          <h3>Misión</h3>
          <p>Brindar tratamientos de estética médica seguros, personalizados y basados en evidencia científica, que realcen la belleza natural y mejoren la confianza de nuestros pacientes, mediante tecnología de vanguardia, profesionales altamente calificados y una atención ética, humana y de excelencia.</p>
        </div>
        <div class="mision-vision-card">
          <div class="mv-icon">✨</div>
          <h3>Visión</h3>
          <p>Ser la estética médica premium líder, reconocida por ofrecer experiencias exclusivas, resultados sofisticados y naturales, y un estándar superior de excelencia médica, innovación tecnológica y atención personalizada, convirtiéndonos en un referente de prestigio y confianza.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- OBJETIVOS ESPECÍFICOS -->
  <section id="objetivos" class="section" style="background-color: var(--bg);">
    <div class="container">
      <div class="section-header center">
        <span class="section-tag">Nuestros Objetivos</span>
        <h2>Objetivos <span class="text-gold italic">Específicos</span></h2>
        <p>Comprometidos con la excelencia en cada aspecto de nuestro servicio</p>
      </div>

      <div class="objetivos-grid">
        <!-- Clínicos y de calidad -->
        <div class="objetivo-card">
          <div class="objetivo-number">1</div>
          <h4 class="objetivo-titulo">Clínicos y de Calidad</h4>
          <ul class="objetivo-lista">
            <li>Garantizar la seguridad del paciente mediante protocolos médicos estrictos y buenas prácticas clínicas.</li>
            <li>Lograr resultados estéticos naturales que respeten la armonía facial y corporal.</li>
            <li>Mantener estándares médicos superiores en todos los tratamientos.</li>
          </ul>
        </div>

        <!-- Experiencia del paciente -->
        <div class="objetivo-card">
          <div class="objetivo-number">2</div>
          <h4 class="objetivo-titulo">Experiencia del Paciente (Premium)</h4>
          <ul class="objetivo-lista">
            <li>Brindar una atención personalizada, confidencial y exclusiva en cada etapa del servicio.</li>
            <li>Crear una experiencia sensorial y de bienestar que supere las expectativas del paciente.</li>
            <li>Fomentar relaciones a largo plazo basadas en confianza y satisfacción.</li>
          </ul>
        </div>

        <!-- Innovación y tecnología -->
        <div class="objetivo-card">
          <div class="objetivo-number">3</div>
          <h4 class="objetivo-titulo">Innovación y Tecnología</h4>
          <ul class="objetivo-lista">
            <li>Incorporar tecnología de vanguardia y tratamientos mínimamente invasivos de última generación.</li>
            <li>Capacitar continuamente al equipo médico y estético en técnicas avanzadas.</li>
          </ul>
        </div>

        <!-- Posicionamiento y marca -->
        <div class="objetivo-card">
          <div class="objetivo-number">4</div>
          <h4 class="objetivo-titulo">Posicionamiento y Marca</h4>
          <ul class="objetivo-lista">
            <li>Consolidar una imagen de marca premium, elegante y diferenciada.</li>
            <li>Ser reconocidos por ética, profesionalismo y resultados de alto nivel.</li>
          </ul>
        </div>

        <!-- Crecimiento y sostenibilidad -->
        <div class="objetivo-card">
          <div class="objetivo-number">5</div>
          <h4 class="objetivo-titulo">Crecimiento y Sostenibilidad</h4>
          <ul class="objetivo-lista">
            <li>Alcanzar rentabilidad sostenida sin comprometer la calidad ni la exclusividad.</li>
            <li>Expandir servicios selectivamente manteniendo el estándar premium.</li>
          </ul>
        </div>

        <!-- Ética y responsabilidad -->
        <div class="objetivo-card">
          <div class="objetivo-number">6</div>
          <h4 class="objetivo-titulo">Ética y Responsabilidad</h4>
          <ul class="objetivo-lista">
            <li>Promover una estética médica responsable, honesta y centrada en el bienestar integral del paciente.</li>
            <li>Cumplir y superar las normativas sanitarias y éticas vigentes.</li>
          </ul>
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

  <!-- ARTISTAS QUE NOS RECOMIENDAN -->
  <section id="artistas" class="section section-alt">
    <div class="container">
      <div class="section-header center">
        <span class="section-tag">Recomendaciones VIP</span>
        <h2>Artistas que <span class="text-gold italic">nos Recomiendan</span></h2>
        <p>Conoce los saludos y recomendaciones de personalidades y artistas que confían en Shilou Estética Médica.</p>
      </div>
      <div class="videos-carousel-wrapper" style="position:relative;max-width:900px;margin:0 auto;">
        <!-- El contenedor de flechas móviles solo se crea por JS debajo del video -->
        <button id="videosPrev" class="gallery-arrow videos-arrow-mob" style="left:-60px;top:45%;background:#fff;color:var(--primary);border:2px solid var(--primary);"><span style="font-size:2rem;">&#8592;</span></button>
        <div class="videos-carousel-grid" id="videosCarouselGrid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;align-items:center;justify-content:center;">
          <div class="video-card"><video controls poster="<?= base_url('public/dist/videos/IMG_8004.JPG') ?>" style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_3250.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_3269.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_5674.MOV') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_7834.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_7935.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_7960.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
          <div class="video-card"><video controls style="width:100%;border-radius:16px;box-shadow:0 6px 16px rgba(15,23,42,0.07);background:#000;"><source src="<?= base_url('public/dist/videos/IMG_8018.MP4') ?>" type="video/mp4">Tu navegador no soporta el video.</video></div>
        </div>
        <button id="videosNext" class="gallery-arrow videos-arrow-mob" style="right:-60px;top:45%;background:#fff;color:var(--primary);border:2px solid var(--primary);"><span style="font-size:2rem;">&#8594;</span></button>
      </div>
    </div>
  </section>
<script>
// Carrusel de videos artistas
document.addEventListener('DOMContentLoaded', function () {

  // Agrupación por orientación
  const videosVerticales = [
    'IMG_3250.MP4',
    'IMG_3269.MP4',
    'IMG_5674.MOV',
    'IMG_7935.MP4',
    'IMG_7960.MP4',
    'IMG_7834.MP4',
    'IMG_8018.MP4',
  ];
  const videosHorizontales = [
    
  ];
  const poster = 'IMG_8004.JPG';
  const grid = document.getElementById('videosCarouselGrid');
  const prevBtn = document.getElementById('videosPrev');
  const nextBtn = document.getElementById('videosNext');
  let page = 0;
  let grupoActual = 'vertical'; // 'vertical' o 'horizontal'

  function getVisibleCount() {
    return window.innerWidth <= 900 ? 1 : 2;
  }

  function getVideosGrupo() {
    return grupoActual === 'vertical' ? videosVerticales : videosHorizontales;
  }

  function renderVideos() {
    const visible = getVisibleCount();
    const videos = getVideosGrupo();
    grid.innerHTML = '';
    const start = page * visible;
    const end = start + visible;
    for (let i = start; i < end && i < videos.length; i++) {
      grid.innerHTML += `<div class='video-card'><video controls ${(i===0&&grupoActual==='vertical')?`poster='${baseURL}public/dist/videos/${poster}'`:''} class='video-responsive'><source src='${baseURL}public/dist/videos/${videos[i]}' type='video/mp4'>Tu navegador no soporta el video.</video></div>`;
    }
    const arrowsMobile = document.querySelector('.videos-arrows-mobile');
    if (window.innerWidth <= 900) {
      arrowsMobile.style.display = 'flex';
      grid.parentNode.insertBefore(arrowsMobile, grid.nextSibling);
      arrowsMobile.innerHTML = '';
      if (page > 0 || grupoActual === 'horizontal') {
        arrowsMobile.appendChild(prevBtn);
        prevBtn.style.display = 'inline-flex';
      } else {
        prevBtn.style.display = 'none';
      }
      if ((page + 1) * visible < videos.length || (grupoActual === 'vertical' && end >= videos.length)) {
        arrowsMobile.appendChild(nextBtn);
        nextBtn.style.display = 'inline-flex';
      } else {
        nextBtn.style.display = 'none';
      }
    } else {
      arrowsMobile.style.display = 'none';
      prevBtn.style.display = 'block';
      nextBtn.style.display = 'block';
      const wrapper = document.querySelector('.videos-carousel-wrapper');
      if (wrapper && !wrapper.contains(prevBtn)) wrapper.insertBefore(prevBtn, grid);
      if (wrapper && !wrapper.contains(nextBtn)) wrapper.appendChild(nextBtn);
    }
    prevBtn.disabled = page === 0 && grupoActual === 'vertical';
    nextBtn.disabled = (end >= videos.length && grupoActual === 'horizontal');
    if (grupoActual === 'vertical' && end >= videos.length) {
      nextBtn.disabled = false;
    }
    if (grupoActual === 'horizontal' && page === 0) {
      prevBtn.disabled = false;
    }
  }

  prevBtn.addEventListener('click', function () {
    if (page > 0) {
      page--;
      renderVideos();
    } else if (grupoActual === 'horizontal') {
      grupoActual = 'vertical';
      page = Math.ceil(videosVerticales.length / getVisibleCount()) - 1;
      renderVideos();
    }
  });
  nextBtn.addEventListener('click', function () {
    const visible = getVisibleCount();
    const videos = getVideosGrupo();
    if ((page + 1) * visible < videos.length) {
      page++;
      renderVideos();
    } else if (grupoActual === 'vertical') {
      grupoActual = 'horizontal';
      page = 0;
      renderVideos();
    }
  });
  window.addEventListener('resize', function () {
    page = 0;
    grupoActual = 'vertical';
    renderVideos();
  });
  renderVideos();
});
</script>

  <!-- TESTIMONIOS -->
  <section id="testimonios" class="section">
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
  <section id="contacto" class="section section-alt">
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

