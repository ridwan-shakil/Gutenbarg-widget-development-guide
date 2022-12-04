<?php

// ============= Recent posts ===============

class recent_posts extends WP_Widget
{

    function __construct()
    {

        parent::__construct(
            'recent_posts',  // Base ID
            'Recent posts belfast'   // Name
        );

        add_action('widgets_init', function () {
            register_widget('recent_posts');
        });
    }


    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent posts', 'halim');
        // $title =  $instance['title']
?>


        <div class="sidebar-post">
            <?php if (!empty($title))
                echo $args['before_title'] . $title . $args['after_title'];
            ?>

            <?php
            $post_args = array(
                'post_type' => 'post',
                'posts_per_page' => $instance['number'],
                // 'order_by' => 'date',
                'order' => $instance['order']

            );

            $query = new WP_Query($post_args);

            ?>

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>

                    <div class="single-post">
                        <div class="img-box"><a href="post1.html">
                                <figure><img src="<?php echo get_the_post_thumbnail_url() ?>" alt=""></figure>
                            </a></div>
                        <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                        <div class="text"><?php echo get_the_date()  ?></div>
                    </div>


                <?php endwhile; ?>
            <?php endif; ?>

            <?php wp_reset_query(); ?>

        </div>


    <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {

        $instance['title'] = !empty($instance['title']) ? $instance['title'] : __('Recent posts', 'halim');
        // $text = !empty($instance['text']) ? $instance['text'] : esc_html__('', 'text_domain');
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo __('Title:', 'halim'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo  $instance['title']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo __('Number of post:', 'halim'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo  $instance['number']; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php echo __('Order:', 'halim'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('order')); ?>" id="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
            </select>
        </p>


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

// Register and load the widget
function recent_posts_load_widget()
{
    register_widget('recent_posts');
}
add_action('widgets_init', 'recent_posts_load_widget');
