<div class="container-fluid bg-light py-5 my-5" id="testimonial">
        <div class="container-fluid py-5">
            <h1 class="display-5 text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Testimonial</h1>
            <div class="row justify-content-center">
                <div class="col-lg-3 d-none d-lg-block">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">


                    <?php while(have_rows('testimonial')): the_row();
           $auther_image = get_sub_field('auther_image');
           $auther_desc =get_sub_field('description');
           $auther_name =get_sub_field('auther_name');
           $auther_role =get_sub_field('auther_role');
           ?>

         <div class="testimonial-item text-center">
                            <div class="position-relative mb-5">
                                <img class="img-fluid rounded-circle border border-secondary p-2 mx-auto" src="<?php echo esc_url($auther_image['url']); ?>" alt="<?php echo esc_attr($auther_image['alt']); ?>" alt="">
                                <div class="testimonial-icon">
                                    <i class="fa fa-quote-left text-primary"></i>
                                </div>
                            </div>
                            <div class="fs-5 fst-italic"><?php echo esc_html($auther_desc );?></div>
                            <hr class="w-25 mx-auto">
                            <h5><?php echo esc_html($auther_name);?></h5>
                            <span><?php echo esc_html($auther_role);?></span>
                        </div>
                <?php endwhile; ?>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                </div>
            </div>
        </div>
    </div>