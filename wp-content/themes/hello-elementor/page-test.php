<?php
/**
 * Template Name: Výběr domu
 */
get_header();
$base = get_template_directory_uri() . '/assets/vyber-domu';
?>
<style>
/* ── Reset & Base ───────────────────────────── */
#vyber-domu-app * { box-sizing: border-box; }
#vyber-domu-app {
    background: #fff;
    min-height: 100vh;
    padding: 20px 16px 60px;
    font-family: 'Inter', sans-serif;
}
.vd-card {
    max-width: 1280px;
    margin: 0 auto;
    background: #fff;
    padding: 20px 16px;
}
@media (min-width: 768px) { .vd-card { padding: 40px; } }
@media (min-width: 1024px) { .vd-card { padding: 48px; } }

/* ── Heading ────────────────────────────────── */
.vd-title { font-size: 28px; font-weight: 600; color: #1E2738; margin: 0 0 6px; }
.vd-subtitle { color: #64748b; font-size: 15px; margin: 0 0 24px; }

/* ── Map ────────────────────────────────────── */
.vd-map-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 4000 / 2250;
    overflow: hidden;
    background: transparent;
}
.vd-map-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
}
.zone {
    fill: rgba(146,182,117,0.15);
    stroke: #92B675;
    stroke-width: 6;
    cursor: pointer;
    transition: fill 0.2s, stroke 0.2s;
}
.zone:hover { fill: rgba(146,182,117,0.40); stroke: #7a9a62; }
.zone-label {
    fill: #fff;
    font-size: 120px;
    font-weight: 700;
    pointer-events: none;
    font-family: 'Inter', sans-serif;
}

/* ── Floor nav row ──────────────────────────── */
.vd-floor-nav {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-top: 16px;
}
@media (max-width: 600px) { .vd-floor-nav { gap: 8px; } }
.vd-floor-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    text-decoration: none;
    transition: background .2s, border-color .2s, transform .15s, box-shadow .2s;
}
.vd-floor-link:hover {
    background: #f0faf4;
    border-color: #92B675;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(146,182,117,0.18);
    text-decoration: none;
}
.vd-floor-link-label {
    font-size: clamp(15px, 1.6vw, 20px);
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
}
.vd-floor-link-sub {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 400;
    display: block;
    margin-top: 2px;
}
.vd-floor-link-arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #92B675;
    color: #fff;
    flex-shrink: 0;
    transition: background .2s, transform .2s;
}
.vd-floor-link:hover .vd-floor-link-arrow {
    background: #7a9a62;
    transform: translateX(3px);
}
.vd-floor-link-arrow svg { width: 16px; height: 16px; }

/* ── 3-column detail grid ───────────────────── */
.vd-detail-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    margin-top: 28px;
}
@media (min-width: 1024px) {
    .vd-detail-grid { grid-template-columns: 1fr 1fr 1fr; gap: 24px; }
}

.vd-col-title {
    font-size: 13px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 10px;
}

/* ── House views & floor plans ──────────────── */
.vd-col-panel {
    border: 1px solid rgba(226,232,240,0.7);
    border-radius: 16px;
    overflow: hidden;
    background: #f8fafc;
}
.vd-col-panel-inner { padding: 16px; }

.vd-view-img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    display: block;
    cursor: pointer;
    transition: opacity 0.2s;
}
.vd-view-img:hover { opacity: 0.85; }
.vd-view-spacer { height: 8px; }

.vd-fp-img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: contain;
    display: block;
    background: #fff;
    border-radius: 8px;
    cursor: pointer;
    transition: opacity 0.2s;
    margin-bottom: 16px;
}
.vd-fp-img:hover { opacity: 0.85; }
.vd-fp-img:last-child { margin-bottom: 0; }

