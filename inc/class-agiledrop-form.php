<?php
if ( ! class_exists( 'Agiledrop_Form' ) ) {
	class Agiledrop_Form {
		public function __construct() {
			add_action( 'wp_ajax_nopriv_agiledrop_save_form', array( $this, 'form_save' ) );
			add_action( 'wp_ajax_agiledrop_save_form', array( $this, 'form_save' ) );
			add_shortcode( 'agiledrop_contact_form', array( $this, 'contact_form' ) );
		}

		public function form_save( ) {
			$name = wp_strip_all_tags( $_POST['name'] );
			$company = wp_strip_all_tags( $_POST['company'] );
			$email = wp_strip_all_tags( $_POST['email'] );
			$subject = wp_strip_all_tags( $_POST['subject'] );
			$message = wp_strip_all_tags( $_POST['message'] );

			return $this->send_mail( $name, $company, $email, $subject, $message );

		}

		private function send_mail( $name, $company, $email, $subject, $message ) {
			$to = get_bloginfo( 'admin_email' );
			$headers[] = 'From: ' . $name . '-' . $company .' <' . $to . '>';
			$headers[] = 'Replay-to: ' . $name . ' <' . $email .'>';
			return wp_mail( $to, $subject, $message, $headers );
		}


		public function contact_form( ) {
			ob_start();?>
			<form id="agiledrop-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required>
					<p id="name-error"></p>
				</div>
				<div class="form-group">
					<label for="company">Company</label>
					<input type="text" class="form-control" placeholder="Your company" id="company" name="company" required>
					<p id="company-error"></p>
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required>
					<p id="subject-error"></p>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" placeholder="Your email" id="email" name="email" required >
					<p id="email-error"></p>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea class="form-control" placeholder="Your message" id="message" name="message" required></textarea>
					<p id="message-error"></p>
				</div>
				<p id="form-status"></p>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<?php
			return ob_get_clean();
		}

	}
}