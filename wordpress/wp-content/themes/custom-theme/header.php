<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ProMan - Personal Portfolio HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo get_template_directory_uri(); ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top shadow py-lg-0 px-4 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="<?php echo home_url(); ?>" class="navbar-brand d-block d-lg-none">
          <h1 class="text-primary fw-bold m-0">Portfolio</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between py-4 py-lg-0" id="navbarCollapse">
                <?php
                    $menu_location = 'left_side_menu'; 
                    $locations = get_nav_menu_locations();
                    if (isset($locations[$menu_location])) {
                        $menu = wp_get_nav_menu_object($locations[$menu_location]);
                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                        if ($menu_items) {
                            echo '<div class="navbar-nav ms-auto py-0">';
                            $current_path = untrailingslashit(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                            foreach ($menu_items as $item) {
                                $menu_item_path = untrailingslashit(parse_url($item->url, PHP_URL_PATH));
                                $active_class = ($menu_item_path === $current_path) ? 'active' : '';
                                echo '<a class="nav-item nav-link ' . esc_attr($active_class) . '" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                            }
                            echo '</div>';
                        }
                    }
                   ?>
            <a href="<?php echo home_url(); ?>" class="navbar-brand bg-secondary py-3 px-4 mx-3 d-none d-lg-block">
                <h1 class="text-primary fw-bold m-0">Portfolio</h1>

            </a>
             <?php $menu_location = 'right_side_menu'; 
                    $locations = get_nav_menu_locations();
                    if (isset($locations[$menu_location])) {
                        $menu = wp_get_nav_menu_object($locations[$menu_location]);
                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                        if ($menu_items) {
                            echo '<div class="navbar-nav ms-auto py-0">';
                            $current_path = untrailingslashit(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                            foreach ($menu_items as $item) {
                                $menu_item_path = untrailingslashit(parse_url($item->url, PHP_URL_PATH));
                                $active_class = ($menu_item_path === $current_path) ? 'active' : '';
                                echo '<a class="nav-item nav-link' .esc_attr($active_class) . ' " href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                         }
                            echo '</div>';
                        }
             }
          ?>
        </div>
    </nav>
    <!-- Navbar End -->
