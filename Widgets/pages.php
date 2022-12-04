<?php

// ============= Pages list Widget ===============

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
