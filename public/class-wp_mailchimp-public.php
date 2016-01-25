<?php

//register mailchimp
require_once plugin_dir_path(__FILE__) . '../vendor/autoload.php';

use \DrewM\MailChimp\MailChimp;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       nothingbutweb.com.au
 * @since      1.0.0
 *
 * @package    Wp_mailchimp
 * @subpackage Wp_mailchimp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_mailchimp
 * @subpackage Wp_mailchimp/public
 * @author     NBW <anonymous@nothingbutweb.com.au>
 */
class Wp_mailchimp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		function mailchimp_subscribe()
		{

			$MailChimp = new MailChimp('579b52d16c44f196d2656dfa9914fcee-us9');

			//d91e8f6c31
			$list_id = $_REQUEST['list_id'];
			$email_address = $_REQUEST['email_address'];

			$result = $MailChimp->post("lists/$list_id/members", [
				'email_address' => $email_address,
				'status' => 'subscribed'
			]);

			header('content-type:json');
			print_r(json_encode($result));

//            $result = $MailChimp->get('lists');
//
//            header('content-type:json');
//
//            print_r(json_encode($result));

			die;

		}

		add_action('wp_ajax_mailchimp_subscribe', 'mailchimp_subscribe');
		add_action('wp_ajax_nopriv_mailchimp_subscribe', 'mailchimp_subscribe');

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_mailchimp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_mailchimp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp_mailchimp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_mailchimp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_mailchimp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp_mailchimp-public.js', array( 'jquery' ), $this->version, false );

	}

}
