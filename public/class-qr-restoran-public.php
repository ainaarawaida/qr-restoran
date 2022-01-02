<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://ainaaRawaida.com
 * @since      1.0.0
 *
 * @package    Qr_Restoran
 * @subpackage Qr_Restoran/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Qr_Restoran
 * @subpackage Qr_Restoran/public
 * @author     luqman <admin@ainaarawaida.com>
 */
class Qr_Restoran_Public {

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
		 * defined in Qr_Restoran_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qr_Restoran_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/qr-restoran-public.css', array(), $this->version, 'all' );

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
		 * defined in Qr_Restoran_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qr_Restoran_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/qr-restoran-public.js', array( 'jquery' ), $this->version, false );

	}


	public function luq_qrr_template_redirect(){
		global $wp ; 
		//deb( plugin_dir_url( __FILE__ ).'js/jquery.min.js');exit();
		if(isset($wp->query_vars['pagename']) && $wp->query_vars['pagename'] == 'generate-qr-code'){
			//include_once ABSPATH.'wp-content/plugins/qr-restoran/public/partials/generate-qr-code.php' ; 
			
		}else if(isset($wp->request) && $wp->request == 'shop'){

			if (!session_id()) {
				session_start();
			}
			if(!isset($_SESSION['setmejaid']) && !isset($_GET['setmejaid']) || (isset($_GET['setmejaid']) && $_GET['setmejaid'] == '')){
				//print_r("Maaf sayang. Sila akses menggunakan QR Code");exit();

			}
			if($_GET['setmejaid']){
				$_SESSION['setmejaid'] = preg_replace('/[^0-9]/', '', $_GET['setmejaid']);
			}
			
			//print_r($_SESSION['setmejaid']);exit();
			
		}else if(isset($wp->query_vars['pagename']) && $wp->query_vars['pagename'] == 'checkout'){
			if (!session_id()) {
				session_start();
			}

			
			if(isset($wp->query_vars['order-received'])){

					$tableid = get_post_meta( $wp->query_vars['order-received'], 'mejaid', true ) ;
					
			}else{
					$tableid = $_SESSION['setmejaid'] ;
			}

			?>
			<script src="<?php echo plugin_dir_url( __FILE__ ).'js/jquery.min.js' ; ?>"></script>
			<script>

				var tableid = <?php echo json_encode($tableid) ; ?> ;
				    $( window ).on( "load", function() {
						//$('div#customer_details div.woocommerce-billing-fields h3').html('Table ID: '+tableid);
						$('div#customer_details div.woocommerce-billing-fields h3').html('Order Details');
						$('div.woocommerce div.woocommerce-order section.woocommerce-order-details h2').html('Order details Table ID: '+tableid) ;
						$('.woocommerce-customer-details').hide();
    					});

			</script>


			<?php
			
			

			
		}
		// else if(1==1){
		// 	include_once ABSPATH.'wp-content/plugins/qr-restoran/public/partials/wp-login.php' ;
		// }
		
	}

	public function luq_qrr_template_include($ori_template = ''){
		global $wp ; 
		if(isset($wp->query_vars) && $wp->query_vars['pagename'] == 'generate-qr-code'){
			$ori_template = ABSPATH.'wp-content/plugins/qr-restoran/public/partials/generate-qr-code.php' ;

		}

		return $ori_template ;
		
	}

	
	public function luq_qrr_woocommerce_after_checkout_billing_form( $checkout ) { 
		if (!session_id()) {
			session_start();
		}
		$tableid = $_SESSION['setmejaid'] ;
		woocommerce_form_field( 'mejaid', array(        
			'type' => 'number',        
			'class' => array( 'form-row-wide' ),        
			'label' => 'Table ID',        
			'placeholder' => '',        
			'required' => true,        
			'default' => $tableid,        
		), $checkout->get_value( 'mejaid' ) ); 
	}

	public function luq_qrr_woocommerce_checkout_process(){
		if ( ! $_POST['mejaid'] ) {
			wc_add_notice( 'Sila masukkan Table Id / No Meja Anda', 'error' );
		 }
	
		
	}

	public function luq_qrr_woocommerce_checkout_update_order_meta($order_id){
		if ( $_POST['mejaid'] ) update_post_meta( $order_id, 'mejaid', esc_attr( $_POST['mejaid'] ) );
	}

	public function luq_qrr_login_form(){
			?>
			<style>
					div#login h1 a{
						background-image: none,url(<?php echo plugin_dir_url( __FILE__ ) ; ?>images/logo.jpg);
					}
			</style>
			<script src="<?php echo plugin_dir_url( __FILE__ ).'js/jquery.min.js' ; ?>"></script>
			<script>

				var tableid = <?php echo json_encode($tableid) ; ?> ;
				    $( window ).on( "load", function() {
						
    				});

			</script>


			<?php
		


	}



	public function luq_qrr_woocommerce_checkout_order_processed($order_id, $posted_data, $order) {
		$items = $order->get_items();
		
		foreach( $items as $product ) {
			$product_details[] = $product['name']."-----Qty: ".$product['qty'];
		}
		
		$post = get_post($order_id);
		if($post->post_excerpt)
			$product_details[] = "Order Notes: ".$post->post_excerpt ;
	
			$product_details[] = "No Meja: ".get_post_meta( $order_id, 'mejaid', true ) ;
			
	
			global $wpdb ; 
	
			$getdata = $wpdb->get_results( "SELECT option_value
			FROM $wpdb->options
			WHERE option_name = 'whatsapp-data'"
			);
		
			if($getdata){
				$mygetdata = unserialize($getdata[0]->option_value) ;
				$from = $mygetdata[0] ;
				$token = $mygetdata[1] ;
				unset($mygetdata[0]) ; 
				unset($mygetdata[1]) ; 
				foreach ($mygetdata AS $key => $val){
					$to = $val ;
					$text = implode("\n",$product_details)."\nMasa order: " .date("d/m/Y H:i:s")."\nDetail: ".home_url()."/checkout/order-received/".$order_id."/?key=".get_post_meta( $order_id, '_order_key', true ) ;
					$sendtext = base64_encode($text) ;
					file_get_contents('http://ws.msia-my.com/send-message_get?sender='.$from.'&number='.$to.'&token='.$token.'&message='.$sendtext); 

				}
				
			
			}
			
			
	
	
	
	}


	public function luq_qrr_woocommerce_email_after_order_table( $order, $sent_to_admin, $plain_text, $email ) {
		if ( get_post_meta( $order->get_id(), 'mejaid', true ) ) echo '<p><strong>Meja ID:</strong> ' . get_post_meta( $order->get_id(), 'mejaid', true ) . '</p>';
	}

	public function luq_qrr_woocommerce_order_data_after_billing_address( $order ) {    
		$order_id = $order->get_id();
		if ( get_post_meta( $order_id, 'mejaid', true ) ) echo '<p><strong>Meja ID:</strong> ' . get_post_meta( $order_id, 'mejaid', true ) . '</p>';
	}


	public function luq_qrr_order_dashboard() {

        global $wpdb;
        ob_start();
        include_once ABSPATH . "wp-content/plugins/qr-restoran/public/partials/luq_qrr_order_dashboard.php";
        $template = ob_get_contents();
        ob_end_clean();

        echo $template;
    }


	public function luq_qrr_wp_head(){
		global $wp ;
		 if(wp_get_current_user()->user_login === 'pengurus'){
			?>
			<style>
				#wp-admin-bar-wp-logo,
				#wp-admin-bar-customize,
				#wp-admin-bar-updates,
				#wp-admin-bar-comments,
				#wp-admin-bar-new-content,
				#wp-admin-bar-edit,
				#wp-admin-bar-elementor_edit_page,
				#wp-admin-bar-appearance{
					display:none;
				}
			</style>
			<?php

		 }
	}





}




