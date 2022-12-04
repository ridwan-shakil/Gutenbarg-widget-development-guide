<?php
// Creating the widget
class acf_recent_posts extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

            // Base ID of your widget
            'acf_recent_posts',

            // Widget name will appear in UI
            __('ACF Recent Posts', 'acf_theme'),

            // Widget description
            array('description' => __('Sample widget of recent posts', 'acf_theme'),)
        );
    }

    // Creating widget front-end

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }



        echo 'hello-world=====================';
        $widget_id = $args['widget_id'];

        $textss = the_field('print_text', 'widget_' . $widget_id);
        echo $textss;
        echo 'hello-world=====================';



        // This is where you run the code and display the output
        $posts = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $query = new WP_Query($posts);
?>
        <?php if ($query->have_posts()) : ?>

            <?php while ($query->have_posts()) : $query->the_post(); ?>

                <div class="block-21 mb-4 d-flex">
                    <a class="blog-img mr-4" style="background-image: url(<?php the_post_thumbnail_url() ?>);"></a>
                    <div class="text">
                        <h3 class="heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="meta">
                            <div><a href="#"><span class="icon-calendar"></span><?php the_date() ?></a></div>
                            <div><a href="#"><span class="icon-person"></span> <?php the_author() ?></a></div>
                            <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>

        <?php endif; ?>

    <?php wp_reset_query();

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Recent Posts', 'acf_theme');
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
function wpb_load_widget()
{
    register_widget('acf_recent_posts');
}
add_action('widgets_init', 'wpb_load_widget');
