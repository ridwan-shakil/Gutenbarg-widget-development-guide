<?php
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
    
    
 
