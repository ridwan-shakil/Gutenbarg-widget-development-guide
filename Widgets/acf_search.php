<?php

// Creating the widget
class acf_search extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'acf_search',

            // Widget name will appear in UI
            __('ACF Searcg', 'wpb_widget_domain'),

            // Widget description
            // array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'),)
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        $Title = apply_filters('widget_Title', $instance['Title']);
        if (!empty($Title)) {
            $show_Title =  $Title;
        } else {
            $show_Title = 'Type a keyword and hit enter';
        };

        echo $args['before_widget'];

        // This is where you run the code and display the output
?>
        <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
            <div class="form-group">
                <span class="fa fa-search"></span>
                <input type="text" class="form-control" placeholder="<?php echo $show_Title; ?>" value="<?php echo get_search_query() ?>" name="s">
            </div>
        </form>


    <?php
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['Title'])) {
            $placeholder = $instance['Title'];
        } else {
            // $Title = __('Type a keyword and hit enter', 'wpb_widget_domain');
            $placeholder = 'Type a keyword and hit enter';
        }
        // $Title = 'search';
        // Widget admin form
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('Title'); ?>"><?php _e('Placeholder:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('Title'); ?>" name="<?php echo $this->get_field_name('Title'); ?>" type="text" value="<?php echo $placeholder; ?>" placeholder="<?php echo $placeholder; ?>" />
        </p>
<?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['Title'] = (!empty($new_instance['Title'])) ? strip_tags($new_instance['Title']) : '';
        return $instance;
    }

    // Class wpb_widget ends here
}

// Register and load the widget
function acf_search_load_widget()
{
    register_widget('acf_search');
}
add_action('widgets_init', 'acf_search_load_widget');
