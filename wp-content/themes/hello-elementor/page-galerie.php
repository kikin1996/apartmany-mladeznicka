<?php
/**
 * Template Name: Galerie custom
 */
get_header();
$uploads = home_url('/wp-content/uploads/2025/03/');
?>
<style>
/* ── Reset ─────────────────────────────────── */
#gal-app * { box-sizing: border-box; }
#gal-app {
    background: #fff;
    min-height: 100vh;
    padding: 24px 16px 72px;
    font-family: 'Inter', -apple-system, sans-serif;
}

.gal-card {
    max-width: 1280px;
    margin: 0 auto;
    background: #fff;
    padding: 28px 20px;
}
@media (min-width: 768px)  { .gal-card { padding: 40px; } }
@media (min-width: 1024px) { .gal-card { padding: 52px; } }

/* ── Hero split ─────────────────────────────── */
.gal-hero {
    display: grid;
    grid-template-columns: 1fr;
    gap: 32px;
    align-items: center;
    margin-bottom: 40px;
}
@media (min-width: 900px) {
    .gal-hero { grid-template-columns: 1fr 1fr; gap: 48px; margin-bottom: 52px; }
}

.gal-hero-img-wrap {
    width: 100%;
    aspect-ratio: 4/3;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}
.gal-hero-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s ease;
}
.gal-hero-img-wrap:hover img { transform: scale(1.04); }

.gal-hero-text { display: flex; flex-direction: column; justify-content: center; gap: 16px; }

.gal-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 14px;
    border-radius: 9999px;
    background: #f1f5f9;
    border: 1px solid rgba(226,232,240,0.9);
    font-size: 12px;
    font-weight: 500;
    color: #64748b;
    width: fit-content;
}

.gal-hero-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: #1e293b;
    line-height: 1.15;
    margin: 0;
    font-family: 'Playfair Display', Georgia, serif;
}

.gal-hero-desc {
    font-size: 16px;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* ── Divider ────────────────────────────────── */
.gal-divider { border: none; border-top: 1px solid #f1f5f9; margin: 0 0 36px; }

/* ── Filter buttons ─────────────────────────── */
.gal-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-bottom: 40px;
}
.gal-filter-btn {
    padding: 10px 28px;
    border-radius: 8px;
    border: 1px solid rgba(226,232,240,0.9);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, color .2s, border-color .2s, box-shadow .2s, transform .15s;
    background: #f8fafc;
    color: #475569;
    letter-spacing: .3px;
    -webkit-tap-highlight-color: transparent;
}
.gal-filter-btn:hover {
    background: #e2e8f0;
    transform: translateY(-1px);
}
.gal-filter-btn.active {
    background: #92B675;
    color: #fff;
    border-color: #92B675;
    box-shadow: 0 4px 14px rgba(146,182,117,0.35);
}


/* ── Grid ───────────────────────────────────── */
.gal-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}
@media (min-width: 640px)  { .gal-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; } }
@media (min-width: 1024px) { .gal-grid { grid-template-columns: repeat(4, 1fr); gap: 16px; } }

.gal-item {
    aspect-ratio: 1;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    background: #f1f5f9;
    transition: border-color .2s, box-shadow .2s, transform .2s;
    padding: 0;
}
.gal-item:hover {
    border-color: #92B675;
    box-shadow: 0 0 0 3px rgba(146,182,117,.2);
    transform: translateY(-2px);
}
.gal-item img { width: 100%; height: 100%; object-fit: cover; display: block; }

.gal-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
    font-size: 15px;
}

/* ── Lightbox ───────────────────────────────── */
#gal-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0,0,0,.97);
    align-items: center;
    justify-content: center;
}
#gal-lightbox.open { display: flex; }
#gal-lb-inner {
    position: relative;
    max-width: 96vw;
    max-height: 96vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
#gal-lb-img {
    max-width: 92vw;
    max-height: 88vh;
    object-fit: contain;
    border-radius: 4px;
    display: block;
}
.gal-lb-btn {
    position: absolute;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.2);
    color: #fff;
    font-size: 28px;
    line-height: 1;
    cursor: pointer;
    padding: 0;
    width: 48px; height: 48px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
    z-index: 2;
    backdrop-filter: blur(4px);
}
.gal-lb-btn:hover { background: rgba(146,182,117,.7); border-color: #92B675; }
#gal-lb-close { top: -56px; right: 0; }
#gal-lb-prev  { left: -64px; top: 50%; transform: translateY(-50%); }
#gal-lb-next  { right: -64px; top: 50%; transform: translateY(-50%); }
@media (max-width: 768px) {
    #gal-lb-prev { left: 6px; }
    #gal-lb-next { right: 6px; }
    #gal-lb-close { top: -50px; right: 6px; }
}
#gal-lb-counter {
    position: absolute;
    bottom: -36px;
    left: 50%; transform: translateX(-50%);
    color: rgba(255,255,255,.7);
    font-size: 13px;
    white-space: nowrap;
}
</style>

<?php
// Build image data
$interior = [
    '40000-9-scaled.jpg','30000-11-scaled.jpg','02-4-scaled.jpg','70000-2-scaled.jpg',
    'bbb2.jpg','20000-8-scaled.jpg','50000-8-scaled.jpg','60000-4-scaled.jpg',
    '80000-2-scaled.jpg','10000-8-scaled.jpg','bbb9.jpg','B1-scaled.jpg',
    'bbb.jpg','B3-scaled.jpg','bbb8-6.jpg','B2-scaled.jpg','B4-scaled.jpg',
    '003-scaled.jpg','002-2-scaled.jpg','001-2-scaled.jpg','01-5-scaled.jpg'
];
$exterior = [
    'bbb3.jpg','B2-2-1-scaled.jpg','bbb4.jpg','B3-2-2-scaled.jpg',
    'bbb7.jpg','B1-2-1-scaled.jpg','bbb5.jpg','B4-2-1-scaled.jpg'
];
?>

