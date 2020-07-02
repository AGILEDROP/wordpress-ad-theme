<?php
if ( ! class_exists( 'Agiledrop_Widget' ) ) {
	class Agiledrop_Widget extends WP_Widget {
		public function __construct() {
			parent::__construct(
				'agiledrop_widget',
				'Agiledrop Widget',
				array( 'description' => __( 'Widget to display business locations', 'agiledrop' ) )
			);
		}

		public $args = array(
			'before_title'  => '<h4 class="widgettitle">',
			'after_title'   => '</h4>',
			'before_widget' => '<div class="widget-wrap">',
			'after_widget'  => '</div>'
		);

		public function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', $instance[ 'title' ] );
			$selected_posts = $instance[ 'selected_posts' ];

			$posts_list = explode(",", $selected_posts);

			echo $args['before_widget'];

			if( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			$helper = new Agiledrop_Helper();
			$posts = $helper->posts_by_category( 'Business Locations' );

			foreach ( $posts_list as $list ) {
			    foreach( $posts as $one ) {
				    if( $list === $one->post_title ) {
						echo "<div>
                                  <h4>". $one->post_title . "</h4>
                                   <p>" . $one->post_content . "</p>
                              </div>";
				    }
			    }
			}

			echo $args['after_widget'];
		}

		public function form( $instance ) {
			$title = isset( $instance['title'] ) ? $instance['title'] : 'Business Locations';
			$instance['selected_posts'] = ! empty( $instance['selected_posts'] ) ? explode(",",$instance['selected_posts'] ) : array();
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"value="<?php echo $title; ?>"/>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'selected_posts' ); ?>"><?php _e( 'Select Posts you want to show:' ); ?></label><br />
				<?php
					$helper = new Agiledrop_Helper();
					$posts = $helper->posts_by_category( 'Business Locations' );

					foreach ( $posts as $one ) {
						$checked = '';
						if ( in_array( $one->post_title, $instance['selected_posts' ] ) ){
							$checked = "checked='checked'";
						} ?>
						<input type="checkbox" id="<?php echo $this->get_field_id('selected_posts'); ?>" name="<?php echo $this->get_field_name('selected_posts[]'); ?>" value="<?php echo $one->post_title; ?>"  <?php echo $checked; ?>/>
						<label for="<?php echo $this->get_field_id('selected_posts' ); ?>"><?php echo $one->post_title; ?></label><br />
				<?php } ?>
			</p>

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
			$instance['selected_posts'] = ! empty( $new_instance['selected_posts'] ) ? implode(",",$new_instance['selected_posts'] ) : 0;
			return $instance;
		}
	}
}