<?php
// Configuración de la base de datos
define('DB_HOST', 'podcast-db-mysql.mysql.database.azure.com');
define('DB_USER', 'podcastadmin');
define('DB_PASS', 'Podcast2025*');
define('DB_NAME', 'podcast_db');

session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PodcastMX — Plataforma Multidimensional</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Segoe UI', sans-serif; background: #0f0f1a; color: #fff; }

/* NAVBAR */
nav {
  background: #1a1a2e;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid #e94560;
  position: sticky; top: 0; z-index: 100;
}
.logo { font-size: 1.5rem; font-weight: 700; color: #e94560; }
.nav-links a {
  color: #ccc; text-decoration: none;
  margin-left: 1.5rem; font-size: 0.95rem;
  transition: color 0.3s;
}
.nav-links a:hover { color: #e94560; }
.btn-login {
  background: #e94560; color: #fff;
  padding: 0.4rem 1.2rem; border-radius: 20px;
  text-decoration: none; font-weight: 600;
  margin-left: 1.5rem;
}

/* HERO */
.hero {
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
  padding: 4rem 2rem;
  text-align: center;
}
.hero h1 { font-size: 2.5rem; margin-bottom: 1rem; }
.hero h1 span { color: #e94560; }
.hero p { font-size: 1.1rem; color: #aaa; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto; }

/* LIVE BADGE */
.live-badge {
  display: inline-block;
  background: #e94560;
  color: #fff;
  padding: 0.3rem 1rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 700;
  animation: pulse 1.5s infinite;
  margin-bottom: 1rem;
}
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.6; }
}

/* PLAYER EN VIVO */
.live-player {
  background: #1a1a2e;
  border: 2px solid #e94560;
  border-radius: 16px;
  padding: 2rem;
  max-width: 700px;
  margin: 2rem auto;
  text-align: center;
}
.live-player h2 { color: #e94560; margin-bottom: 1rem; }
.video-placeholder {
  background: #0f0f1a;
  height: 300px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  margin-bottom: 1rem;
  border: 1px solid #333;
}
.player-controls {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-top: 1rem;
}
.btn-play {
  background: #e94560;
  color: #fff;
  border: none;
  padding: 0.8rem 2rem;
  border-radius: 30px;
  font-size: 1rem;
  cursor: pointer;
  font-weight: 600;
  transition: transform 0.2s;
}
.btn-play:hover { transform: scale(1.05); }

/* CATEGORIAS POR EDAD */
.section { padding: 3rem 2rem; }
.section h2 {
  font-size: 1.8rem;
  margin-bottom: 2rem;
  text-align: center;
}
.section h2 span { color: #e94560; }

.age-categories {
  display: flex;
  gap: 1.5rem;
  justify-content: center;
  flex-wrap: wrap;
  max-width: 1000px;
  margin: 0 auto;
}
.age-card {
  background: #1a1a2e;
  border: 1px solid #333;
  border-radius: 16px;
  padding: 2rem 1.5rem;
  text-align: center;
  width: 200px;
  cursor: pointer;
  transition: all 0.3s;
}
.age-card:hover {
  border-color: #e94560;
  transform: translateY(-5px);
}
.age-card .emoji { font-size: 3rem; margin-bottom: 1rem; display: block; }
.age-card h3 { color: #e94560; margin-bottom: 0.5rem; }
.age-card p { color: #888; font-size: 0.85rem; }

/* EPISODIOS */
.episodes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  max-width: 1100px;
  margin: 0 auto;
}
.episode-card {
  background: #1a1a2e;
  border: 1px solid #333;
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s;
}
.episode-card:hover {
  border-color: #e94560;
  transform: translateY(-3px);
}
.ep-tag {
  background: #e94560;
  color: #fff;
  font-size: 0.75rem;
  padding: 0.2rem 0.7rem;
  border-radius: 10px;
  display: inline-block;
  margin-bottom: 0.7rem;
}
.ep-title { font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; }
.ep-meta { color: #888; font-size: 0.85rem; margin-bottom: 1rem; }
.btn-escuchar {
  background: transparent;
  border: 1px solid #e94560;
  color: #e94560;
  padding: 0.4rem 1rem;
  border-radius: 20px;
  cursor: pointer;
  font-size: 0.85rem;
  transition: all 0.3s;
}
.btn-escuchar:hover {
  background: #e94560;
  color: #fff;
}

/* REGISTRO */
.register-section {
  background: #16213e;
  padding: 3rem 2rem;
  text-align: center;
}
.register-form {
  background: #1a1a2e;
  max-width: 400px;
  margin: 2rem auto;
  padding: 2rem;
  border-radius: 16px;
  border: 1px solid #333;
}
.form-group { margin-bottom: 1rem; text-align: left; }
.form-group label { display: block; margin-bottom: 0.4rem; color: #aaa; font-size: 0.9rem; }
.form-group input, .form-group select {
  width: 100%;
  background: #0f0f1a;
  border: 1px solid #333;
  color: #fff;
  padding: 0.7rem 1rem;
  border-radius: 8px;
  font-size: 0.95rem;
}
.form-group input:focus, .form-group select:focus {
  outline: none;
  border-color: #e94560;
}
.btn-register {
  width: 100%;
  background: #e94560;
  color: #fff;
  border: none;
  padding: 0.9rem;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  margin-top: 0.5rem;
  transition: opacity 0.3s;
}
.btn-register:hover { opacity: 0.9; }

/* FOOTER */
footer {
  background: #1a1a2e;
  text-align: center;
  padding: 2rem;
  color: #555;
  border-top: 1px solid #333;
  margin-top: 3rem;
}
footer span { color: #e94560; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <div class="logo">🎙️ PodcastMX</div>
  <div class="nav-links">
    <a href="#">Inicio</a>
    <a href="#">En Vivo</a>
    <a href="#">Episodios</a>
    <a href="#">Categorías</a>
    <a href="#registro" class="btn-login">Únete</a>
  </div>
</nav>

<!-- HERO -->
<div class="hero">
  <div class="live-badge">🔴 EN VIVO AHORA</div>
  <h1>Tu plataforma de <span>podcasts</span><br>para toda la familia</h1>
  <p>Contenido para todas las edades — infantil, juvenil y adultos. Escucha en vivo o explora nuestro archivo de episodios.</p>
</div>

<!-- PLAYER EN VIVO -->
<div style="padding: 2rem;">
  <div class="live-player">
    <h2>🎙️ Transmisión en Vivo</h2>
    <div class="video-placeholder">📺</div>
    <p style="color: #888; font-size: 0.9rem;">El video en vivo se activará cuando haya una transmisión activa</p>
    <div class="player-controls">
      <button class="btn-play">▶ Ver en Vivo</button>
      <button class="btn-play" style="background: #16213e; border: 1px solid #e94560;">🎧 Solo Audio</button>
    </div>
  </div>
</div>

<!-- CATEGORÍAS POR EDAD -->
<div class="section">
  <h2>Contenido para <span>cada edad</span></h2>
  <div class="age-categories">
    <div class="age-card">
      <span class="emoji">👶</span>
      <h3>Infantil</h3>
      <p>Para niños de 3 a 10 años</p>
    </div>
    <div class="age-card">
      <span class="emoji">🧒</span>
      <h3>Juvenil</h3>
      <p>Para jóvenes de 11 a 17 años</p>
    </div>
    <div class="age-card">
      <span class="emoji">👨</span>
      <h3>Adultos</h3>
      <p>Para mayores de 18 años</p>
    </div>
    <div class="age-card">
      <span class="emoji">👴</span>
      <h3>Adultos mayores</h3>
      <p>Contenido especial 60+</p>
    </div>
  </div>
</div>

<!-- EPISODIOS ANTERIORES -->
<div class="section" style="background: #16213e;">
  <h2>Episodios <span>anteriores</span></h2>
  <div class="episodes-grid">
    <div class="episode-card">
      <span class="ep-tag">👶 Infantil</span>
      <div class="ep-title">Cuentos del bosque encantado</div>
      <div class="ep-meta">Episodio 12 · 25 min · Hace 2 días</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
    <div class="episode-card">
      <span class="ep-tag">🧒 Juvenil</span>
      <div class="ep-title">Ciencia y tecnología para jóvenes</div>
      <div class="ep-meta">Episodio 8 · 40 min · Hace 4 días</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
    <div class="episode-card">
      <span class="ep-tag">👨 Adultos</span>
      <div class="ep-title">Economía mexicana hoy</div>
      <div class="ep-meta">Episodio 25 · 55 min · Hace 1 semana</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
    <div class="episode-card">
      <span class="ep-tag">👶 Infantil</span>
      <div class="ep-title">Aprende inglés jugando</div>
      <div class="ep-meta">Episodio 5 · 20 min · Hace 1 semana</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
    <div class="episode-card">
      <span class="ep-tag">👴 60+</span>
      <div class="ep-title">Salud y bienestar en la tercera edad</div>
      <div class="ep-meta">Episodio 3 · 35 min · Hace 2 semanas</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
    <div class="episode-card">
      <span class="ep-tag">👨 Adultos</span>
      <div class="ep-title">Historia de México: episodios olvidados</div>
      <div class="ep-meta">Episodio 18 · 60 min · Hace 2 semanas</div>
      <button class="btn-escuchar">▶ Escuchar</button>
    </div>
  </div>
</div>

<!-- REGISTRO -->
<div class="register-section" id="registro">
  <h2>Únete a <span style="color: #e94560;">PodcastMX</span></h2>
  <p style="color: #888; margin-bottom: 1rem;">Crea tu cuenta gratis y accede a todo el contenido</p>
  <div class="register-form">
    <div class="form-group">
      <label>Nombre completo</label>
      <input type="text" placeholder="Tu nombre">
    </div>
    <div class="form-group">
      <label>Correo electrónico</label>
      <input type="email" placeholder="correo@ejemplo.com">
    </div>
    <div class="form-group">
      <label>Contraseña</label>
      <input type="password" placeholder="Mínimo 8 caracteres">
    </div>
    <div class="form-group">
      <label>Grupo de edad</label>
      <select>
        <option>Selecciona tu edad</option>
        <option>Infantil (3-10 años)</option>
        <option>Juvenil (11-17 años)</option>
        <option>Adulto (18-59 años)</option>
        <option>Adulto mayor (60+)</option>
      </select>
    </div>
    <button class="btn-register">Crear cuenta gratis</button>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <p>© 2025 <span>PodcastMX</span> — Plataforma Multidimensional de Podcasts</p>
  <p style="margin-top: 0.5rem; font-size: 0.85rem;">Alojado en Microsoft Azure · Mexico Central</p>
</footer>

</body>
</html>
