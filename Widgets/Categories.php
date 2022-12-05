<?php

// ============= Categories ===============

class belfast_categories extends WP_Widget
{

    function __construct()
    {

        parent::__construct(
            'belfast_categories',  // Base ID
            'Categories Belfast'   // Name
        );

        add_action('widgets_init', function () {
            register_widget('belfast_categories');
        });
    }


    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Categories', 'halim');
        $order_by = $instance['order_by'];
        $order =  $instance['order'];
        // $title =  $instance['title']
?>

        <div class="sidebar-categories">
            <?php if (!empty($title))
                echo $args['before_title'] . $title . $args['after_title'];
            ?>
            <ul class="categories-list">
                <?php
                $categories = get_categories(array(
                    'orderby' => $order_by,
                    'order'   => $order
                ));
                foreach ($categories as $category) {
                ?>
                    <li><a href="#"><?php echo $category->name; ?><span>(<?php echo $category->count; ?>)</span></a></li>
                <?php
                }
                ?>

            </ul>
        </div>

    <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {

        $instance['title'] = !empty($instance['title']) ? $instance['title'] : __('Categories', 'halim');
        // $text = !empty($instance['text']) ? $instance['text'] : esc_html__('', 'text_domain');
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo __('Title:', 'halim'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo  $instance['title']; ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order_by')); ?>"><?php echo __('Order by:', 'halim'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('order_by')); ?>" id="<?php echo esc_attr($this->get_field_id('order_by')); ?>">
                <option value="name">Name</option>
                <option value="count">Number Of Posts</option>
            </select>
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
function categories_load_widget()
{
    register_widget('belfast_categories');
}
add_action('widgets_init', 'categories_load_widget');
