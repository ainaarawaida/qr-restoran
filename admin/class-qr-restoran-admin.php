<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://ainaaRawaida.com
 * @since      1.0.0
 *
 * @package    Qr_Restoran
 * @subpackage Qr_Restoran/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qr_Restoran
 * @subpackage Qr_Restoran/admin
 * @author     luqman <admin@ainaarawaida.com>
 */
class Qr_Restoran_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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
		$screen = get_current_screen();
		// deb($screen);exit();
		if($screen && $screen->id === 'restoran-management_page_luq_qrr-lib-table-lists'){
			wp_enqueue_style( $this->plugin_name, 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, 'https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css', array(), $this->version, 'all' );

			?>
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
			<?php

		}elseif($screen && ($screen->id === 'restoran-management_page_luq_qrr-lib-manage-generate-qr-code' || $screen->id === 'restoran-management_page_luq_qrr-lib-manage-whatsapp')){
			?>
			<link rel="stylesheet" href="<?php echo plugins_url().'/qr-restoran/public/css/bootstrap.min.css' ; ?>"> 
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
			<?php
		}
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/qr-restoran-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		 $screen = get_current_screen();
		 if($screen && $screen->id === 'restoran-management_page_luq_qrr-lib-table-lists'){
			 ?>
			<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
			<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" ></script>
			<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" ></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
			 <?php
		 }
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/qr-restoran-admin.js', array( 'jquery' ), $this->version, false );



	}

	public function luq_qrr_include_template_file($template, $lib_params = array()) {

        ob_start();
        $params = $lib_params;
        include_once ABSPATH.'wp-content/plugins/qr-restoran/admin/partials/'. $template .'.php' ; 
        $template = ob_get_contents();
        ob_end_clean();

        echo $template;
    }

	public function luq_qrr_admin_menus(){
		//global $menu, $submenu;
		if(wp_get_current_user()->user_login === 'pengurus'){
			?>
			<style>
				#menu-dashboard, #menu-posts, #toplevel_page_metform-menu,
				#menu-media, #menu-pages, #menu-comments,
				#toplevel_page_wc-admin-path--analytics-overview,
				#toplevel_page_woocommerce,
				#menu-posts-product,#toplevel_page_woocommerce-marketing,
				#toplevel_page_elementor,#menu-posts-elementor_library,#menu-appearance,
				#menu-plugins, #menu-users,
				#menu-tools,#toplevel_page_jkit-settings, #toplevel_page_ai1wm_export, 
				#menu-settings, #wp-admin-bar-updates,
				#wp-admin-bar-wp-logo, #wp-admin-bar-comments,
				#wp-admin-bar-new-content,
				#metform-unsupported-metform-pro-version,
				#footer-left,
				#footer-upgrade,
				#activity-panel-tab-inbox,
				#activity-panel-tab-setup,
				#contextual-help-link-wrap,
				div#wpbody-content div.update-nag.notice.notice-warning.inline {
					display:none;
				}
			</style>
			<!-- <script src="<?php echo plugins_url().'/qr-restoran/public/js/jquery.min.js' ; ?>"></script>
			<script>
				    $( window ).on( "load", function() {
							// var newmenu = $('#toplevel_page_luq_qrr-lib-manage').clone();
							// $('#adminmenuwrap').append('<ul>');
							
    				});

			</script> -->

			<?php
			
		}

		add_menu_page("Restoran Management", "Restoran Management", "manage_options", "luq_qrr-lib-manage", array($this, "luq_qrr_management_dashbaord"), "dashicons-book-alt", 58);
        add_submenu_page("luq_qrr-lib-manage", "Dashboard", "Dashboard", "manage_options", "luq_qrr-lib-manage", array($this, "luq_qrr_management_dashbaord"));
		add_submenu_page("luq_qrr-lib-manage", "Generate QR Code", "Generate QR Code", "manage_options", "luq_qrr-lib-manage-generate-qr-code", array($this, "luq_qrr_generate_qr_code"));
		add_submenu_page("luq_qrr-lib-manage", "Whatsapp Setup", "Whatsapp Setup", "manage_options", "luq_qrr-lib-manage-whatsapp", array($this, "luq_qrr_manage_whatsapp"));
		add_submenu_page("luq_qrr-lib-manage", "Table Lists", "Table Lists", "manage_options", "luq_qrr-lib-table-lists", array($this, "luq_qrr_table_lists"));
		add_submenu_page("luq_qrr-lib-manage", "Product Lists", "Product Lists", "manage_options", "edit.php?post_type=product");
		add_submenu_page("luq_qrr-lib-manage", "Orders", "Orders", "manage_options", "edit.php?post_type=shop_order");
		add_submenu_page("luq_qrr-lib-manage", "Test", "Test", "manage_options", "luq_qrr-lib-manage-test", array($this, "luq_qrr_manage_test"));
		
		add_menu_page("Dashboard Order ", "Dashboard Order", "manage_options", home_url('order-dashboard') , "" , "dashicons-welcome-write-blog", 58);
        
		http://restoran.test/order-dashboard/

	}

	public function luq_qrr_manage_test(){
		$this->luq_qrr_include_template_file("manage_test");
	}

	public function luq_qrr_table_lists(){
		$this->luq_qrr_include_template_file("table_lists");
	}

	public function luq_qrr_management_dashbaord(){
		global $wpdb;
        $issued_to_staffs = $wpdb->get_var(
                $wpdb->prepare(
                        "SELECT * FROM wp_posts"
                )
        );

        $this->luq_qrr_include_template_file("management_dashbaord");
    
	}

	public function luq_qrr_generate_qr_code(){
		global $wpdb;
        $issued_to_staffs = $wpdb->get_var(
                $wpdb->prepare(
                        "SELECT * FROM wp_posts"
                )
        );

        $this->luq_qrr_include_template_file("generate_qr_code");
    
	}

	public function luq_qrr_manage_whatsapp(){
		global $wpdb;
        $issued_to_staffs = $wpdb->get_var(
                $wpdb->prepare(
                        "SELECT * FROM wp_posts"
                )
        );

        $this->luq_qrr_include_template_file("manage_whatsapp");
    
	}


	public function luq_qrr_woocommerce_admin_order_data_after_billing_address( $order ) {    
		$order_id = $order->get_id();
		if ( get_post_meta( $order_id, 'mejaid', true ) ) echo '<p><strong>Meja ID:</strong> ' . get_post_meta( $order_id, 'mejaid', true ) . '</p>';
	 }

	public function luq_qrr_login_redirect($redirect_to, $request, $user) {
		 //deb($redirect_to);exit();
		if($user->user_login === 'pengurus'){
			return '/wp-admin/admin.php?page=luq_qrr-lib-manage';
		}else{
			$redirect_to ;
		}
	
	}

	public function luq_qrr_current_screen(){
		$screen = get_current_screen();
		//deb($screen);exit();
		if ( isset( $screen->id ) && $screen->id == 'dashboard' ) {
			wp_redirect( admin_url( 'admin.php?page=luq_qrr-lib-manage' ) );
			exit();
		}elseif(isset( $screen->id ) && in_array($screen->id, array('edit-product','edit-shop_order'))){
			?>

			<style>
				#activity-panel-tab-inbox,
				#activity-panel-tab-setup,
				#contextual-help-link-wrap {
					display:none;
				}
			</style>
			<?php

		}

	}

	public function luq_qrr_tablelist_process(){
		global $wpdb ; 
		$getdata = $wpdb->get_results( "SELECT ID, post_title, post_content, post_status
		FROM $wpdb->posts
		WHERE post_type = 'no_meja'"
		);
		$data = array() ; 
		foreach($getdata AS $key => $val){
			$data[] = array(
				'0'=> $val->post_title, 
				'1'=> $val->post_content, 
				'2'=> $val->post_status, 
				'3'=> '<a href="'.admin_url( 'admin.php?page=luq_qrr-lib-manage-generate-qr-code&no_meja='.$val->post_title ).'"><i class="bi bi-pencil-square"></i></a> <i dataid="'.$val->ID.'" style="cursor: pointer;" id="datadelete" class="bi bi-trash-fill"></i> <i dataid="'.$val->post_title.'" data-toggle="modal" data-target="#qrgenerate" id="dataqr" style="cursor: pointer;" class="bi bi-qr-code-scan"></i>');
		}

		// deb($data);exit();

		$json_data = array(
			"draw"            => 100,   
			"recordsTotal"    => 100,  
			"recordsFiltered" => 100,
			"data"            => $data
			);
		
		
		echo json_encode($json_data);
		wp_die();
	}


}
