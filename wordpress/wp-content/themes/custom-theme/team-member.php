<div class="container-xxl py-6 pb-5" id="team">
        <div class="container">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-0">Team Members</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a class="btn btn-primary py-3 px-5" href="<?php echo home_url();?>">Contact Us</a>
                </div>
            </div>
            <div class="row g-4">
           <?php while( have_rows('team_members') ): the_row(); 
            $image = get_sub_field('team_image');
            $full_name = get_sub_field('full_name');
            $team_role = get_sub_field('team_role');
        ?>
      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="team-item position-relative">
            <?php if ($image): ?>
                <img class="img-fluid rounded" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endif; ?>
            <div class="team-text bg-white rounded-end p-4">
                <div>
                    <h5><?php echo esc_html($full_name); ?></h5>
                    <span><?php echo esc_html($team_role); ?></span>
                </div>
                <i class="fa fa-arrow-right fa-2x text-primary"></i>
            </div>
        </div>
    </div>
   <?php endwhile; ?>
</div>
</div>