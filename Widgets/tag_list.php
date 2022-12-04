<?php
// Creating all tags widget
class tag_list extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'tag_list',

            // Widget name will appear in UI
            __('ACF Tag List', 'wpb_widget_domain'),

            // Widget description
            // array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'),)
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
?>
        <div class="tagcloud">

            <?php
            $tags = get_tags();
            foreach ($tags as $tag) { ?>
                <a href="<?php echo get_tag_link($tag->term_id) ?>" class="tag-cloud-link"><?php echo $tag->name ?></a>
            <?php
            } ?>

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
            $title = __('Tag Cloud', 'wpb_widget_domain');
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
function acf_load_taglist_widget()
{
    register_widget('tag_list');
}
add_action('widgets_init', 'acf_load_taglist_widget');
