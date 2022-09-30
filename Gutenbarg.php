<?php
//===============================================
// New Block and old Widgets
//===============================================
1) Gutenbarg supports both  " Blocks and Widgets "
2) Block widgets add more flexiblity 
3) Older widgets can be used from " Lagecy widgets " block
4)  Old widget screen can be used by installing "classic editor " plugin or adding below code
5)  Blocks can be developed by using " React or php "

// Removes Block widget screen and show old widget screen 
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );



//===============================================
// Register sidebar widgets 
//===============================================
function halim_theme_slug_widgets_init()
{
    // Right sidebar
    register_sidebar(array(
        'name'           => __('Right sidebar', 'textdomain'),
        'id'             => 'right-sidebar',
        'description'    => __('Widgets in this area will be shown on the right side', 'halim'),
        'before_widget'  => '<div class="single-sidebar">',
        'after_widget'   => '</div>',
        'before_title'   => '<h3>',
        'after_title'    => '</h3>',
    ));
    //   sidebar 1 
    register_sidebar(array(
        'name'          => __('Footer 1', 'textdomain'),
        'id'            => 'footer-1',
        'description'   => __('Widgets in this area will be shown on footer left side.', 'textdomain'),
        'before_widget' => '<div class="single-footer footer-logo">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

  
}
add_action('widgets_init', 'halim_theme_slug_widgets_init');

//===============================================
// Show widgets in frontend
//===============================================
  <?php if (is_active_sidebar('footer-2')) : ?>
          <?php dynamic_sidebar('footer-2'); ?>
    <?php endif; ?> 
    
    
 <?php

// ================================================
// Pages list Widget ========= 
// ================================================

class page_list extends WP_Widget
{

    function __construct()
    {

        parent::__construct(
            'page_list',  // Base ID
            'Page List ACF'   // Name
        );

        add_action('widgets_init', function () {
            register_widget('page_list');
        });
    }

    public $args = array(
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="single-sidebar">',
        'after_widget'  => '</div>'
    );

    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent posts', 'halim');
        // $title =  $instance['title']
?>
        <h4><?php echo $title; ?></h4>
        <ul>
            <?php wp_list_pages('sort_column=menu_order&title_li='); ?>
        </ul>
    <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {

        $instance['title'] = !empty($instance['title']) ? $instance['title'] : __('Pages', 'halim');
        // $text = !empty($instance['text']) ? $instance['text'] : esc_html__('', 'text_domain');
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo __('Title:', 'halim'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo  $instance['title']; ?>">
        </p>

        <!-- <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo __('Number of post:', 'halim'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo  $instance['number']; ?>">
        </p> -->


<?php

    }

    // public function update($new_instance, $old_instance)
    // {

    //     $instance = array();

    //     $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    //     $instance['text'] = (!empty($new_instance['text'])) ? $new_instance['text'] : '';

    //     return $instance;
    // }
}
$my_widget = new page_list();


----------------------------------------------------------------------