<div id="gal-app">
  <div class="gal-card">

    <!-- Hero split: foto + text -->
    <div class="gal-hero">
      <div class="gal-hero-img-wrap">
        <img src="<?php echo $uploads; ?>40000-9-scaled.jpg" alt="Galerie bytů Mládežnická"/>
      </div>
      <div class="gal-hero-text">
        <span class="gal-badge">Fotogalerie</span>
        <h1 class="gal-hero-title">Prohlédněte si naše byty</h1>
        <p class="gal-hero-desc">
          Procházejte fotografiemi interiérů a exteriérů bytů na Mládežnické.
          Každý záběr zachycuje kvalitu zpracování, vzdušné dispozice a moderní design,
          které z tohoto projektu dělají výjimečné místo k bydlení.
        </p>
      </div>
    </div>

    <hr class="gal-divider"/>

    <!-- Filter buttons -->
    <div class="gal-filters">
      <button class="gal-filter-btn active" data-filter="all"      onclick="setFilter('all')">Vše</button>
      <button class="gal-filter-btn"        data-filter="interior" onclick="setFilter('interior')">Interiér</button>
      <button class="gal-filter-btn"        data-filter="exterior" onclick="setFilter('exterior')">Exteriér</button>
    </div>

    <!-- Photo grid -->
    <div class="gal-grid" id="gal-grid"></div>

  </div>
</div>

<!-- Lightbox -->
<div id="gal-lightbox" onclick="if(event.target===this)galLbClose()">
  <div id="gal-lb-inner">
    <button class="gal-lb-btn" id="gal-lb-close" onclick="galLbClose()">×</button>
    <button class="gal-lb-btn" id="gal-lb-prev"  onclick="galLbNav(-1)">‹</button>
    <img id="gal-lb-img" src="" alt=""/>
    <button class="gal-lb-btn" id="gal-lb-next"  onclick="galLbNav(1)">›</button>
    <div id="gal-lb-counter"></div>
  </div>
</div>

<script>
(function(){
  var BASE = '<?php echo $uploads; ?>';

  var IMAGES = {
    interior: <?php echo json_encode(array_values($interior)); ?>,
    exterior: <?php echo json_encode(array_values($exterior)); ?>
  };

  var currentFilter = 'all';
  var currentImages = [];
  var lbIdx = 0;

  /* ── Lightbox ─────────────────────────────── */
  var lbEl  = document.getElementById('gal-lightbox');
  var lbImg = document.getElementById('gal-lb-img');
  var lbCnt = document.getElementById('gal-lb-counter');
  var lbP   = document.getElementById('gal-lb-prev');
  var lbN   = document.getElementById('gal-lb-next');

  function openLb(imgs, idx) {
    currentImages = imgs; lbIdx = idx;
    updateLb();
    lbEl.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function updateLb() {
    lbImg.src = BASE + currentImages[lbIdx];
    lbCnt.textContent = (lbIdx + 1) + ' / ' + currentImages.length;
    lbP.style.display = lbIdx > 0 ? '' : 'none';
    lbN.style.display = lbIdx < currentImages.length - 1 ? '' : 'none';
  }
  window.galLbClose = function() { lbEl.classList.remove('open'); document.body.style.overflow = ''; };
  window.galLbNav   = function(d) { lbIdx = Math.max(0, Math.min(currentImages.length - 1, lbIdx + d)); updateLb(); };
  document.addEventListener('keydown', function(e) {
    if (!lbEl.classList.contains('open')) return;
    if (e.key === 'Escape')      galLbClose();
    if (e.key === 'ArrowLeft')   galLbNav(-1);
    if (e.key === 'ArrowRight')  galLbNav(1);
  });

  /* ── Render grid ──────────────────────────── */
  function getFilteredImages() {
    if (currentFilter === 'interior') return IMAGES.interior;
    if (currentFilter === 'exterior') return IMAGES.exterior;
    return IMAGES.interior.concat(IMAGES.exterior);
  }

  function renderGrid() {
    var imgs = getFilteredImages();
    var grid = document.getElementById('gal-grid');
    grid.innerHTML = '';
    if (!imgs.length) {
      grid.innerHTML = '<p class="gal-empty">Žádné fotografie.</p>';
      return;
    }
    imgs.forEach(function(file, i) {
      var btn = document.createElement('button');
      btn.className = 'gal-item';
      var img = document.createElement('img');
      img.src = BASE + file;
      img.alt = 'Fotografie ' + (i + 1);
      img.loading = 'lazy';
      btn.appendChild(img);
      btn.addEventListener('click', function() { openLb(imgs, i); });
      grid.appendChild(btn);
    });
  }

  /* ── Filter ───────────────────────────────── */
  window.setFilter = function(f) {
    currentFilter = f;
    document.querySelectorAll('.gal-filter-btn').forEach(function(b) {
      b.classList.toggle('active', b.getAttribute('data-filter') === f);
    });
    renderGrid();
    // Smooth scroll to grid
    var gridEl = document.getElementById('gal-grid');
    if (gridEl) gridEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  /* ── Init ─────────────────────────────────── */
  renderGrid();
})();
</script>

<?php
// Clean up temp files
@unlink(ABSPATH . 'gallery_data.json');
@unlink(ABSPATH . 'parse-gallery.php');
@unlink(ABSPATH . 'get-gallery.php');
get_footer();
?>
