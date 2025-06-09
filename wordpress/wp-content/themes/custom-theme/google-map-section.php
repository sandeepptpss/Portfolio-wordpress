<div class="container-xxl pt-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container-xxl pt-5 px-0">
            <div class="bg-dark">
            <?php 
$google_map = get_theme_mod('google_map');
if (!empty($google_map)) {
    echo $google_map; // Safe to echo since sanitized
}
?>
    </div>
        </div>
    </div>