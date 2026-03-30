<?php
/**
 * Projektant projektu ZrobiM-ek - footer sekce
 * Meta Pixel tracking
 */

// ── Meta Pixel ────────────────────────────────────────────────────────────────
add_action('wp_head', function() { ?>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1438449094448731');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1438449094448731&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<?php }, 1);
add_action('wp_head', function() { ?>
<style>
#am-projektant-kontakt {
    padding: 40px 20px;
    background: #f7f8f5;
    border-top: 1px solid #e0e4d8;
}
#am-projektant-kontakt .am-pk-inner {
    max-width: 700px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 28px;
    flex-wrap: wrap;
}
#am-projektant-kontakt img { height: 50px; width: auto; }
#am-projektant-kontakt .am-pk-label {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #7a8a6a;
    margin-bottom: 4px;
    font-family: Montserrat, sans-serif;
}
#am-projektant-kontakt strong {
    display: block;
    font-size: 17px;
    color: #2a3320;
    font-family: Montserrat, sans-serif;
    margin-bottom: 2px;
}
#am-projektant-kontakt .am-pk-text {
    font-family: Montserrat, sans-serif;
    font-size: 14px;
    color: #556050;
    line-height: 1.8;
}
#am-projektant-kontakt a { color: #4a6640; text-decoration: none; }
#am-projektant-kontakt a:hover { text-decoration: underline; }
/* Skrýt starý tmavý bar a duplikáty */
#am-projektant-bar { display: none !important; }
#am-projektant-kontakt ~ #am-projektant-kontakt { display: none !important; }
</style>
<?php }, 999);

add_action('wp_footer', function() {
    $logo = esc_url(home_url('/wp-content/uploads/2026/03/zrobimek-logo-small.png'));
?>
<div id="am-projektant-kontakt">
    <div class="am-pk-inner">
        <img src="<?php echo $logo; ?>" alt="ZrobiM-ek s.r.o.">
        <div class="am-pk-text">
            <div class="am-pk-label">Projektant projektu</div>
            <strong>ZrobiM-ek s.r.o.</strong>
            <div>Veřovice 694, 742 73 Veřovice</div>
            <div>
                <a href="tel:+420774415177">+420 774 415 177</a>
                &nbsp;·&nbsp;
                <a href="mailto:kancelar@zrobimek.cz">kancelar@zrobimek.cz</a>
                &nbsp;·&nbsp;
                <a href="https://www.zrobimek.cz" target="_blank" rel="noopener">www.zrobimek.cz</a>
            </div>
        </div>
    </div>
</div>
<?php }, 20);
