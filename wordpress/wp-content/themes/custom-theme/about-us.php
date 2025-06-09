<div class="container-xxl py-6" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex align-items-center mb-5">
                    <?php
                    $skills_experience = get_field('skills_experience');?>
                   
                    <div class="d-flex align-items-center mb-5">
                       <div class="years flex-shrink-0 text-center me-4">
                      <h1 class="display-1 mb-0"><?php echo $skills_experience; ?></h1>
                  <h5 class="mb-0">Years</h5>
            </div>
                <h3 class="lh-base mb-0">of working experience as a web developer & designer</h3>
           </div>
                    </div>
                    <p class="mb-4">Bringing <?php echo $skills_experience; ?> years of hands-on experience in web design and development—delivering creative, user-focused, and results-driven solutions.</p>
                    <p class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>Afordable Prices</p>
                    <p class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>High Quality Product</p>
                    <p class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>On Time Project Delivery</p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <img class="img-fluid rounded" src="<?php bloginfo('template_directory');?>/img/about-1.jpg" alt="">
                        </div>
                        <div class="col-sm-6">
                            <img class="img-fluid rounded" src="<?php bloginfo('template_directory');?>/img/about-2.jpg" alt="">
                        </div>
                    </div>
                    <?php
                    $happy_clients = get_field('happy_clients');?>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="border-end pe-3 me-3 mb-0">Happy Clients</h5>
                        <h2 class="text-primary fw-bold mb-0" data-toggle="counter-up"><?php echo $happy_clients;?></h2>
                    </div>
                    <p class="mb-4">We value our clients' satisfaction, delivering quality service with true dedication and care.</p>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="border-end pe-3 me-3 mb-0">Projects Completed</h5>
                        <h2 class="text-primary fw-bold mb-0" data-toggle="counter-up"><?php echo $happy_clients;?></h2>
                    </div>
                    <p class="mb-0">Successfully completed a wide range of projects with a focus on excellence, efficiency, and client goals.</p>
                </div>
            </div>
        </div>
    </div>