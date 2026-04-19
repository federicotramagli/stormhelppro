<?php 

/**
 * Registers the widget with the WordPress SLMP Gallery.
 * 
*/


add_action( 'widgets_init', 'slmp_custom_widget_gallery' );
function slmp_custom_widget_gallery() {
    register_widget( 'slmp_widget_gallery' );
}

class slmp_widget_gallery extends WP_Widget {
  
    function __construct() {
        parent::__construct(
          
        'slmp_widget_gallery',
          
        __('SLMP Widget Gallery', 'wpb_widget_domain'), 
          
        array( 'description' => __( 'Widget Use to Add Gallery in Sidebar. Get the Gallery ID in the gallery Post Type', 'wpb_widget_domain' ), ) 
        );
    }

    // Widget Frontend
    public function widget( $args, $instance ) {
        $widget_id              = $args['widget_id'];
        $widget_gallery_id      = get_field('widget_gallery_id', 'widget_' . $widget_id);
        $widget_gallery_button  = get_field('widget_gallery_button', 'widget_' . $widget_id);
        $widget_gallery_page    = get_field('widget_gallery_page', 'widget_' . $widget_id);
        $title                  = apply_filters( 'widget_title', $instance['title'] );
    ?>
        <?php
            echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }
        ?>
            <div class="slmp-widget-gallery slmp-relative">
                <div class="slmp-widget-item"><?php echo do_shortcode('[slmp_gallery id="'. $widget_gallery_id .'"]') ?></div>
                <?php if ( $widget_gallery_page ): ?>
                    <div class="slmp-widget-btn slmp-text-center slmp-relative">
                        <a href="<?php echo $widget_gallery_page ?>"><?php echo $widget_gallery_button ?></a>
                    </div>
                <?php endif ?>
            </div>
        <?php
            echo $args['after_widget'];
        ?>

    <?php }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
    ?>

        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>

    <?php }
          
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : 'SLMP Gallery';

        return $instance;
    }


}