<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	if ( defined( 'POLYLANG_VERSION' ) ) {

		add_action('init', 'yuna_polylang_strings' );

		function yuna_polylang_strings() {

			if( ! function_exists( 'pll_register_string' ) ) {
				return;
			}

			/**
			 * Footer
			 */

			pll_register_string(
				'yoursecret_footer_text',
				'YourSecret, developed and operated by Farnora Limited, uses cookies to  make the platform safer and smoother.  We don’t sell data. We protect  it.',
				'Footer',
				false
			);

			pll_register_string(
				'yoursecret_footer_menu_company_name',
				'Company',
				'Footer',
				false
			);

			pll_register_string(
				'yoursecret_footer_menu_trust_name',
				'Trust, Safety and Community',
				'Footer',
				false
			);

			pll_register_string(
				'yoursecret_footer_menu_information_name',
				'Legal Information',
				'Footer',
				false
			);

			pll_register_string(
				'yoursecret_footer_menu_support_name',
				'Support',
				'Footer',
				false
			);

			pll_register_string(
				'yoursecret_footer_download_title',
				'Download',
				'Footer',
				false
			);

			/**
			 * Form
			 */
			pll_register_string(
				'yoursecret_form_email_label',
				'Email or username',
				'Form',
				false
			);
			pll_register_string(
				'yoursecret_form_email_placeholder',
				'Enter your email',
				'Form',
				false
			);

			pll_register_string(
				'yoursecret_form_pass_label',
				'Password',
				'Form',
				false
			);

			pll_register_string(
				'yoursecret_form_forgot_pass_text',
				'Forgot your password?',
				'Form',
				false
			);

			pll_register_string(
				'yoursecret_form_btn_sing_in',
				'Sign in',
				'Form',
				false
			);

			pll_register_string(
				'yoursecret_form_btn_sing_in',
				'Sign in',
				'Form',
				false
			);

			pll_register_string(
				'yoursecret_form_btn_create',
				'Create new account',
				'Form',
				false
			);

			/**
			 * Text
			 */
			pll_register_string(
				'yoursecret_text_video_alert',
				'Your browser does not support the video tag',
				'Text',
				false
			);
		}
	}