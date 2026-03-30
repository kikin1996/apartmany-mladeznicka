(function($) {
    'use strict';

    var APTS = {
        1:  { dispozice:'2+kk', plocha:'62,1 m²', sklep:'ano', parkovani:'ano', pozemek:'62 m²',  cena:'3 849 950 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/1.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%201.pdf', photos:['/wp-content/uploads/byty/byt1/IMG_3935.webp','/wp-content/uploads/byty/byt1/IMG_3936.webp','/wp-content/uploads/byty/byt1/IMG_3937.webp','/wp-content/uploads/byty/byt1/IMG_3938.webp','/wp-content/uploads/byty/byt1/IMG_3939.webp'] },
        2:  { dispozice:'2+kk', plocha:'77,2 m²', sklep:'ano', parkovani:'ano', pozemek:'95 m²',  cena:'4 830 900 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/2.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%202.pdf', photos:['/wp-content/uploads/byty/byt2/IMG_3816.webp','/wp-content/uploads/byty/byt2/IMG_3817.webp','/wp-content/uploads/byty/byt2/IMG_3818.webp','/wp-content/uploads/byty/byt2/IMG_3819.webp','/wp-content/uploads/byty/byt2/IMG_3820.webp','/wp-content/uploads/byty/byt2/IMG_3821.webp','/wp-content/uploads/byty/byt2/IMG_3822.webp','/wp-content/uploads/byty/byt2/IMG_3823.webp'] },
        3:  { dispozice:'3+kk', plocha:'78,0 m²', sklep:'ano', parkovani:'ano', pozemek:'247 m²', cena:'5 258 500 Kč', stav:'rezervováno', pudorys:'/wp-content/uploads/byty/pudorysy/3.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%203.pdf', photos:['/wp-content/uploads/byty/byt3/IMG_3959.webp','/wp-content/uploads/byty/byt3/IMG_3960.webp','/wp-content/uploads/byty/byt3/IMG_3961.webp','/wp-content/uploads/byty/byt3/IMG_3962.webp','/wp-content/uploads/byty/byt3/IMG_3963.webp','/wp-content/uploads/byty/byt3/IMG_3964.webp'] },
        4:  { dispozice:'3+kk', plocha:'79,8 m²', sklep:'ano', parkovani:'ano', pozemek:'82 m²',  cena:'4 953 100 Kč', stav:'rezervováno', pudorys:'/wp-content/uploads/byty/pudorysy/4.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%204.pdf', photos:['/wp-content/uploads/byty/byt4/IMG_3942.webp','/wp-content/uploads/byty/byt4/IMG_3943.webp','/wp-content/uploads/byty/byt4/IMG_3944.webp','/wp-content/uploads/byty/byt4/IMG_3945.webp','/wp-content/uploads/byty/byt4/IMG_3946.webp','/wp-content/uploads/byty/byt4/IMG_3947.webp','/wp-content/uploads/byty/byt4/IMG_3949.webp'] },
        5:  { dispozice:'2+kk', plocha:'69,7 m²', sklep:'ano', parkovani:'ano', pozemek:'97 m²',  cena:'4 389 650 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/5.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%205.pdf', photos:['/wp-content/uploads/byty/byt5/IMG_3825.webp','/wp-content/uploads/byty/byt5/IMG_3826.webp','/wp-content/uploads/byty/byt5/IMG_3827.webp','/wp-content/uploads/byty/byt5/IMG_3828.webp','/wp-content/uploads/byty/byt5/IMG_3831.webp','/wp-content/uploads/byty/byt5/IMG_3832.webp'] },
        6:  { dispozice:'3+kk', plocha:'75,7 m²', sklep:'ano', parkovani:'ano', pozemek:'418 m²', cena:'5 549 150 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/6.png?v=2', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%206.pdf', photos:['/wp-content/uploads/byty/byt6/IMG_3965.webp','/wp-content/uploads/byty/byt6/IMG_3966.webp','/wp-content/uploads/byty/byt6/IMG_3967.webp','/wp-content/uploads/byty/byt6/IMG_3968.webp','/wp-content/uploads/byty/byt6/IMG_3970.webp','/wp-content/uploads/byty/byt6/IMG_3972.webp','/wp-content/uploads/byty/byt6/IMG_3974.webp','/wp-content/uploads/byty/byt6/IMG_3975.webp'] },
        7:  { dispozice:'2+kk', plocha:'69,2 m²', sklep:'ano', parkovani:'ano', cena:'4 237 400 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/7.jpg',  pdf:'/wp-content/uploads/byty/karty/Mladeznicka%207.pdf',  photos:['/wp-content/uploads/byty/byt7/IMG_3700.webp','/wp-content/uploads/byty/byt7/IMG_3701.webp','/wp-content/uploads/byty/byt7/IMG_3702.webp','/wp-content/uploads/byty/byt7/IMG_3703.webp','/wp-content/uploads/byty/byt7/IMG_3705.webp','/wp-content/uploads/byty/byt7/IMG_3833.webp'] },
        8:  { dispozice:'3+kk', plocha:'76,9 m²', sklep:'ano', parkovani:'ano', cena:'4 695 550 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/8.jpg',  pdf:'/wp-content/uploads/byty/karty/Mladeznicka%208.pdf',  photos:['/wp-content/uploads/byty/byt8/IMG_3834.webp','/wp-content/uploads/byty/byt8/IMG_3835.webp','/wp-content/uploads/byty/byt8/IMG_3836.webp','/wp-content/uploads/byty/byt8/IMG_3837.webp','/wp-content/uploads/byty/byt8/IMG_3838.webp'] },
        9:  { dispozice:'2+kk', plocha:'57,9 m²', sklep:'ano', parkovani:'ano', cena:'3 565 050 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/9.jpg',  pdf:'/wp-content/uploads/byty/karty/Mladeznicka%209.pdf',  photos:['/wp-content/uploads/byty/byt9/IMG_3839.webp','/wp-content/uploads/byty/byt9/IMG_3840.webp','/wp-content/uploads/byty/byt9/IMG_3841.webp','/wp-content/uploads/byty/byt9/IMG_3842.webp','/wp-content/uploads/byty/byt9/IMG_3843.webp','/wp-content/uploads/byty/byt9/IMG_3844.webp','/wp-content/uploads/byty/byt9/IMG_3845.webp'] },
        10: { dispozice:'1+kk', plocha:'38,2 m²', sklep:'ano', parkovani:'ano', cena:'2 392 900 Kč', stav:'rezervováno', pudorys:'/wp-content/uploads/byty/pudorysy/10.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2010.pdf', photos:['/wp-content/uploads/byty/byt10/IMG_3846.webp','/wp-content/uploads/byty/byt10/IMG_3847.webp','/wp-content/uploads/byty/byt10/IMG_3848.webp','/wp-content/uploads/byty/byt10/IMG_3849.webp','/wp-content/uploads/byty/byt10/IMG_3850.webp','/wp-content/uploads/byty/byt10/IMG_3851.webp'] },
        11: { dispozice:'2+kk', plocha:'58,9 m²', sklep:'ano', parkovani:'ano', cena:'3 624 550 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/11.png', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2011.pdf', photos:['/wp-content/uploads/byty/byt11/IMG_3852.webp','/wp-content/uploads/byty/byt11/IMG_3853.webp','/wp-content/uploads/byty/byt11/IMG_3854.webp','/wp-content/uploads/byty/byt11/IMG_3855.webp','/wp-content/uploads/byty/byt11/IMG_3856.webp','/wp-content/uploads/byty/byt11/IMG_3857.webp'] },
        12: { dispozice:'3+kk', plocha:'79,8 m²', sklep:'ano', parkovani:'ano', cena:'4 868 100 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/12.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2012.pdf', photos:['/wp-content/uploads/byty/byt12/IMG_3858.webp','/wp-content/uploads/byty/byt12/IMG_3859.webp','/wp-content/uploads/byty/byt12/IMG_3860.webp','/wp-content/uploads/byty/byt12/IMG_3861.webp','/wp-content/uploads/byty/byt12/IMG_3862.webp','/wp-content/uploads/byty/byt12/IMG_3863.webp','/wp-content/uploads/byty/byt12/IMG_3864.webp','/wp-content/uploads/byty/byt12/IMG_3865.webp'] },
        13: { dispozice:'2+kk', plocha:'72,8 m²', sklep:'ano', parkovani:'ano', cena:'4 451 600 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/13.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2013.pdf', photos:['/wp-content/uploads/byty/byt13/IMG_3866.webp','/wp-content/uploads/byty/byt13/IMG_3867.webp','/wp-content/uploads/byty/byt13/IMG_3868.webp','/wp-content/uploads/byty/byt13/IMG_3869.webp','/wp-content/uploads/byty/byt13/IMG_3870.webp','/wp-content/uploads/byty/byt13/IMG_3871.webp','/wp-content/uploads/byty/byt13/IMG_3872.webp'] },
        14: { dispozice:'2+kk', plocha:'72,2 m²', sklep:'ano', parkovani:'ano', cena:'4 415 900 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/14.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2014.pdf', photos:['/wp-content/uploads/byty/byt14/IMG_3924.webp','/wp-content/uploads/byty/byt14/IMG_3925.webp','/wp-content/uploads/byty/byt14/IMG_3927.webp','/wp-content/uploads/byty/byt14/IMG_3928.webp','/wp-content/uploads/byty/byt14/IMG_3929.webp','/wp-content/uploads/byty/byt14/IMG_3931.webp','/wp-content/uploads/byty/byt14/IMG_3932.webp'] },
        15: { dispozice:'3+kk', plocha:'80,2 m²', sklep:'ano', parkovani:'ano', cena:'4 891 900 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/15.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2015.pdf', photos:['/wp-content/uploads/byty/byt15/IMG_3877.webp','/wp-content/uploads/byty/byt15/IMG_3878.webp','/wp-content/uploads/byty/byt15/IMG_3879.webp','/wp-content/uploads/byty/byt15/IMG_3880.webp','/wp-content/uploads/byty/byt15/IMG_3881.webp','/wp-content/uploads/byty/byt15/IMG_3882.webp','/wp-content/uploads/byty/byt15/IMG_3883.webp','/wp-content/uploads/byty/byt15/IMG_3884.webp'] },
        16: { dispozice:'2+kk', plocha:'61,4 m²', sklep:'ano', parkovani:'ano', cena:'3 773 300 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/16.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2016.pdf', photos:['/wp-content/uploads/byty/byt16/IMG_3885.webp','/wp-content/uploads/byty/byt16/IMG_3886.webp','/wp-content/uploads/byty/byt16/IMG_3887.webp','/wp-content/uploads/byty/byt16/IMG_3888.webp','/wp-content/uploads/byty/byt16/IMG_3889.webp','/wp-content/uploads/byty/byt16/IMG_3890.webp'] },
        17: { dispozice:'1+kk', plocha:'42,7 m²', sklep:'ano', parkovani:'ano', cena:'2 660 650 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/17.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2017.pdf', photos:['/wp-content/uploads/byty/byt17/IMG_3891.webp','/wp-content/uploads/byty/byt17/IMG_3892.webp','/wp-content/uploads/byty/byt17/IMG_3893.webp','/wp-content/uploads/byty/byt17/IMG_3894.webp','/wp-content/uploads/byty/byt17/IMG_3896.webp'] },
        18: { dispozice:'2+kk', plocha:'57,1 m²', sklep:'ano', parkovani:'ano', cena:'3 517 450 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/18.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2018.pdf', photos:['/wp-content/uploads/byty/byt18/IMG_3897.webp','/wp-content/uploads/byty/byt18/IMG_3898.webp','/wp-content/uploads/byty/byt18/IMG_3899.webp','/wp-content/uploads/byty/byt18/IMG_3900.webp','/wp-content/uploads/byty/byt18/IMG_3901.webp','/wp-content/uploads/byty/byt18/IMG_3902.webp'] },
        19: { dispozice:'3+kk', plocha:'77,9 m²', sklep:'ano', parkovani:'ano', cena:'4 755 050 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/19.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2019.pdf', photos:['/wp-content/uploads/byty/byt19/IMG_3903.webp','/wp-content/uploads/byty/byt19/IMG_3904.webp','/wp-content/uploads/byty/byt19/IMG_3905.webp','/wp-content/uploads/byty/byt19/IMG_3906.webp','/wp-content/uploads/byty/byt19/IMG_3907.webp','/wp-content/uploads/byty/byt19/IMG_3908.webp','/wp-content/uploads/byty/byt19/IMG_3910.webp','/wp-content/uploads/byty/byt19/IMG_3911.webp'] },
        20: { dispozice:'2+kk', plocha:'74,2 m²', sklep:'ano', parkovani:'ano', cena:'4 534 900 Kč', stav:'k dispozici', pudorys:'/wp-content/uploads/byty/pudorysy/20.jpg', pdf:'/wp-content/uploads/byty/karty/Mladeznicka%2020.pdf', photos:['/wp-content/uploads/byty/byt20/IMG_3917.webp','/wp-content/uploads/byty/byt20/IMG_3918.webp','/wp-content/uploads/byty/byt20/IMG_3919.webp','/wp-content/uploads/byty/byt20/IMG_3920.webp','/wp-content/uploads/byty/byt20/IMG_3922.webp','/wp-content/uploads/byty/byt20/IMG_3923.webp'] },
    };

    var currentIndex = 0;
    var currentPhotos = [];

    function buildInlineSection(hotspotWidget) {
        if ($('#byty-inline-section').length) return;

        var html = `
            <div id="byty-lb-overlay" style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.92);align-items:center;justify-content:center;cursor:zoom-out;">
              <button id="byty-lb-close" style="position:absolute;top:16px;right:20px;background:#363F2E;color:#fff;border:none;border-radius:50%;width:38px;height:38px;font-size:22px;cursor:pointer;z-index:2;display:flex;align-items:center;justify-content:center;">&#x2715;</button>
              <button id="byty-lb-prev" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);color:#fff;border:none;border-radius:50%;width:48px;height:48px;font-size:28px;cursor:pointer;display:none;">&#8249;</button>
              <img id="byty-lb-img" src="" style="max-width:94vw;max-height:92vh;object-fit:contain;border-radius:4px;display:block;">
              <button id="byty-lb-next" style="position:absolute;right:16px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);color:#fff;border:none;border-radius:50%;width:48px;height:48px;font-size:28px;cursor:pointer;display:none;">&#8250;</button>
            </div>
            <div id="byty-inline-section">
              <div id="byty-inline-pudorys">
                <div class="byty-col-label">Půdorys bytu</div>
                <div id="byty-pudorys-wrap" style="cursor:zoom-in;">
                  <img id="byty-pudorys-img" src="" alt="Půdorys">
                </div>
              </div>
              <div id="byty-inline-gallery">
                <div id="byty-gallery-main" style="cursor:zoom-in;">
                  <img id="byty-main-img" src="" alt="">
                  <button class="byty-gallery-nav" id="byty-nav-prev">&#8249;</button>
                  <button class="byty-gallery-nav" id="byty-nav-next">&#8250;</button>
                  <span id="byty-gallery-counter"></span>
                </div>
                <div id="byty-gallery-thumbs"></div>
                <div id="byty-gallery-dots"></div>
              </div>
              <div id="byty-inline-info">
                <div id="byty-info-badge">k dispozici</div>
                <div id="byty-info-title">Byt č. 1</div>
                <div id="byty-info-grid">
                  <div class="byty-info-item"><div class="label">Dispozice</div><div class="value" id="ii-dispozice">-</div></div>
                  <div class="byty-info-item"><div class="label">Celková plocha</div><div class="value" id="ii-plocha">-</div></div>
                  <div class="byty-info-item"><div class="label">Sklep</div><div class="value" id="ii-sklep">-</div></div>
                  <div class="byty-info-item"><div class="label">Parkovací stání</div><div class="value" id="ii-parkovani">-</div></div>
                  <div class="byty-info-item" id="ii-pozemek-wrap" style="display:none"><div class="label">Plocha pozemku</div><div class="value" id="ii-pozemek">-</div></div>
                  <div class="byty-info-item full-width"><div class="label">Cena s DPH</div><div class="value" id="ii-cena">-</div></div>
                </div>
                <a id="byty-info-pdf" href="#" target="_blank">&#128196; Karta bytu</a>
              </div>
            </div>`;

        hotspotWidget.closest('.elementor-widget-ucaddon_hotspot').closest('.e-con, .elementor-section').after(html);

        $('#byty-nav-prev').on('click', function(e) { e.stopPropagation(); showPhoto(currentIndex - 1); });
        $('#byty-nav-next').on('click', function(e) { e.stopPropagation(); showPhoto(currentIndex + 1); });

        // Lightbox pro foto a půdorys
        var lbPhotos = [], lbIdx = 0, lbPudorys = false;
        function lbOpen(photos, idx) {
            lbPhotos = photos; lbIdx = idx; lbPudorys = false;
            lbUpdate();
            $('#byty-lb-overlay').css('display','flex');
            $('body').css('overflow','hidden');
        }
        function lbOpenPudorys(src) {
            lbPhotos = [src]; lbIdx = 0; lbPudorys = true;
            lbUpdate();
            $('#byty-lb-overlay').css('display','flex');
            $('body').css('overflow','hidden');
        }
        function lbUpdate() {
            $('#byty-lb-img').attr('src', lbPhotos[lbIdx]);
            $('#byty-lb-prev').toggle(!lbPudorys && lbIdx > 0);
            $('#byty-lb-next').toggle(!lbPudorys && lbIdx < lbPhotos.length - 1);
        }
        function lbClose() {
            $('#byty-lb-overlay').css('display','none');
            $('#byty-lb-img').attr('src','');
            $('body').css('overflow','');
        }
        $('#byty-lb-close').on('click', lbClose);
        $('#byty-lb-overlay').on('click', function(e) { if (e.target === this) lbClose(); });
        $('#byty-lb-prev').on('click', function(e) { e.stopPropagation(); lbIdx--; lbUpdate(); });
        $('#byty-lb-next').on('click', function(e) { e.stopPropagation(); lbIdx++; lbUpdate(); });
        $(document).on('keydown.bytylb', function(e) {
            if ($('#byty-lb-overlay').css('display') === 'none') return;
            if (e.key === 'Escape') lbClose();
            if (e.key === 'ArrowLeft' && !lbPudorys)  { lbIdx = Math.max(0, lbIdx-1); lbUpdate(); }
            if (e.key === 'ArrowRight' && !lbPudorys) { lbIdx = Math.min(lbPhotos.length-1, lbIdx+1); lbUpdate(); }
        });
        $('#byty-gallery-main').on('click', function() {
            if (currentPhotos.length) lbOpen(currentPhotos, currentIndex);
        });
        $('#byty-pudorys-wrap').on('click', function() {
            var src = $('#byty-pudorys-img').attr('src');
            if (src) lbOpenPudorys(src);
        });

        // Klávesnice
        $(document).on('keydown', function(e) {
            if (e.key === 'ArrowLeft') showPhoto(currentIndex - 1);
            if (e.key === 'ArrowRight') showPhoto(currentIndex + 1);
        });

        // Swipe podpora pro dotykové displeje
        var touchStartX = 0;
        var touchStartY = 0;
        var mainEl = document.getElementById('byty-gallery-main');
        mainEl.addEventListener('touchstart', function(e) {
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
        }, { passive: true });
        mainEl.addEventListener('touchend', function(e) {
            var dx = e.changedTouches[0].clientX - touchStartX;
            var dy = e.changedTouches[0].clientY - touchStartY;
            if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 40) {
                showPhoto(dx < 0 ? currentIndex + 1 : currentIndex - 1);
            }
        }, { passive: true });
    }

    function showPhoto(idx) {
        if (!currentPhotos.length) return;
        currentIndex = (idx + currentPhotos.length) % currentPhotos.length;
        $('#byty-main-img').attr('src', currentPhotos[currentIndex]);
        $('#byty-gallery-counter').text((currentIndex + 1) + ' / ' + currentPhotos.length);
        // Thumbnails
        $('#byty-gallery-thumbs img').removeClass('active').eq(currentIndex).addClass('active');
        var thumb = $('#byty-gallery-thumbs img')[currentIndex];
        if (thumb) thumb.scrollIntoView({behavior:'smooth', inline:'center', block:'nearest'});
        // Dots
        $('#byty-gallery-dots .byty-dot').removeClass('active').eq(currentIndex).addClass('active');
    }

    function showApartment(num) {
        var apt = APTS[num];
        if (!apt) return;

        currentPhotos = apt.photos || [];
        currentIndex = 0;

        // Půdorys
        if (apt.pudorys) {
            $('#byty-pudorys-img').attr('src', apt.pudorys);
        }

        // Update active hotspot
        $('.ue_hotspot-item.spot').removeClass('byty-active');
        $('.ue_hotspot-item.spot').filter(function() {
            return parseInt($(this).text().trim()) === num;
        }).addClass('byty-active');

        // Fill info panel
        var stavText = apt.stav || 'k dispozici';
        var badge = $('#byty-info-badge').removeClass('obsazeno rezervovano');
        if (stavText.indexOf('obsaz') !== -1) badge.addClass('obsazeno');
        else if (stavText.indexOf('rezerv') !== -1) badge.addClass('rezervovano');
        badge.text(stavText);

        $('#byty-info-title').text('Byt č. ' + num);
        $('#ii-dispozice').text(apt.dispozice || '-');
        $('#ii-plocha').text(apt.plocha || '-');
        $('#ii-sklep').text(apt.sklep || '-');
        $('#ii-parkovani').text(apt.parkovani || '-');
        if (apt.pozemek) {
            $('#ii-pozemek').text(apt.pozemek);
            $('#ii-pozemek-wrap').show();
        } else {
            $('#ii-pozemek-wrap').hide();
        }
        $('#ii-cena').text(apt.cena || 'na vyžádání');

        if (apt.pdf) {
            $('#byty-info-pdf').attr('href', apt.pdf).removeClass('hidden');
        } else {
            $('#byty-info-pdf').addClass('hidden');
        }

        // Build thumbnails
        var thumbsHtml = '';
        currentPhotos.forEach(function(src, i) {
            thumbsHtml += '<img src="' + src + '" alt="foto ' + (i+1) + '" data-idx="' + i + '">';
        });
        $('#byty-gallery-thumbs').html(thumbsHtml);
        $('#byty-gallery-thumbs img').on('click', function() {
            showPhoto(parseInt($(this).data('idx')));
        });

        // Build dots (pro mobilní zobrazení)
        var dotsHtml = '';
        currentPhotos.forEach(function(_, i) {
            dotsHtml += '<span class="byty-dot" data-idx="' + i + '"></span>';
        });
        $('#byty-gallery-dots').html(dotsHtml);
        $('#byty-gallery-dots .byty-dot').on('click', function() {
            showPhoto(parseInt($(this).data('idx')));
        });

        showPhoto(0);
    }

    function getPageNums() {
        var nums = [];
        $('.ue_hotspot-item.spot').each(function() {
            var n = parseInt($(this).text().trim());
            if (!isNaN(n) && APTS[n]) nums.push(n);
        });
        return nums;
    }

    function init() {
        var hotspotWidget = $('.elementor-widget-ucaddon_hotspot');
        if (!hotspotWidget.length) return;

        buildInlineSection(hotspotWidget);

        // Kolečka se renderují asynchronně — zkus hned, pak s timeoutem
        var nums = getPageNums();
        if (nums.length) {
            showApartment(Math.min.apply(null, nums));
        } else {
            setTimeout(function() {
                var nums2 = getPageNums();
                showApartment(nums2.length ? Math.min.apply(null, nums2) : 1);
            }, 600);
        }

        // Click handler
        $(document).off('click.byty', '.ue_hotspot-item.spot');
        $(document).on('click.byty', '.ue_hotspot-item.spot', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var num = parseInt($(this).text().trim());
            if (!isNaN(num) && APTS[num]) {
                showApartment(num);
                // Smooth scroll to gallery
                var section = document.getElementById('byty-inline-section');
                if (section) section.scrollIntoView({behavior: 'smooth', block: 'start'});
            }
        });
    }

    $(document).ready(function() {
        init();
    });

})(jQuery);
