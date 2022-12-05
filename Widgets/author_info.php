<?php

// Creating the widget
class author_info extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'author_info',

            // Widget name will appear in UI
            __('Aurhor Info belfast', 'wpb_widget_domain'),

            // Widget description
            array('description' => __('widget of author info', 'wpb_widget_domain'),)
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        // if (!empty($title))
        //     echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        global $post;
        $author_id = $post->post_author;
        // acf fields 

        $widget_id =  'widget_' . $args['widget_id'];
        $social_links = get_field('social_links', $widget_id);
        $author_image = get_field('author_image', $widget_id);

?>
        <div class="sidebar-about centred">
            <div class="sidebar-title">ABOUT ME</div>
            <figure class="img-box"><img src="<?php echo $author_image; ?>" alt=""></figure>
            <!-- <?php echo get_avatar(get_the_author_meta('ID'), 120); ?> -->
            <h5 class="name"><?php echo get_the_author_meta('display_name', $author_id); ?></h5>
            <div class="text">
                <p><?php echo get_the_author_meta('description', $author_id); ?></p>
            </div>
            <ul class="social-link">


                <?php
                foreach ($social_links as $key) {
                ?>

                    <li>
                        <a href="<?php echo $key['link']; ?>">
                            <i class=" <?php echo $key['social_icon']; ?>"></i>
                        </a>
                    </li>
                <?php

                }
                ?>

            </ul>
        </div>





    <?php
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'wpb_widget_domain');
        }
        // Widget admin form
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
<?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    // Class wpb_widget ends here
}

// Register and load the widget
function author_info_load_widget()
{
    register_widget('author_info');
}
add_action('widgets_init', 'author_info_load_widget');
