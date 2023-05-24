<?php
namespace DynamicElementorAddons\Widgets;
 
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * @since 1.1.0
 */
class DynamicPagePost extends Widget_Base {
 
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
    return 'dynamic-page-post';
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
    return __( 'Dynamic Page Post', 'dynamic-elementor-addons' );
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
    return 'eicon-posts-group';
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
      'additionalclass',
      [
        'label' => __( 'Additional Class', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
      ]
    );

    $this->add_control(
      'templatename',
      [
        'label' => __( 'Template Name', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'default-page-post', 'dynamic-elementor-addons' ),
      ]
    );

    $this->end_controls_section();

     $this->start_controls_section(
      'section_pagination',
      [
        'label' => __( 'Pagination', 'dynamic-elementor-addons' ),
      ]
    );

     $this->add_control(
      'arrowprevious',
      [
        'label' => __( 'Previous Text', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( '« Previous', 'dynamic-elementor-addons' ),
      ]
    );

    $this->add_control(
      'arrownext',
      [
        'label' => __( 'Next Text', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Next »', 'dynamic-elementor-addons' ),
      ]
    );

     $this->end_controls_section();


     $this->start_controls_section(
      'section_no_post_found',
      [
        'label' => __( 'No Post Found Text', 'dynamic-elementor-addons' ),
      ]
    );

      $this->add_control(
      'nofoundtext',
      [
        'label' => __( '', 'dynamic-elementor-addons' ),
        'type' => Controls_Manager::WYSIWYG,
        'default' => __( 'No Posts Found.', 'dynamic-elementor-addons' ),
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
    $this->add_inline_editing_attributes( 'arrowprevious', 'none' );
    $this->add_inline_editing_attributes( 'arrownext', 'none' );
    $this->add_inline_editing_attributes( 'additionalclass', 'none' );
    $this->add_inline_editing_attributes( 'nofoundtext', 'none' );

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

    if(!$settings['nofoundtext']){
      $settings['nofoundtext'] = 'No Posts Found.';
    }

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'paged'            => $paged,
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
      $settings['templatename'] = 'default-page-post';
    }

    $custom_query = new \WP_Query($args);


     echo '<div class="'. $settings['additionalclass'] .' blog-page-php ' . $settings['templatename'] . '-php">';
    if ( $custom_query->have_posts() ) :
      while ( $custom_query->have_posts() ) : $custom_query->the_post(); 

        $theme_file = DEA_THEME_DIR_PATH . $settings['templatename'] . '.php';
        $plugin_file = DEA_PLUGIN_DIR_PATH . $settings['templatename'] . '.php';
        if (file_exists($theme_file)) {
            include $theme_file;
        }else{
            if (file_exists($plugin_file)) {
                include $plugin_file;
            }else{
                wp_die('No file ('.$settings['templatename'].') found in both {theme-name}/cs-template and custom-shortcode/cs-template/');
            }
        }

      endwhile;

      wp_reset_postdata();

      echo '<div class="pagination-cs">';
         echo paginate_links( array(
              'total' => $custom_query->max_num_pages,
              'mid_size' => 2,
              'prev_text' => $settings['arrowprevious'],
              'next_text'  => $settings['arrownext']
        ));
     echo '</div>';

    else : ?>
      <?php echo '<div class="'. $settings['additionalclass'] .' blog-page-php ' . $settings['templatename'] . '-php">'; ?>
        <p class="no-found-text"><?php echo $settings['nofoundtext']; ?></p>
      </div>
    <?php 
    endif;
    echo '</div>';
    wp_reset_postdata();

    // if($postslist){
    //   echo '<div class="' . $settings['templatename'] . '-php">';
    //   foreach ($postslist as $key => $value) {
    //       $theme_file = DEA_THEME_DIR_PATH . $settings['templatename'] . '.php';
    //       $plugin_file = DEA_PLUGIN_DIR_PATH .  $settings['templatename'] . '.php';
    //       if (file_exists($theme_file)) {
    //           require $theme_file;
    //       }else{
    //           if (file_exists($plugin_file)) {
    //               require $plugin_file;
    //           }else{
    //               echo 'No file ('.$settings['templatename'].'.php) found in both {theme-name}/dae-templates and dynamic-elementor-addons/widgets/dae-templates/';
    //           }
    //       }
    //   }
    // }else{
    //   echo 'No Post Found';
    // }
    wp_reset_postdata();
  }

}