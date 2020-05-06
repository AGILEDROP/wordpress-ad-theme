<?php
if ( ! class_exists( 'Agiledrop_Form' ) ) {
	class Agiledrop_Form {
		public function __construct() {
			add_action( 'wp_ajax_nopriv_agiledrop_save_form', array( $this, 'form_save' ) );
			add_action( 'wp_ajax_agiledrop_save_form', array( $this, 'form_save' ) );
			add_shortcode( 'agiledrop_contact_form', array( $this, 'contact_form' ) );
			add_shortcode( 'agiledrop_work_form', array( $this, 'work_form' ) );
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
			<form class="form" id="agiledrop-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<div class="form__group">
					<label class="form__required" for="name">Ime in Priimek</label>
					<input type="text" class="form__input" id="name" name="name" required>
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="email">E-naslov</label>
					<input type="email" class="form__input" id="email" name="email" required >
					<p id="email-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="email">Lokacija</label>
					<select class="form__select" id="cars" name="cars" required>
						<option value selected="selected">- Select -</option>
						<option value="MB">Maribor</option>
						<option value="LJ">Ljubljana</option>
						<option value="NM">Novo Mesto</option>
						<option value="CE">Celje</option>
					</select>
					<p id="email-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<strong>Status</strong><br>
					<label class="form__radio" for="zaposlen">
						<input type="radio" id="zaposlen" name="status" value="zaposlen">
						Zaposlen
						<span class="checkmark"></span>
					</label>
					<label class="form__radio" for="brezposeln">
						<input type="radio" id="brezposeln" name="status" value="brezposeln">
						Brezposeln
						<span class="checkmark"></span>
					</label>
					<label class="form__radio" for="student">
						<input type="radio" id="student" name="status" value="student">
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
				<button type="submit" class="form__button form__button-right">Pošlji</button>
			</form>
			<?php
			return ob_get_clean();
		}

		public function work_form( ) {
			ob_start();?>
			<form class="form" id="agiledrop-form" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
				<div class="form__group">
					<label class="form__required" for="name">Ime</label>
					<input type="text" class="form__input" id="name" name="name" required>
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="surname">Priimek</label>
					<input type="text" class="form__input" id="surname" name="surname" required>
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="email">E-naslov</label>
					<input type="email" class="form__input" id="email" name="email" required >
					<p id="email-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label for="cv">Življenjepis</label>
					<input type="file" class="form__input" id="cv" name="cv">
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label for="social">Spletna stran ali LinkedIn profil</label>
					<input type="text" class="form__input" id="social" name="social">
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="experience">Koliko izkušenj imaš kot razvijalec?</label>
					<input type="text" class="form__input" id="experience" name="experience" required>
					<p id="name-error" class="form__error"></p>
				</div>
				<div class="form__group">
					<label class="form__required" for="experience">Opiši Wordpress projekt na katerem si izdelal lastno temo ali razširitev</label>
					<textarea class="form__textarea" id="experience" name="experience" required></textarea>
					<p id="name-error" class="form__error"></p>
				</div>

				<div class="form__group">
					<label class="form__checkbox form__required" for="obdelava-podatkov">
						Strinjam se z obdelavo podatkov
						<input type="checkbox" id="obdelava-podatkov" name="obdelava-podatkov">
						<span class="checkmark"></span>
					</label>
					<small>
						Strinjam se z obdelavo mojih osebnih podatkov za namen morebitne zaposlitve na delovnem mestu, na katerega sem se prijavil. Posredovani osebni podatki se lahko vodijo v evidenci dejavnosti baze iskalcev zaposlitve, v okviru katere upravljavec osebnih podatkov le-te obdeluje z namenom izbire ustreznih in primernih kandidatov za zaposlitev. Osebni podatki se hranijo 3 mesece, nato se izbrišejo. Upravljavec osebnih podatkov je družba Agiledrop, d. o. o., Stegne 11A, 1000 Ljubljana. Seznanjen sem, da lahko soglasje kadarkoli prekličem. O preklicu soglasja bom obvestil neposredno upravljavca osebnih podatkov.
					</small>
				</div>

				<p id="form-status"></p>
				<button type="submit" class="form__button form__button-left">Prijavi se</button>
			</form>
			<?php
			return ob_get_clean();
		}

	}
}