/* ── Info panel ─────────────────────────────── */
.vd-info-panel {
    border: 1px solid rgba(226,232,240,0.7);
    border-radius: 16px;
    background: #f8fafc;
    padding: 24px;
}
.vd-status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 16px;
}
.vd-status-volny { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
.vd-status-rezervovano { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
.vd-status-prodano { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }

.vd-info-name {
    font-size: 22px;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 10px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.vd-herb-icon { width: 44px; height: 44px; object-fit: contain; flex-shrink: 0; }
.vd-info-desc { font-size: 14px; color: #64748b; line-height: 1.6; margin: 0 0 20px; }

.vd-pdf-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 20px;
    border-radius: 8px;
    background: #00D9B5;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 12px rgba(0,217,181,0.3);
    margin-bottom: 20px;
}
.vd-pdf-btn:hover { background: #00B89A; color: #fff; box-shadow: 0 6px 16px rgba(0,217,181,0.4); text-decoration: none; }

.vd-metrics { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.vd-metric {
    background: #fff;
    border: 1px solid rgba(226,232,240,0.7);
    border-radius: 8px;
    padding: 14px;
}
.vd-metric.full { grid-column: 1 / -1; }
.vd-metric-label { font-size: 11px; color: #94a3b8; margin-bottom: 4px; }
.vd-metric-value { font-size: 17px; font-weight: 600; color: #1e293b; }
.vd-discount-badge {
    display: inline-flex;
    align-items: center;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 600;
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
    margin-top: 6px;
}

/* ── Interior gallery ───────────────────────── */
.vd-interior-section { margin-top: 40px; }
.vd-interior-title { font-size: 16px; font-weight: 600; color: #1e293b; margin: 0 0 12px; }
.vd-interior-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.vd-interior-thumb {
    width: 80px; height: 80px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(226,232,240,0.7);
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color 0.15s, box-shadow 0.15s;
    background: #fff;
    padding: 0;
}
.vd-interior-thumb:hover {
    border-color: #00D9B5;
    box-shadow: 0 0 0 3px rgba(0,217,181,0.25);
}
.vd-interior-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
@media (min-width: 640px) { .vd-interior-thumb { width: 112px; height: 112px; } }
@media (min-width: 768px) { .vd-interior-thumb { width: 160px; height: 160px; } }
.vd-interior-hint { font-size: 13px; color: #94a3b8; margin-top: 8px; }

/* ── Divider ────────────────────────────────── */
.vd-divider { border: none; border-top: 1px solid #f1f5f9; margin: 48px 0; }

/* ── Table ──────────────────────────────────── */
.vd-table-header { text-align: center; margin-bottom: 32px; }
.vd-table-overline { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.5px; color: #00D9B5; margin: 0 0 8px; }
.vd-table-heading { font-size: 26px; font-weight: 600; color: #1E2738; margin: 0; }
.vd-table-scroll { overflow-x: auto; }
.vd-table { width: 100%; border-collapse: collapse; }
.vd-table thead tr { background: #f1f5f9; }
.vd-table th {
    text-align: left;
    padding: 14px 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #1e293b;
    white-space: nowrap;
}
.vd-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.15s;
}
.vd-table tbody tr:hover { background: #f8fafc; }
.vd-table td { padding: 14px 20px; font-size: 14px; color: #64748b; vertical-align: middle; }
.vd-table-name { font-weight: 600; color: #1e293b; }
.vd-table-name-inner { display: flex; align-items: center; gap: 10px; }
.vd-table-herb { width: 40px; height: 40px; object-fit: contain; flex-shrink: 0; }
.vd-status-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 6px; vertical-align: middle; }
.vd-dot-volny { background: #10b981; }
.vd-dot-rezervovano { background: #f59e0b; }
.vd-dot-prodano { background: #94a3b8; }
.vd-table-pdf-btn {
    display: inline-block;
    padding: 7px 20px;
    border-radius: 6px;
    background: #00D9B5;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.15s;
}
.vd-table-pdf-btn:hover { background: #00B89A; color: #fff; text-decoration: none; }

/* ── Lightbox ───────────────────────────────── */
#vd-lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0,0,0,0.96);
    align-items: center;
    justify-content: center;
}
#vd-lightbox.open { display: flex; }
#vd-lightbox-inner {
    position: relative;
    max-width: 95vw;
    max-height: 95vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
#vd-lightbox-img {
    max-width: 90vw;
    max-height: 88vh;
    object-fit: contain;
    border-radius: 4px;
    display: block;
}
.vd-lb-btn {
    position: absolute;
    background: none;
    border: none;
    color: #fff;
    font-size: 50px;
    cursor: pointer;
    line-height: 1;
    padding: 10px;
    transition: color 0.15s;
    z-index: 2;
}
.vd-lb-btn:hover { color: #00D9B5; }
#vd-lb-close { top: -10px; right: -10px; font-size: 40px; }
#vd-lb-prev { left: -60px; top: 50%; transform: translateY(-50%); }
#vd-lb-next { right: -60px; top: 50%; transform: translateY(-50%); }
@media (max-width: 768px) {
    #vd-lb-prev { left: 4px; }
    #vd-lb-next { right: 4px; }
    #vd-lb-close { top: 4px; right: 4px; }
}
#vd-lb-counter {
    position: absolute;
    bottom: -32px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-size: 13px;
    white-space: nowrap;
}
#vd-lb-caption {
    position: absolute;
    bottom: -56px;
    left: 50%;
    transform: translateX(-50%);
    color: #cbd5e1;
    font-size: 14px;
    text-align: center;
    white-space: nowrap;
    max-width: 80vw;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ── Order on mobile ────────────────────────── */
@media (max-width: 1023px) {
    .vd-col-info  { order: -1; }
    .vd-col-views { order: 1; }
    .vd-col-fps   { order: 2; }
}
</style>

<div id="vyber-domu-app">
  <div class="vd-card">

    <!-- Heading -->
    <h1 class="vd-title">Vyberte si patro:</h1>

    <!-- SVG Map -->
    <div class="vd-map-wrap">
      <svg id="zonesMap" class="vd-map-svg" viewBox="0 0 4000 2250" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

        <!-- ZÓNA 1 -->
        <a xlink:href="<?php echo home_url('/1-patro/'); ?>">
          <g class="zone-group">
            <polygon points="373,1432 2656,1379 2653,1248 373,1054" class="zone"></polygon>
            <text x="700" y="1400" class="zone-label">1</text>
          </g>
        </a>

        <!-- ZÓNA 2 -->
        <a xlink:href="<?php echo home_url('/2-patro/'); ?>">
          <g class="zone-group">
            <polygon points="373,1054 2653,1248 2653,1128 373,637" class="zone"></polygon>
            <text x="700" y="1050" class="zone-label">2</text>
          </g>
        </a>

        <!-- ZÓNA 3 -->
        <a xlink:href="<?php echo home_url('/3-patro/'); ?>">
          <g class="zone-group">
            <polygon points="373,637 2653,1128 2653,1011 373,248" class="zone"></polygon>
            <text x="700" y="650" class="zone-label">3</text>
          </g>
        </a>

      </svg>

    </div>

    <!-- Floor navigation -->
    <div class="vd-floor-nav">
      <a class="vd-floor-link" href="<?php echo home_url('/1-patro/'); ?>">
        <div>
          <span class="vd-floor-link-label">1. Patro</span>
          <span class="vd-floor-link-sub">Výběr bytu</span>
        </div>
        <span class="vd-floor-link-arrow">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </a>
      <a class="vd-floor-link" href="<?php echo home_url('/2-patro/'); ?>">
        <div>
          <span class="vd-floor-link-label">2. Patro</span>
          <span class="vd-floor-link-sub">Výběr bytu</span>
        </div>
        <span class="vd-floor-link-arrow">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </a>
      <a class="vd-floor-link" href="<?php echo home_url('/3-patro/'); ?>">
        <div>
          <span class="vd-floor-link-label">3. Patro</span>
          <span class="vd-floor-link-sub">Výběr bytu</span>
        </div>
        <span class="vd-floor-link-arrow">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
      </a>
    </div>

    <!-- 3-column detail -->
    <div class="vd-detail-grid">
      <!-- Col 1: Views -->
      <div class="vd-col-views">
        <p class="vd-col-title">Pohled na dům</p>
        <div class="vd-col-panel" id="vd-views-panel"></div>
      </div>
      <!-- Col 2: Floor plans -->
      <div class="vd-col-fps">
        <p class="vd-col-title">Půdorysy</p>
        <div class="vd-col-panel vd-col-panel-inner" id="vd-fps-panel"></div>
      </div>
      <!-- Col 3: Info -->
      <div class="vd-col-info">
        <p class="vd-col-title">Informace o domě</p>
        <div class="vd-info-panel" id="vd-info-panel"></div>
      </div>
    </div>

    <!-- Interior gallery -->
    <div class="vd-interior-section">
      <h3 class="vd-interior-title">Vizualizace interiéru</h3>
      <div class="vd-interior-grid" id="vd-interior-grid"></div>
      <p class="vd-interior-hint">Kliknutím na obrázek zobrazíte vizualizaci v plné velikosti.</p>
    </div>

    <hr class="vd-divider"/>

    <!-- Table -->
    <div class="vd-table-header">
      <p class="vd-table-overline">Další nabídky</p>
      <h2 class="vd-table-heading">Výběr dostupnosti</h2>
    </div>
    <div class="vd-table-scroll">
      <table class="vd-table" id="vd-table"></table>
    </div>

  </div><!-- .vd-card -->
</div><!-- #vyber-domu-app -->

<!-- Lightbox -->
<div id="vd-lightbox" onclick="vdCloseLightbox(event)">
  <div id="vd-lightbox-inner">
    <button class="vd-lb-btn" id="vd-lb-close"  onclick="vdLbClose()">×</button>
    <button class="vd-lb-btn" id="vd-lb-prev"   onclick="vdLbNav(-1)">‹</button>
    <img    id="vd-lightbox-img" src="" alt=""/>
    <button class="vd-lb-btn" id="vd-lb-next"   onclick="vdLbNav(1)">›</button>
    <div id="vd-lb-counter"></div>
    <div id="vd-lb-caption"></div>
  </div>
</div>

<script>
(function(){
  var BASE = '<?php echo $base; ?>';

  /* ── House data ───────────────────────────── */
  var HOUSES = [
    {id:'1', name:'Dům 1 – Šalvěj',       usable:149.4, plot:411,  rooms:5, baths:2, status:'Volný', price:11490000, herb:'salvej',       pdf:'/karty domu/Dum 1.pdf',  desc:'Síla, stabilita a moudrost. Moderní domov s důrazem na dlouhodobý komfort.'},
    {id:'2', name:'Dům 2 – Chrpa',         usable:149.4, plot:410,  rooms:5, baths:2, status:'Volný', price:11590000, herb:'chrpa',         pdf:'/karty domu/Dum 2.pdf',  desc:'Výraz přírodní elegance a charakteru. Dům, který vyniká osobitostí a nadčasovým stylem.'},
    {id:'3', name:'Dům 3 – Pampeliška',    usable:149.4, plot:403,  rooms:5, baths:2, status:'Volný', price:10890000, herb:'pampeliska',    pdf:'/karty domu/Dum 3.pdf',  desc:'Přirozenost, lehkost a volnost. Domov, který nabízí prostor pro nové začátky a radost z bydlení.'},
    {id:'4', name:'Dům 4 – Heřmánek',      usable:149.4, plot:402,  rooms:5, baths:2, status:'Volný', price:10890000, herb:'hermanek',      pdf:'/karty domu/Dum 4.pdf',  desc:'Klid, harmonie a přirozená rovnováha. Ideální místo pro odpočinek a každodenní pohodu.'},
    {id:'5', name:'Dům 5 – Mateřídouška',  usable:149.4, plot:401,  rooms:5, baths:2, status:'Volný', price:11190000, herb:'materidouska',  pdf:'/karty domu/Dum 5.pdf',  desc:'Teplo domova a blízkost přírody. Útulné bydlení s klidnou, rodinnou atmosférou.'},
    {id:'6', name:'Dům 6 – Zvonek',        usable:149.4, plot:401,  rooms:5, baths:2, status:'Volný', price:11490000, herb:'zvonek',        pdf:'/karty domu/Dum 6.pdf',  desc:'Lehkost a vzdušnost propojená s okolní krajinou. Dům plný světla a otevřených výhledů.'},
    {id:'7', name:'Dům 7 – Prvosenka',     usable:149.4, plot:401,  rooms:5, baths:2, status:'Volný', price:11490000, herb:'prvosenka',     pdf:'/karty domu/Dum 7.pdf',  desc:'Nové začátky a svěžest. Světlý domov, který vítá každý nový den.'},
    {id:'8', name:'Dům 8 – Violka',        usable:149.4, plot:401,  rooms:5, baths:2, status:'Volný', price:11590000, herb:'violka',        pdf:'/karty domu/Dum 8.pdf',  desc:'Něžnost a elegance s klidnou atmosférou. Domov pro pohodové a harmonické bydlení.'},
    {id:'9', name:'Dům 9 – Pomněnka',      usable:207.7, plot:401,  rooms:7, baths:2, status:'Volný', price:14990000, herb:'pomenka',       pdf:'/karty domu/dum 9.pdf',  desc:'Jemnost a trvalé hodnoty. Místo, ke kterému se budete vždy rádi vracet.'},
    {id:'10',name:'Dům 10 – Jetel',        usable:207.7, plot:401,  rooms:7, baths:2, status:'Volný', price:15290000, herb:'jetel',         pdf:'/karty domu/dum 10.pdf', desc:'Symbol štěstí a hojnosti. Promyšlené bydlení s důrazem na praktičnost a pohodu.'},
    {id:'11',name:'Dům 11 – Sedmikráska',  usable:197.7, plot:1304, rooms:5, baths:2, status:'Volný', price:15590000, herb:'sedmikraska',   pdf:'/karty domu/Dum 11.pdf', desc:'Jemnost a klid v harmonickém prostředí. Ideální místo pro pohodové a vyvážené bydlení.'},
    {id:'12',name:'Dům 12 – Kopretina',    usable:197.7, plot:978,  rooms:5, baths:2, status:'Volný', price:14900000, herb:'kopretina',     pdf:'/karty domu/Dum 12.pdf', desc:'Symbol jednoduchosti, světla a otevřeného prostoru. Dům s příjemnou atmosférou pro každodenní rodinný život.'}
  ];

  /* ── Floor plan maps ──────────────────────── */
  function getFloorplans(id){
    var n=parseInt(id);
    if([1,3,5,7].includes(n)) return ['A1_P','A2_P','A3_P'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    if([2,4,6,8].includes(n)) return ['A1_L','A2_L','A3_L'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    if(n===9)  return ['B0_P','B1_P','B2_P','B3_P'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    if(n===10) return ['B0_L','B1_L','B2_L','B3_L'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    if(n===11) return ['C1_L','C2_L'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    if(n===12) return ['C1_P','C2_P'].map(f=>BASE+'/images/pudorysy/'+f+'.jpg');
    return [];
  }

  /* ── House view images ────────────────────── */
  var PD = BASE+'/images/pohled na dum';
  function getViews(id){
    var n=parseInt(id);
    if([1,3,5,7].includes(n)) return [PD+'/dvojdum_2patra_1P.jpg', PD+'/dvojdum_2patra_2P.jpg'];
    if([2,4,6,8].includes(n)) return [PD+'/dvojdum_2patra_1L.jpg', PD+'/dvojdum_2patra_2L.jpg'];
    if(n===9)  return [PD+'/dvojdum_3patra_1P.jpg', PD+'/dvojdum_3patra_2P.jpg'];
    if(n===10) return [PD+'/dvojdum_3patra_1L.jpg', PD+'/dvojdum_3patra_2L.jpg'];
    if(n===11) return [PD+'/bungalov1_L.jpg', PD+'/bungalov2_L.jpg'];
    if(n===12) return [PD+'/bungalov1_P.jpg', PD+'/bungalov2_P.jpg'];
    return [];
  }

  /* ── Interior images ──────────────────────── */
  var INTERIOR_FILES = {
    'domy-1-3-5-7': ['a (1)_domy1357.jpg','a (2)_domy1357.jpg','a (3)_domy1357.jpg','a (4)_domy1357.jpg','a (5)_domy1357.jpg','a (6)_domy1357.jpg','a (7)_domy1357.jpg','b (1)_domy1357.jpg','b (2)_domy1357.jpg','b (3)_domy1357.jpg','b (4)_domy1357.jpg','b (5)_domy1357.jpg','c (1)_domy1357.jpg','c (2)_domy1357.jpg','c (3)_domy1357.jpg','c (4)_domy1357.jpg','c (5)_domy1357.jpg'],
    'domy-2-4-6-8': ['a (1)_domy2468.jpg','a (2)_domy2468.jpg','a (3)_domy2468.jpg','a (4)_domy2468.jpg','a (5)_domy2468.jpg','a (6)_domy2468.jpg','a (7)_domy2468.jpg','b (1)_domy2468.jpg','b (2)_domy2468.jpg','b (3)_domy2468.jpg','b (4)_domy2468.jpg','b (5)_domy2468.jpg','c (1)_domy2468.jpg','c (2)_domy2468.jpg','c (3)_domy2468.jpg','c (4)_domy2468.jpg','c (5)_domy2468.jpg'],
    'dum-9':  ['a (1)_dum9.jpg','a (2)_dum9.jpg','a (3)_dum9.jpg','a (4)_dum9.jpg','a (5)_dum9.jpg','a (6)_dum9.jpg','a (7)_dum9.jpg','b (1)_dum9.jpg','b (2)_dum9.jpg','b (3)_dum9.jpg','b (4)_dum9.jpg','b (5)_dum9.jpg','c (1)_dum9.jpg','c (2)_dum9.jpg','c (3)_dum9.jpg','c (4)_dum9.jpg','c (5)_dum9.jpg','d (1)_dum9.jpg','d (2)_dum9.jpg','d (3)_dum9.jpg','d (4)_dum9.jpg','d (5)_dum9.jpg','d (6)_dum9.jpg','e (1)_dum9.jpg','e (2)_dum9.jpg','e (3)_dum9.jpg','e (4)_dum9.jpg','e (5)_dum9.jpg'],
    'dum-10': ['a (1)_dum10.jpg','a (2)_dum10.jpg','a (3)_dum10.jpg','a (4)_dum10.jpg','a (5)_dum10.jpg','a (6)_dum10.jpg','a (7)_dum10.jpg','b (1)_dum10.jpg','b (2)_dum10.jpg','b (3)_dum10.jpg','b (4)_dum10.jpg','b (5)_dum10.jpg','c (1)_dum10.jpg','c (2)_dum10.jpg','c (3)_dum10.jpg','c (4)_dum10.jpg','c (5)_dum10.jpg','d (1)_dum10.jpg','d (2)_dum10.jpg','d (3)_dum10.jpg','d (4)_dum10.jpg','d (5)_dum10.jpg','d (6)_dum10.jpg','e (1)_dum10.jpg','e (2)_dum10.jpg','e (3)_dum10.jpg','e (4)_dum10.jpg','e (5)_dum10.jpg'],
    'dum-11': ['f (1)_dum11.jpg','f (2)_dum11.jpg','f (3)_dum11.jpg','f (4)_dum11.jpg','g_ (1)_dum11.jpg','g_ (2)2_dum11.jpg','g_ (3)3_dum11.jpg','g_ (4)_dum11.jpg','g_ (5)_dum11.jpg','g_ (6)_dum11.jpg','g_ (7)2_dum11.jpg','h (1)_dum11.jpg','h (2)_dum11.jpg','h (3)_dum11.jpg','h (4)_dum11.jpg','h (5)_dum11.jpg'],
    'dum-12': ['f (1)_dum12.jpg','f (2)_dum12.jpg','f (3)_dum12.jpg','f (4)_dum12.jpg','g_ (1)_dum12.jpg','g_ (2)2_dum12.jpg','g_ (3)3_dum12.jpg','g_ (4)_dum12.jpg','g_ (5)_dum12.jpg','g_ (6)_dum12.jpg','g_ (7)2_dum12.jpg','h (1)_dum12.jpg','h (2)_dum12.jpg','h (3)_dum12.jpg','h (4)_dum12.jpg','h (5)_dum12.jpg']
  };
  function captionFor(f){
    if(f.startsWith('a ')) return 'Obývací pokoj s kuchyní';
    if(f.startsWith('b ')) return 'Dětský pokoj';
    if(f.startsWith('c ')) return 'Ložnice';
    if(f.startsWith('d ')) return 'Obývací pokoj s kuchyní (Podzemní byt)';
    if(f.startsWith('e ')) return 'Ložnice (Podzemní byt)';
    if(f.startsWith('f ')) return 'Ložnice';
    if(f.startsWith('g_')) return 'Obývací pokoj s kuchyní';
    if(f.startsWith('h ')) return 'Dětský pokoj';
    return f;
  }
  function getInteriorImages(id, name){
    var n=parseInt(id);
    var folder = [1,3,5,7].includes(n)?'domy-1-3-5-7':[2,4,6,8].includes(n)?'domy-2-4-6-8':n===9?'dum-9':n===10?'dum-10':n===11?'dum-11':'dum-12';
    var files = INTERIOR_FILES[folder]||[];
    var imgs = files.map(function(f){ return {url:BASE+'/images/gallery/'+folder+'/'+encodeURIComponent(f), caption:captionFor(f)}; });

    var KD = BASE+'/images/koupelny/dvojdum/';
    var KB = BASE+'/images/koupelny/bungalov/';
    var KP = BASE+'/images/koupelny/prizemni-byt/';

    if([1,3,5,7,9].includes(n)){
      var bathL=[
        {url:KD+'1-03_levy_dum/g1.jpg',caption:'Spodní koupelna'},
        {url:KD+'1-03_levy_dum/g2_2.jpg',caption:'Spodní koupelna'},
        {url:KD+'1-03_levy_dum/g3.jpg',caption:'Spodní koupelna'},
        {url:KD+'2-06_levy_dum/'+encodeURIComponent('h (1).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_levy_dum/'+encodeURIComponent('h (1)-2.jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_levy_dum/'+encodeURIComponent('h (2).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_levy_dum/'+encodeURIComponent('h (3).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_levy_dum/'+encodeURIComponent('h (4).jpg'),caption:'Vrchní koupelna'}
      ];
      imgs = imgs.concat(bathL);
      if(n===9) imgs = imgs.concat([
        {url:KP+'levy_dum/'+encodeURIComponent('j (1).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'levy_dum/'+encodeURIComponent('j (2).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'levy_dum/'+encodeURIComponent('j (3).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'levy_dum/'+encodeURIComponent('j (4).jpg'),caption:'Koupelna - přízemní byt'}
      ]);
    } else if([2,4,6,8,10].includes(n)){
      var bathR=[
        {url:KD+'1-03_pravy_dum/g1.jpg',caption:'Spodní koupelna'},
        {url:KD+'1-03_pravy_dum/g2_2.jpg',caption:'Spodní koupelna'},
        {url:KD+'1-03_pravy_dum/g3.jpg',caption:'Spodní koupelna'},
        {url:KD+'2-06_pravy_dum/'+encodeURIComponent('h (1).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_pravy_dum/'+encodeURIComponent('h (1)-2.jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_pravy_dum/'+encodeURIComponent('h (2).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_pravy_dum/'+encodeURIComponent('h (3).jpg'),caption:'Vrchní koupelna'},
        {url:KD+'2-06_pravy_dum/'+encodeURIComponent('h (4).jpg'),caption:'Vrchní koupelna'}
      ];
      imgs = imgs.concat(bathR);
      if(n===10) imgs = imgs.concat([
        {url:KP+'pravy_dum/'+encodeURIComponent('j (1).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'pravy_dum/'+encodeURIComponent('j (2).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'pravy_dum/'+encodeURIComponent('j (3).jpg'),caption:'Koupelna - přízemní byt'},
        {url:KP+'pravy_dum/'+encodeURIComponent('j (4).jpg'),caption:'Koupelna - přízemní byt'}
      ]);
    } else if(n===11){
      imgs = imgs.concat([
        {url:KB+'1-07_levy_dum/e1.jpg',caption:'Menší koupelna'},
        {url:KB+'1-07_levy_dum/e2.jpg',caption:'Menší koupelna'},
        {url:KB+'1-07_levy_dum/e3.jpg',caption:'Menší koupelna'},
        {url:KB+'1-11_levy_dum/'+encodeURIComponent('f (1).jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_levy_dum/'+encodeURIComponent('f (1)-2.jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_levy_dum/'+encodeURIComponent('f (2).jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_levy_dum/'+encodeURIComponent('f (2)-2.jpg'),caption:'Větší koupelna'}
      ]);
    } else if(n===12){
      imgs = imgs.concat([
        {url:KB+'1-07_pravy_dum/e1.jpg',caption:'Menší koupelna'},
        {url:KB+'1-07_pravy_dum/e2.jpg',caption:'Menší koupelna'},
        {url:KB+'1-07_pravy_dum/e3.jpg',caption:'Menší koupelna'},
        {url:KB+'1-11_pravy_dum/'+encodeURIComponent('f (1).jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_pravy_dum/'+encodeURIComponent('f (1)-2.jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_pravy_dum/'+encodeURIComponent('f (2).jpg'),caption:'Větší koupelna'},
        {url:KB+'1-11_pravy_dum/'+encodeURIComponent('f (2)-2.jpg'),caption:'Větší koupelna'}
      ]);
    }
    return imgs;
  }

  /* ── Helpers ──────────────────────────────── */
  function fmtPrice(p){ return new Intl.NumberFormat('cs-CZ',{maximumFractionDigits:0}).format(p)+' Kč'; }
  function e(tag,cls,html){ var el=document.createElement(tag); if(cls) el.className=cls; if(html!==undefined) el.innerHTML=html; return el; }

  /* ── State ────────────────────────────────── */
  var selectedId = '1';
  var lbImages = [];
  var lbIdx = 0;

  /* ── Lightbox ─────────────────────────────── */
  var lbEl   = document.getElementById('vd-lightbox');
  var lbImg  = document.getElementById('vd-lightbox-img');
  var lbCnt  = document.getElementById('vd-lb-counter');
  var lbCap  = document.getElementById('vd-lb-caption');
  var lbPrev = document.getElementById('vd-lb-prev');
  var lbNext = document.getElementById('vd-lb-next');

  function openLb(imgs, idx){
    lbImages = imgs; lbIdx = idx;
    updateLb();
    lbEl.classList.add('open');
    document.body.style.overflow='hidden';
  }
  function updateLb(){
    var img = lbImages[lbIdx];
    lbImg.src = img.url;
    lbImg.alt = img.caption||'';
    lbCnt.textContent = (lbIdx+1)+' / '+lbImages.length;
    lbCap.textContent = img.caption||'';
    lbPrev.style.display = lbIdx>0 ? '' : 'none';
    lbNext.style.display = lbIdx<lbImages.length-1 ? '' : 'none';
  }
  window.vdLbClose = function(){ lbEl.classList.remove('open'); document.body.style.overflow=''; };
  window.vdCloseLightbox = function(ev){ if(ev.target===lbEl) vdLbClose(); };
  window.vdLbNav = function(d){
    lbIdx = Math.max(0, Math.min(lbImages.length-1, lbIdx+d));
    updateLb();
  };
  document.addEventListener('keydown', function(e){
    if(!lbEl.classList.contains('open')) return;
    if(e.key==='Escape') vdLbClose();
    if(e.key==='ArrowLeft') vdLbNav(-1);
    if(e.key==='ArrowRight') vdLbNav(1);
  });

  /* ── Render ───────────────────────────────── */
  function render(){
    var house = HOUSES.find(function(h){return h.id===selectedId;});
    var views = getViews(selectedId);
    var fps   = getFloorplans(selectedId);
    var ints  = getInteriorImages(selectedId, house.name);

    /* Build combined lightbox images: views first, then floor plans */
    var lbAll = [];
    views.forEach(function(url,i){ lbAll.push({url:url, caption:house.name+' – Pohled '+(i+1)}); });
    fps.forEach(function(url,i){ lbAll.push({url:url, caption:house.name+' – Půdorys '+(i+1)}); });

    /* -- Views panel -- */
    var vp = document.getElementById('vd-views-panel');
    vp.innerHTML = '';
    if(views.length){
      var viewWrap = e('div','');
      views.forEach(function(src,i){
        var img = e('img','vd-view-img');
        img.src = src; img.alt = house.name+' pohled '+(i+1);
        img.onclick = function(){ openLb(lbAll, i); };
        if(i>0){ var sp=e('div','vd-view-spacer'); viewWrap.appendChild(sp); }
        viewWrap.appendChild(img);
      });
      vp.appendChild(viewWrap);
    } else {
      var ph = e('div','','<p style="color:#94a3b8;font-size:14px;padding:40px;text-align:center;">'+house.name+'</p>');
      vp.appendChild(ph);
    }

    /* -- Floor plans panel -- */
    var fp = document.getElementById('vd-fps-panel');
    fp.innerHTML = '';
    if(fps.length){
      fps.forEach(function(src,i){
        var img = e('img','vd-fp-img');
        img.src = src; img.alt = house.name+' půdorys '+(i+1);
        img.onclick = function(){ openLb(lbAll, views.length+i); };
        fp.appendChild(img);
      });
    } else {
      fp.innerHTML = '<p style="color:#94a3b8;font-size:14px;padding:40px;text-align:center;">Půdorys bude doplněn</p>';
    }

    /* -- Info panel -- */
    var ip = document.getElementById('vd-info-panel');
    var badgeCls = house.status==='Volný' ? 'vd-status-volny' : house.status==='Rezervováno' ? 'vd-status-rezervovano' : 'vd-status-prodano';
    var pdfUrl = BASE + house.pdf;
    var discountBadge = ['3','4','5'].includes(house.id) ? '<span class="vd-discount-badge">Zvýhodněná cena</span>' : '';
    ip.innerHTML =
      '<span class="vd-status-badge '+badgeCls+'">'+house.status+'</span>'+
      '<h2 class="vd-info-name"><img class="vd-herb-icon" src="'+BASE+'/images/byliny/'+house.herb+'.png" alt=""/> '+house.name+'</h2>'+
      '<p class="vd-info-desc">'+house.desc+'</p>'+
      '<a href="'+pdfUrl+'" target="_blank" rel="noopener" class="vd-pdf-btn">'+
        '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>'+
        'Karta domu (PDF)'+
      '</a>'+
      '<div class="vd-metrics">'+
        '<div class="vd-metric"><p class="vd-metric-label">Užitná plocha</p><p class="vd-metric-value">'+house.usable.toFixed(1)+' m²</p></div>'+
        '<div class="vd-metric"><p class="vd-metric-label">Plocha pozemku</p><p class="vd-metric-value">'+house.plot+' m²</p></div>'+
        '<div class="vd-metric"><p class="vd-metric-label">Pokoje</p><p class="vd-metric-value">'+house.rooms+'</p></div>'+
        '<div class="vd-metric"><p class="vd-metric-label">Koupelny</p><p class="vd-metric-value">'+house.baths+'</p></div>'+
        '<div class="vd-metric full"><p class="vd-metric-label">Prodejní cena</p><p class="vd-metric-value">'+fmtPrice(house.price)+'</p>'+discountBadge+'</div>'+
      '</div>';

    /* -- Interior gallery -- */
    var ig = document.getElementById('vd-interior-grid');
    ig.innerHTML = '';
    ints.forEach(function(img, i){
      var btn = e('button','vd-interior-thumb');
      var im  = e('img',''); im.src = img.url; im.alt = img.caption;
      btn.appendChild(im);
      btn.onclick = function(){ openLb(ints, i); };
      ig.appendChild(btn);
    });

    /* -- Update polygon selection -- */
    document.querySelectorAll('.lh-zone').forEach(function(p){
      p.classList.toggle('selected', p.getAttribute('data-id')===selectedId);
    });
  }

  /* ── Build table ──────────────────────────── */
  function buildTable(){
    var tbl = document.getElementById('vd-table');
    var thead = '<thead><tr>'+
      '<th>Dům</th><th>Plocha pozemku</th><th>Užitná plocha</th><th>Prodejní cena</th><th>Stav</th><th>Karta k domu</th>'+
      '</tr></thead>';
    var tbody = '<tbody>'+HOUSES.map(function(h){
      var dotCls = h.status==='Volný' ? 'vd-dot-volny' : h.status==='Rezervovaný' ? 'vd-dot-rezervovano' : 'vd-dot-prodano';
      var disc = ['3','4','5'].includes(h.id) ? '<span class="vd-discount-badge" style="display:block;margin-top:4px;">Zvýhodněná cena</span>' : '';
      return '<tr>'+
        '<td class="vd-table-name"><div class="vd-table-name-inner"><img class="vd-table-herb" src="'+BASE+'/images/byliny/'+h.herb+'.png" alt=""/> '+h.name+'</div></td>'+
        '<td>'+h.plot.toFixed(1)+' m²</td>'+
        '<td>'+h.usable.toFixed(1)+' m²</td>'+
        '<td>'+fmtPrice(h.price)+disc+'</td>'+
        '<td><span class="vd-status-dot '+dotCls+'"></span>'+h.status+'</td>'+
        '<td><a href="'+BASE+h.pdf+'" target="_blank" rel="noopener" class="vd-table-pdf-btn">Zobrazit</a></td>'+
      '</tr>';
    }).join('')+'</tbody>';
    tbl.innerHTML = thead+tbody;
  }

  /* ── Polygon click handlers ───────────────── */
  document.querySelectorAll('.lh-zone').forEach(function(poly){
    poly.addEventListener('click', function(){
      selectedId = this.getAttribute('data-id');
      render();
    });
  });

  /* ── Init ─────────────────────────────────── */
  buildTable();
  render();

})();
</script>

<?php get_footer(); ?>
