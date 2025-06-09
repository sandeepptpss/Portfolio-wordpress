<div class="container-xxl py-6 pt-5" id="project">
<div class="container">
    <div class="row g-5 mb-5 align-items-center wow fadeInUp" data-wow-delay="0.1s">
   <div class="col-lg-6">
       
<?php
  $project_heading = get_field('project_heading');?>
<h1 class="display-5 mb-0"><?php echo esc_html($project_heading); ?></h1>
                </div>
            </div>
    <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.1s">

    <?php while( have_rows('my_project') ): the_row(); 
      $image = get_sub_field('project_image');
      $product_link = get_sub_field('product_link');
        ?>
            <div class="col-lg-4 col-md-6 portfolio-item">
    <div class="portfolio-img rounded overflow-hidden">
         <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
         <div class="portfolio-btn">
                            <a class="btn btn-lg-square btn-outline-secondary border-2 mx-1" href="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a target="_blank" class="btn btn-lg-square btn-outline-secondary border-2 mx-1" href="<?php echo esc_url($product_link);?>"><i class="fa fa-link"></i></a>
                        </div>
                        </div>
</div>
        <?php endwhile; ?>
    </div>
    </div>
    </div>



