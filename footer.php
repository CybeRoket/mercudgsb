<?php wp_footer();?>

<footer>
    <div class="footer-top container-fluid row align-items-center">
        <div class="company-details col">
            <img src="<?php echo get_template_directory_uri(); ?>/image/site-logo.svg" alt="<?php bloginfo('name'); ?>">
            <h6>headquarters</h6>
            <span>Unit L10-02, Level 10, KYM Tower 8, Jalan PJU7/6,47800 Mutiara Damansara, Petaling Jaya, Selangor</span>
        </div>
        <div class="subscribe col d-flex flex-column">
            <span>stay updated</span>
            <small>By signing up, you have agreed to our <a href="#">Terms & Conditions</a>, and have read and understood our <a href="#">Privacy Notice</a></small>
            <div class="input-group mt-3">
                <input type="email" class="form-control" placeholder="Your email here" aria-label="Your email here" aria-describedby="button-addon2">
                <button class="btn" type="button" id="button-addon2">
                    <!-- <i class="fal fa-arrow-right"></i> -->
                </button>
            </div>
        </div>
        <div class="social-footer col d-flex justify-content-end">
            <span>follow us</span>
                        
        </div>
    </div>
    <div class="footer-btm container-fluid row">
        <div class="copyright col d-flex align-items-center">
            <?php echo date('Y'); echo ' '; bloginfo('name'); ?> (<?php echo get_option( 'reg'); ?>). All Right Reserved.          
        </div>
        <?php
            wp_nav_menu( array(
                'theme_location'    => 'footer-menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'footer-menu col navbar navbar-expand-lg navbar-light d-flex justify-content-end',
                'container_id'      => '',
                'menu_class'        => 'footer-menu-ul navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ));
        ?>
    </div>
</footer>

</body>
</html>