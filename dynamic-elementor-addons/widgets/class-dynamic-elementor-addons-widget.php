<?php
namespace DynamicElementorAddons;
 
/**
 * Class Plugin
 * Main Plugin class
 * @since 1.0.0
 */
class DynamicElementorAddonsWidget {
 
  /**
   * Instance
   *
   * @since 1.0.0
   * @access private
   * @static
   *
   * @var Plugin The single instance of the class.
   */
  private static $_instance = null;
 
  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded.
   *
   * @since 1.2.0
   * @access public
   *
   * @return Plugin An instance of the class.
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
           
    return self::$_instance;
  }
 
  /**
   * Register Widgets
   *
   * Register new Elementor widgets.
   *
   * @since 1.2.0
   * @access public
   */
  public function register_widgets() {

    require_once( __DIR__ . '/partials/dynamic-post.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\DynamicPost() );

    require_once( __DIR__ . '/partials/dynamic-page-post.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\DynamicPagePost() );
  }
 
  /**
   *  Plugin class constructor
   *
   * Register plugin action hooks and filters
   *
   * @since 1.2.0
   * @access public
   */
  public function __construct() {
 
    // Register widgets
    add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

    add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
  }

  public function add_elementor_widget_categories( $elements_manager ) {

  $elements_manager->add_category(
    'dynamic-addons',
    [
      'title' => __( 'Dynamic Addons', 'dynamic-elementor-addon' ),
      'icon' => 'fa fa-plug',
    ]
  );
}
}
 
// Instantiate Plugin Class
DynamicElementorAddonsWidget::instance();