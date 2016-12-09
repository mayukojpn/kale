<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package kale  
 *
 */
?>
<?php get_header(); ?>

<?php $kale_pages_sidebar = kale_get_option('kale_pages_sidebar'); ?>

<?php while ( have_posts() ) : the_post(); ?>
<!-- Two Columns -->
<div class="row two-columns">
    <!-- Main Column -->
    <div class="main-column col-md-8">
        
        <!-- Page Content -->
        <div id="error-404">
            <h1 class="entry-title">404</h1>
            <h3><?php _e('Page Not Found', 'kale'); ?></h3>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Main Column -->

    <?php get_sidebar();  ?>

</div>
<!-- /Two Columns -->

<?php endwhile; ?>
<hr />

<?php get_footer(); ?>