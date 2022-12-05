<?php
// Categories widget 
class category_list extends WP_Widget
{

    function __construct()
    {

        parent::__construct(
            'category_list',  // Base ID
            'Acf Category list'   // Name
        );

        add_action('widgets_init', function () {
            register_widget('category_list');
        });
    }

    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Categories', 'halim');
        // $title =  $instance['title']
?>
        <div class="categories">
            <?php echo $args['before_title']; ?><?php echo $title; ?><?php echo $args['after_title']; ?>
            <ul>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ));
                foreach ($categories as $category) : ?>
                    <li><a href="#"><?php echo $category->name; ?> <span class="fa fa-chevron-right"></span></a></li>

                <?php endforeach; ?>
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
$my_widget = new category_list();
