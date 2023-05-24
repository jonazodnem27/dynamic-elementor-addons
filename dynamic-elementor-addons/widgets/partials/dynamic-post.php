<?php
namespace DynamicElementorAddons\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class DynamicPost extends Widget_Base {
 
  /**
   * Retrieve the widget name.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'dynamic-post';
  }
 
  /**
   * Retrieve the widget title.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __( 'Dynamic Post', 'dynamic-elementor-addons' );
  }
 
  /**
   * Retrieve the widget icon.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'eicon-post-list';
  }
 
  /**
   * Retrieve the list of categories the widget belongs to.
   *
   * Used to determine where to display the widget in the editor.
   *
   * Note that currently Elementor supports only one category.
   * When multiple categories passed, Elementor uses the first one.
   *
   * @since 1.1.0
   *
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'dynamic-addons' ];
  }
 
  /**
   * Register the widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function _register_controls() {
    $this->start_controls_section(
      'section_content',
      [
        'label' => __( 'Content', 'dynamic-elementor-addons' ),
      ]
    );

    $arguments = array(
     'public'   => true,
    );
    $post_types = get_post_types( $arguments );

    $this->add_control(
      'posttype',
      [
        'label' => __( 'Post Type', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'post', 'dynamic-elementor-addons' ),
        'options' => $post_types
      ]
    );

    $this->add_control(
      'postcount',
      [
        'label' => __( 'Post Count', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( '6', 'dynamic-elementor-addons' ),
      ]
    );

    $this->add_control(
      'postorder',
      [
        'label' => __( 'Post Order', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'DESC', 'dynamic-elementor-addons' ),
        'options' => ['DESC' => 'DESC', 'ASC' => 'ASC']
      ]
    );

    $this->add_control(
      'postorderby',
      [
        'label' => __( 'Post Order By', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'date', 'dynamic-elementor-addons' ),
      ]
    );

    $this->add_control(
      'postmetakey',
      [
        'label' => __( 'Post Meta Key', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '', 'dynamic-elementor-addons' ),
      ]
    );

    $this->add_control(
      'templatename',
      [
        'label' => __( 'Template Name', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'default-post', 'dynamic-elementor-addons' ),
      ]
    );

    $this->end_controls_section();
  }
 
  /**
   * Render the widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.1.0
   *
   * @access protected
   */
  protected function render() {
    $settings = $this->get_settings_for_display();

    $this->add_inline_editing_attributes( 'posttype', 'none' );
    $this->add_inline_editing_attributes( 'postcount', 'none' );
    $this->add_inline_editing_attributes( 'postorder', 'none' );
    $this->add_inline_editing_attributes( 'postorderby', 'none' );
    $this->add_inline_editing_attributes( 'postmetakey', 'none' );
    $this->add_inline_editing_attributes( 'templatename', 'none' );

    if(!$settings['posttype']){
      $settings['posttype'] = 6;
    }

    if(!$settings['posttype']){
      $settings['posttype'] = 'post';
    }

    if(!$settings['postorder']){
      $settings['postorder'] = 'DESC';
    }

    if(!$settings['postorderby']){
      $settings['postorderby'] = 'date';
    }

    $args = array(
        'post_type'  => $settings['posttype'],
        'posts_per_page'  => $settings['postcount'],
        'post_status'    => 'publish',
        'order'     => $settings['postorder'],
        'orderby'   => $settings['postorderby']
    );  

    if($settings['postmetakey']){
      $args['meta_key'] = $settings['postmetakey'];
      $args['orderby'] = 'meta_value';
    }

    if(!$settings['templatename']){
      $settings['templatename'] = 'default-post';
    }

    $postslist = get_posts( $args );
    if($postslist){
      echo '<div class="' . $settings['templatename'] . '-php">';
      foreach ($postslist as $key => $value) {
          $theme_file = DEA_THEME_DIR_PATH . $settings['templatename'] . '.php';
          $plugin_file = DEA_PLUGIN_DIR_PATH .  $settings['templatename'] . '.php';
          if (file_exists($theme_file)) {
              require $theme_file;
          }else{
              if (file_exists($plugin_file)) {
                  require $plugin_file;
              }else{
                  echo 'No file ('.$settings['templatename'].'.php) found in both {theme-name}/dae-templates and dynamic-elementor-addons/widgets/dae-templates/';
              }
          }
      }
    }else{
      echo 'No Post Found';
    }
    wp_reset_postdata();
  }

}