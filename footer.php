<?php
/**
* The template for displaying the footer
*
* @package kale
*/
?>        
        <?php get_sidebar('footer'); ?>
        
        <!-- Footer -->
        <div class="footer">
            
            <?php if ( is_active_sidebar( 'footer-row-3-center' ) ) { ?>
            <div class="footer-row-3-center"><?php dynamic_sidebar( 'footer-row-3-center' ); ?>
            <?php } ?>
            
            <?php $kale_footer_copyright = kale_get_option('kale_footer_copyright'); ?>
            <?php if($kale_footer_copyright) { ?>
            <div class="footer-copyright"><?php echo wp_kses($kale_footer_copyright, wp_kses_allowed_html('post')); ?></div>
            <div class="footer-copyright">
            <ul class="credit">
                <li><a href="https://www.lyrathemes.com/kale-pro"><?php _e('Kale - The Perfect Food Blog Theme', 'kale'); ?></a> <?php _e('by', 'kale'); ?> <a href="https://www.lyrathemes.com">LyraThemes</a>.</li>
            </ul>
            </div>
            <?php } ?>
            
        </div>
        <!-- /Footer -->
        
    </div><!-- /Container -->
</div><!-- /Main Wrapper -->

<?php wp_footer(); ?>
</body>
</html>
