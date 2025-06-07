<?php
$image    = get_theme_mod('custom_image_setting');
$nametitle  = get_theme_mod('custom_text_setting');
$link     = get_theme_mod('custom_link_setting');
$textarea = get_theme_mod('custom_textarea_setting');
?>
<div class="container-fluid bg-light my-6 mt-0" id="home">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 py-6 pb-0 pt-lg-0">
                    <h3 class="text-primary mb-3">I'm</h3>
                    <h1 class="display-3 mb-3"><?php echo esc_html($nametitle ); ?></h1>
                    <h2 class="typed-text-output d-inline"></h2>
                    <div class="typed-text d-none"> <?php echo esc_html($textarea); ?></div>
                    <div class="d-flex align-items-center pt-5">
                      <a   target="_blank" href="<?php echo esc_url($link); ?>" class="btn btn-primary py-3 px-4 me-5">Download CV</a>
                    </div>
                </div>
                <?php if ($image):?>
                <div class="col-lg-6">
                <img class="img-fluid" src="<?php echo esc_url($image); ?>" alt="">

                </div>
                <?php endif;?>
            </div>
        </div>
    </div>