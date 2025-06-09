<?php

   // echo get_template_directory_uri();
   //  bloginfo('template_directory');
   ?>


<?php
   /**
    * Template Name:Home page
    */
     get_header(); ?>

<!-- Header Start -->
<?php include 'banner.php' ?>
<!-- About Start -->
<?php include 'about-us.php'; ?>
<!-- About End -->


<!-- Expertise Start -->
<?php include 'skills-experience.php';?>
<!-- Expertise End -->
<!-- Service Start -->
<?php include 'services.php'?>
<!-- Service End -->
<!-- Projects Start -->
<?php include 'projects.php'?>
<!-- Projects End -->
<!-- Team Start -->
<?php include 'team-member.php'?>
<!-- Team End -->
<!-- Testimonial Start -->
<?php include 'testimonial.php'; ?>
<!-- Testimonial End -->
<!-- Contact Start -->
<?php include 'contact-us.php';?>
<!-- Contact End -->
<!-- Map Start -->
<?php include 'google-map-section.php';?>
<!-- Map End -->

<?php
   /**
    * Template Name:Home page
*/ get_footer(); ?>