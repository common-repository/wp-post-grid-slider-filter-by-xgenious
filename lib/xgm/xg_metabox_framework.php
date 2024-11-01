<?php

/*
 * register all metabox needed for xg product slider
 *
 * */

if (!class_exists('xgmf_metabox')){

	Class xgmf_metabox {
		/*
		 * set instance use this class
		 *
		 * */
		public $condition = array();
		public $condition_field = array();
		protected static $instance = null;
		public $options = array();

		/*
		 * set method instance use this class
		 *
		 * */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct( $options = array() ) {

			$this->options = apply_filters( 'xg_metabox_options', $options );
			add_action( 'admin_enqueue_scripts', array( $this, 'xgmf_metabox_assets' ) );

			if ( ! empty( $this->options ) ) {
				add_action( 'add_meta_boxes', array( $this, '_create_metabox' ) );
				add_action( 'save_post', array( $this, 'xgmf_metabox_save_data' ) );
			}

		}

		public function _create_metabox( $post_type ) {

			foreach ( $this->options as $value ) {

				add_meta_box( $value['id'], $value['title'], array(
					$this,
					'_metabox_display'
				), $value['post_type'], $value['context'], $value['priority'], $value );
			}
		}

		/*
		 * register all assets
		 * */
		public function xgmf_metabox_assets() {
			//all style for xg_metabox
			wp_enqueue_style( 'bootstrap-toggle', plugin_dir_url( __FILE__ ) . '/assets/css/bootstrap-toggle.css', null, '1.0.0' );
			wp_enqueue_style( 'select-2', plugin_dir_url( __FILE__ ) . '/assets/css/select2.css', null, '1.0.0' );
			wp_enqueue_style( 'fontawesome-iconpicker', plugin_dir_url( __FILE__ ) . '/assets/css/fontawesome-iconpicker.css', null, '5.0.0' );
			wp_enqueue_style( 'fontawesome', plugin_dir_url( __FILE__ ) . '/assets/css/font-awesome.css', null, '4.7.0' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'xgmf-metabox', plugin_dir_url( __FILE__ ) . '/assets/css/xgp-metabox.css', null, '1.0.0' );
			//
			wp_enqueue_script( 'bootstrap-toggle', plugin_dir_url( __FILE__ ) . '/assets/js/bootstrap-toggle.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'xg-select2', plugin_dir_url( __FILE__ ) . '/assets/js/select2.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'fapicker', plugin_dir_url( __FILE__ ) . '/assets/js/fontawesome-iconpicker.js', array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'xgp-metabox', plugin_dir_url( __FILE__ ) . '/assets/js/xgp_metabox.js', array(
				'jquery',
				'jquery-ui-core',
				'jquery-ui-tabs',
				'wp-color-picker',
				'jquery-ui-slider',
				'fapicker'
			), '1.0.0' );
		}

		/*
		 * get post object
		 * echo html for metabox
		 * */
		public function _metabox_display( $post, $callback ) {

			$unique_id  = $callback['args']['id'];
			$sections   = $callback['args']['sections'];
			$meta_value = get_post_meta( $post->ID, $unique_id, true );
			$has_nav    = ( count( $sections ) > 1 ) ? true : false;

			$metabox_markup = '<div class="xg-metabox-container">';
			$metabox_markup .= wp_nonce_field( 'xgp_metabox', 'xgp_metabox_nonce' );


			if ( $has_nav ) {
				$metabox_markup .= '<div class="xgp_metabox_tabs"><ul class="xgp-tab-nav">';
				foreach ( $sections as $section ) {
					$metabox_markup .= '<li><a href="#' . esc_attr( $section['name'] ) . '"> ' . esc_html( $section['title'] ) . ' </a></li>';
				}
				$metabox_markup .= '</ul>';
			}

			$metabox_markup .= '<div class="xgp-tab-container">';

			foreach ( $sections as $sect ) {
				$metabox_markup .= '<div id="' . esc_attr( $sect['name'] ) . '">';

				if ( isset( $sect['fields'] ) ) {
					foreach ( $sect['fields'] as $key ) {

						$get_type = $key['type'];
						if ( 'text' == $get_type ) {
							$metabox_markup .= $this->text( $key );
						} else if ( 'select' == $get_type ) {
							$metabox_markup .= $this->select( $key );
						} else if ( 'color_picker' == $get_type ) {
							$metabox_markup .= $this->color_picker( $key );
						} else if ( 'switcher' == $get_type ) {
							$metabox_markup .= $this->switcher( $key );
						} else if ( 'cat_select' == $get_type ) {
							$metabox_markup .= $this->cat_select( $key );
						} else if ( 'icon_picker' == $get_type ) {
							$metabox_markup .= $this->icon_picker( $key );
						}else if ( 'slider' == $get_type ) {
							$metabox_markup .= $this->slider( $key );
						}else if ( 'header_slider' == $get_type ) {
							$metabox_markup .= $this->header_slider( $key );
						}else if ( 'full_width_select' == $get_type ) {
							$metabox_markup .= $this->full_width_select( $key );
						}
					}
				}

				$metabox_markup .= '</div>';

			}

			if ( $has_nav ) {
				$metabox_markup .= '<div>';
			}


			$metabox_markup .= '<div>';

			echo $metabox_markup;
		}


		/*
		 * select
		 * render select field
		 * */
		public function select( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$attr['options']     = ( is_array( $attr['options'] ) && ! empty( $attr['options'] ) ) ? $attr['options'] : array();
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$attr['value']       = get_post_meta( $post->ID, $attr['id'], true );

			$output = '<div class="xgp-form-element"  >
						<label class="label" for="' . esc_attr( $attr['id'] ) . $attr['value'] . '">
							' . esc_html( $attr['title'] ) . '
							<span class="help-text">' . esc_html( $attr['description'] ) . '</span>
						</label>
						<select name="' . $attr['id'] . '" class="xgp-input-field" id="' . $attr['id'] . '" >';

			foreach ( $attr['options'] as $key => $value ) {
				$valuee  = ( isset( $attr['value'] ) && ! empty( $attr['value'] ) ) ? $attr['value'] : $attr['default'];
				$checked = ( $valuee == $key ) ? 'selected' : '';
				$output  .= '<option value="' . esc_attr( $key ) . '" ' . $checked . '>' . esc_html( $value ) . ' </option>';
			}

			$output .= '</select></div>';

			return $output;
		}

		public function cat_select( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$attr['taxonomy']    = ( $attr['taxonomy'] ) ? $attr['taxonomy'] : '';
			$attr['value']       = get_post_meta( $post->ID, $attr['id'], true );

			$output       = '<div class="xgp-form-element"  >
						<label class="label" for="' . esc_attr( $attr['id'] ) . '">
							' . esc_html( $attr['title'] ) . '
							<span class="help-text">' . esc_html( $attr['description'] ) . ' </span>
						</label>
						<select name="' . $attr['id'] . '[]" multiple="multiple" class="xgp-input-field xgp-select-2" id="' . $attr['id'] . '" >';
			$all_category = get_terms( $attr['taxonomy'] );

			foreach ( $all_category as $cat ) {
				$checked = is_array($attr['value']) && ( in_array( $cat->term_id, $attr['value'] ) ) ? 'selected' : '';
				$output  .= '<option value="' . esc_attr( $cat->term_id ) . '" ' . $checked . '>' . esc_html( $cat->name ) . ' </option>';
			}

			$output .= '</select></div>';

			return $output;
		}

		/*
		 * text field
		 * render text field
		 * */
		public function text( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$value               = get_post_meta( $post->ID, $attr['id'], true );
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$has_meta_data       = metadata_exists( 'post', $post->ID, $attr['id'] );
			$attr['value']       = $has_meta_data ? $value : $attr['default'];
			$output              = '<div class="xgp-form-element ">
						<label class="label" for="">' . esc_html( $attr['title'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<input type="text" name="' . esc_attr( $attr['id'] ) . '" id="' . esc_attr( $attr['id'] ) . '" class="xgp-input-field" value="' . $attr['value'] . '">
					</div>';
			return $output;
		}
		public function slider( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['unit']          = ( $attr['unit'] ) ? $attr['unit'] : 'px';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$value               = get_post_meta( $post->ID, $attr['id'], true );
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$has_meta_data       = metadata_exists( 'post', $post->ID, $attr['id'] );
			$attr['value']       = $has_meta_data ? $value : $attr['default'];
			$output              = '<div class="xgp-form-element slider-field">
						<label class="label" for="">' . esc_html( $attr['title'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<div class="right-content">
						<div class="xgp-ui-slider" data-value="' . $attr['value'] . '"></div>
						<input type="text" name="' . esc_attr( $attr['id'] ) . '" id="' . esc_attr( $attr['id'] ) . '" class="xgp-input-field" value="' . $attr['value'] . '">
						<span class="unit">'.esc_html($attr['unit']).'</span>
                        </div>
					</div>';
			return $output;
		}

		public function icon_picker( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$value               = get_post_meta( $post->ID, $attr['id'], true );
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$has_meta_data       = metadata_exists( 'post', $post->ID, $attr['id'] );
			$attr['value']       = $has_meta_data ? $value : $attr['default'];
			$output              = '<div class="xgp-form-element ">
						<label class="label" for="">' . esc_html( $attr['title'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<input type="text" name="' . esc_attr( $attr['id'] ) . '" id="' . esc_attr( $attr['id'] ) . '" class="xgp-input-field xgp-iconpicker" value="' . $attr['value'] . '">
					</div>';

			return $output;
		}

		/*
		 * color picker
		 * color picker field
		 * */
		public function color_picker( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$value               = get_post_meta( $post->ID, $attr['id'], true );
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$has_meta_data       = metadata_exists( 'post', $post->ID, $attr['id'] );
			$attr['value']       = $has_meta_data ? $value : $attr['default'];
			$output              = '<div class="xgp-form-element ">
						<label class="label" for="">' . esc_html( $attr['title'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<input type="text" name="' . esc_attr( $attr['id'] ) . '" id="' . esc_attr( $attr['id'] ) . '" class="xgp-input-field xgp_color_picker" value="' . $attr['value'] . '">
					</div>';

			return $output;
		}

		public function switcher( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$value               = get_post_meta( $post->ID, $attr['id'], true );

			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$has_meta_data       = metadata_exists( 'post', $post->ID, $attr['id'] );
			$attr['value'] = $has_meta_data ? $value : $attr['default'];
			$checked       = (  !empty($attr['value'])  ) ? 'checked' : '';
			$output        = '
								<div class="xgp-form-element ">
								<div class="label">
								<label>' . esc_html( $attr['title'] ) . '</label>
								<span class="help-text">' . esc_html( $attr['description'] ) . '</span>
								</div>
								<div class="xgp-toggl-wrapper">
								<div class="xgp-toggle ">
								<input type="checkbox" name="' . esc_attr( $attr['id'] ) . '" ' . $checked . '  id="' . esc_attr( $attr['id'] ) . '" >
								<label  for="' . esc_attr( $attr['id'] ) . '"> 
								<div class="xgp-card"></div>
								</label>
								</div></div></div>';

			return $output;
		}

		/*
		 * metabox save data
		 * @method
		 * */
		public function xgmf_metabox_save_data( $post_id ) {
			$validation = $this->_metabox_vaildation( 'xgp_metabox_nonce', 'xgp_metabox', $post_id );
			if ( $validation == false ) {
				return $post_id;
			}
			//have ad sanitization system
			foreach ( $this->options as $sections ) {
				if ( $sections['post_type'] == get_post_type( $post_id ) ) {
					foreach ( $sections['sections'] as $section ) {
						if ( isset( $section['fields'] ) ) {
							foreach ( $section['fields'] as $field ) {
								if ( 'cat_select' == $field['type'] ) {
									$sanitized_data = array();

									$data = (array) $_POST[ $field['id'] ];

									foreach ( $data as $key => $value ) {

										$sanitized_data[ $key ] = (int) strip_tags( stripslashes( $value ) );

									}

									update_post_meta( $post_id, $field['id'], $sanitized_data );
								} else {
									$value = isset( $_POST[ $field['id'] ] ) ? $_POST[ $field['id'] ] : '';
									update_post_meta( $post_id, $field['id'], sanitize_text_field( $value ) );
								}

							}

						}

					}
				}

			}

		}

		private function _metabox_vaildation( $nonce_field, $action, $post_id ) {
			$nonce = isset( $_POST[ $nonce_field ] ) ? $_POST[ $nonce_field ] : '';

			if ( $nonce == '' ) {
				return false;
			}
			if ( ! wp_verify_nonce( $nonce, $action ) ) {
				return false;
			}
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return false;
			}
			if ( wp_is_post_autosave( $post_id ) ) {
				return false;
			}

			if ( wp_is_post_revision( $post_id ) ) {
				return false;
			}

			return true;
		}



		/*
		 * select
		 * render select field
		 * */
		public function header_slider( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$attr['options']     = ( is_array( $attr['options'] ) && ! empty( $attr['options'] ) ) ? $attr['options'] : array();
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$attr['value']       = get_post_meta( $post->ID, $attr['id'], true );

			$output = '<div class="xgp-form-element"  >
						<label class="label" for="' . esc_attr( $attr['id'] ) . $attr['value'] . '">
							' . esc_html( $attr['title'] ) . '
							<span class="help-text">' . esc_html( $attr['description'] ) . '</span>
						</label>
						<select name="' . $attr['id'] . '" class="xgp-input-field" id="' . $attr['id'] . '" >';

			foreach ( $attr['options'] as $key => $value ) {
				$valuee  = ( isset( $attr['value'] ) && ! empty( $attr['value'] ) ) ? $attr['value'] : $attr['default'];
				$checked = ( $valuee == $key ) ? 'selected' : '';
				$output  .= '<option value="' . esc_attr( $key ) . '" ' . $checked . '>' . esc_html( $value ) . ' </option>';

			}
			$output  .= '<option disabled>'.esc_html__('Theme Three (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Four (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Five (Pro)','wp-post-layout').'  </option>
				<option disabled>'.esc_html__('Theme Six (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Seven (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Eight (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Nine (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Ten (Pro)','wp-post-layout').' </option>';

			$output .= '</select></div>';

			return $output;
		}
		/*
		 * select
		 * render select field
		 * */
		public function full_width_select( $attr = array() ) {
			global $post;
			$attr['title']       = ( $attr['title'] ) ? $attr['title'] : '';
			$attr['id']          = ( $attr['id'] ) ? $attr['id'] : '';
			$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
			$attr['options']     = ( is_array( $attr['options'] ) && ! empty( $attr['options'] ) ) ? $attr['options'] : array();
			$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
			$attr['value']       = get_post_meta( $post->ID, $attr['id'], true );

			$output = '<div class="xgp-form-element"  >
						<label class="label" for="' . esc_attr( $attr['id'] ) . $attr['value'] . '">
							' . esc_html( $attr['title'] ) . '
							<span class="help-text">' . esc_html( $attr['description'] ) . '</span>
						</label>
						<select name="' . $attr['id'] . '" class="xgp-input-field" id="' . $attr['id'] . '" >';

			foreach ( $attr['options'] as $key => $value ) {
				$valuee  = ( isset( $attr['value'] ) && ! empty( $attr['value'] ) ) ? $attr['value'] : $attr['default'];
				$checked = ( $valuee == $key ) ? 'selected' : '';
				$output  .= '<option value="' . esc_attr( $key ) . '" ' . $checked . '>' . esc_html( $value ) . ' </option>';

			}
			$output  .= '<option disabled>'.esc_html__('Theme Three (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Four (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Five (Pro)','wp-post-layout').'  </option>
				<option disabled>'.esc_html__('Theme Six (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Seven (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Eight (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Nine (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Ten (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Eleven (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Twelve (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Thirteen (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Fourteen (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Fifteen (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Sixteen (Pro)','wp-post-layout').' </option>
				<option disabled>'.esc_html__('Theme Seventeen (Pro)','wp-post-layout').' </option>';

			$output .= '</select></div>';

			return $output;
		}









	}//end class
}
if ( class_exists('xgmf_metabox') ){
	xgmf_metabox::instance();
}