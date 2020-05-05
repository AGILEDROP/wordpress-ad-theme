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
			$email = wp_strip_all_tags( $_POST['email'] );
			$location = wp_strip_all_tags( $_POST['location'] );
			$status = "";
			if ( isset( $_POST['status'] ) ) {
			    $status = $_POST['status'];
            }
			$job = "Ne zanima me zaposlitev.";
			if ( $_POST['job'] === true) {
			    $job = "Zanima me zaposlitev.";
            }
			$data = 'Ne dovolim uporabo podatkov.';
			if ( $_POST['dataProcessing'] === true){
			    $data = 'Dovolim uporabo podatkov.';
            }
			$message = 'Lokacija: '.$location.' '.$status.' '.$job.' '.$data;

			return $this->send_mail( $name, $email, $message );

		}

		private function send_mail( $name, $email, $message ) {
		    $subject = "Prijava na tečaj";
			$to = get_bloginfo( 'admin_email' );
			$headers[] = 'From: ' . $name . '<' . $to . '>';
			$headers[] = 'Replay-to: ' . $name . ' <' . $email .'>';
			return wp_mail( $to, $subject, $message, $headers );
		}


		public function contact_form( ) {
			ob_start();?>
			<form class="form" id="agiledrop-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<div class="form__group">
					<label class="form__required" for="name">Ime in Priimek</label>
					<input type="text" class="form__input" id="name" name="name"  value="<?php echo $_POST['name'];?>" required>
					<p id="name-error" class="form__error">sdfsd</p>
				</div>
				<div class="form__group">
					<label class="form__required" for="email">E-naslov</label>
					<input type="email" class="form__input" id="email" name="email" value="<?php echo $_POST['email'];?>" required>
					<p id="email-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="location">Lokacija</label>
					<select class="form__select" id="location" name="location" required>
						<option value="MB">Maribor</option>
						<option value="LJ">Ljubljana</option>
						<option value="NM">Novo Mesto</option>
						<option value="CE">Celje</option>
					</select>
					<p id="location-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<strong>Status</strong><br>
					<label class="form__radio" for="zaposlen">
						<input type="radio" id="zaposlen" name="status" value="zaposlen" <?php if (isset($_POST['status']) && $_POST['status']=="zaposlen") echo "checked";?>>
						Zaposlen
						<span class="checkmark"></span>
					</label>
					<label class="form__radio" for="brezposeln">
						<input type="radio" id="brezposeln" name="status" value="brezposeln" <?php if (isset($_POST['status']) && $_POST['status']=="brezposeln") echo "checked";?>>
						Brezposeln
						<span class="checkmark"></span>
					</label>
					<label class="form__radio" for="student">
						<input type="radio" id="student" name="status" value="student" <?php if (isset($_POST['status']) && $_POST['status']=="student") echo "checked";?>>
						Študent
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="form__group">
					<label class="form__checkbox" for="zaposlitev">
						Zanima me zaposlitev v podjetju Agiledrop
						<input type="checkbox" id="zaposlitev" name="zaposlitev">
						<span class="checkmark"></span>
					</label>
					<label class="form__checkbox form__required" for="obdelava-podatkov">
						Strinjam se z obdelavo podatkov
						<input type="checkbox" id="obdelava-podatkov" name="obdelava-podatkov">
						<span class="checkmark"></span>
					</label>
				</div>
				<p id="form-status"></p>
				<button type="submit" class="form__button">Pošlji</button>
			</form>
			<?php
			return ob_get_clean();
		}

	}
}