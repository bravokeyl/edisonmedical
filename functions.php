<?php
require_once get_parent_theme_file_path('/mubit/bit.php');

remove_action( 'zaxu_nav_menu', 'zaxu_primary_menu' );
add_action( 'zaxu_nav_menu', 'zaxu_primary_menu', 11 );

add_action( 'edison_header_right', 'edison_header_right' );
function edison_header_right() {
  echo '<div class="header-right">';
  dynamic_sidebar( 'top-header' );
  echo '</div>';
}

remove_action( 'zaxu_header', 'zaxu_header' );
add_action( 'zaxu_header', 'edison_header' );
function edison_header() { ?>
  <header class="zaxu-site-header">
    <div class="wrap">
      <div class="site-title">
        <?php the_custom_logo(); ?>
        <?php if(!has_custom_logo() ) { ?>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php } ?>
      </div>
      <?php do_action( 'edison_header_right' );?>
    </div>
  </header>
  <div class="nav-menu-full">
    <div class="wrap">
      <?php do_action( 'zaxu_nav_menu' ); ?>
    </div>
  </div>
<?php }
/**
 * Enqueue Styles
 *
 * @since  1.0.0
 */
add_action( 'wp_enqueue_scripts', 'edison_enqueue_styles' );
function edison_enqueue_styles() {
  wp_enqueue_style( 'edison', get_theme_file_uri( '/mubit.css' ), null, '1.0.0' );
}

function edison_widgets() {
  register_sidebar( array(
    'name'          => __( 'Top Header', 'edison' ),
    'id'            => 'top-header',
    'description'   => __( 'Add widgets here to appear in your top header right.', 'edison' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Footer Menu', 'edison' ),
    'id'            => 'footer-menu',
    'description'   => __( 'Add widgets here to appear in your footer above widgets.', 'edison' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}
add_action( 'widgets_init', 'edison_widgets' );

remove_action( 'zaxu_footer', 'zaxu_footer' );
add_action( 'zaxu_footer', 'edison_footer' );
function edison_footer() { ?>
  <footer class="zaxu-site-footer">
    <div class="wrap">
      &copy;&nbsp;<?php echo date( 'Y' ); ?>
      <?php _e ( 'Edison Medical Associates, LLC. All rights reserved.', 'edison' );?>
      <a class="footer-credits" href="<?php echo esc_url( __( 'https://mu-bit.com/', 'edison' ) ); ?>"><?php printf( __( '%s', 'edison' ), '&#10084;' ); ?></a>
    </div>
  </footer>
<?php }

add_action( 'zaxu_before_footer', 'edison_footer_menu', 8 );
function edison_footer_menu() {?>
  <div class="footer-menu">
    <div class="wrap">
      <?php dynamic_sidebar( 'footer-menu' ); ?>
    </div>
  </div>
<?php }
