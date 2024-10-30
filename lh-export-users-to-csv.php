<?php
/**
 * Plugin Name: LH Export Users to CSV
 * description: Export Users to CSV Plugin allows you to export a users list and their metadata into a CSV file.
 * Version: 1.00
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Text Domain: lh_eutc
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('LH_Export_users_to_csv_plugin')) {


class LH_Export_users_to_csv_plugin {
    
    
    private static $instance;
    
static function return_plugin_namespace(){

return 'lh_eutc';

}


static function return_filename(){
        
        
return plugin_basename( __FILE__ );
        
}

static function return_download_button(){
    
$text = '<div class="card" id="'.self::return_plugin_namespace().'-generate_download_div">
			<h2 class="title">Download your Users</h2>';
    
$text .= '<a href="'.wp_nonce_url( admin_url( 'users.php?run=' ).self::return_filename(), self::return_plugin_namespace().'-generate_report', self::return_plugin_namespace().'-generate_report' ).'"> <button class="button button-blue button-bordered">Generate Report</button></a>';
$text .= '<p>This will generate a CSV file of the details of your users.</p>';

$text .= '</div>';

return $text;
    
}

private function generate_report() {
	$filename   = sanitize_file_name( sprintf( 'lh_eutc-report-%s', date( 'Y-m-d-U' ) ) );

$users = get_users();

$array =  (array)$users[0]->data;




$headings = array();

foreach ($array as $key => $value){

$headings[] = $key;
    
    
}

//add in the post meta fields
$headings[] = 'first_name';
$headings[] = 'last_name';


//allow others to add their own
$headings = apply_filters( 'lh_eutc_headings', $headings );
$headings = array_unique($headings);

$report = array();


foreach ( $users as $user ) {
    
$add = array();

$user_meta = get_user_meta( $user->ID );
    
foreach ( $headings as $heading ) {
    
    if (isset($user->data->$heading)){
    
    $add[] = $user->data->$heading;
    
    } else {
        
     $add[] = get_user_meta( $user->data->ID, $heading, true );   
        
    }
    
}
    
    $report[] = $add;
    
}


	// Send the report.
	header( 'Content-Description: File Transfer' );
	header( "Content-Disposition: attachment; filename={$filename}.csv" );
	header( 'Content-Type: text/csv; charset=' . get_option( 'blog_charset' ), true );

	$fh = @fopen( 'php://output', 'w' );
	fwrite( $fh, "\xEF\xBB\xBF" );
	fputcsv( $fh, $headings );

	foreach ( $report as $data ) {
		fputcsv( $fh, $data );
	}

	fclose( $fh );
	exit;
	
	
}


/**
 * Handle form submission/report generation.
 *
 * @since 1.0
 */
public function maybe_generate_download() {
    
    		

	if ( !current_user_can('manage_options')) {
	    

	    
		return;
	}

	if ( empty( $_GET[self::return_plugin_namespace().'-generate_report'] ) or !wp_verify_nonce($_GET[self::return_plugin_namespace().'-generate_report'], self::return_plugin_namespace().'-generate_report')) {
	    
		return;

	}


	$this->generate_report();

	exit;
}
    


// add a settings link next to deactive / edit
public function add_settings_link( $links, $file ) {

	if( $file == self::return_filename() ){
		$links[] = '<a href="'. admin_url( 'tools.php' ).'#'.self::return_plugin_namespace().'-generate_download_div">Use the tool</a>';
	}
	return $links;
}


public function add_download_button(){
    
    echo self::return_download_button();
    
    
}


public function plugins_loaded(){


load_plugin_textdomain( self::return_plugin_namespace(), false, basename( dirname( __FILE__ ) ) . '/languages' ); 


//generate the export download  
add_action( 'admin_init', array($this,'maybe_generate_download'), 10000);

//menus and settings
add_filter('plugin_action_links', array($this,'add_settings_link'), 10, 2);



//add a button on the tools screen
add_action( 'tool_box', array($this,'add_download_button'));

}
    
    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
    public static function get_instance(){
        if (null === self::$instance) {
            self::$instance = new self();
        }
 
        return self::$instance;
    }

    
    
    public function __construct() {
        
//run whatever on plugins loaded (currently just translations)
add_action( 'plugins_loaded', array($this,"plugins_loaded"));
        
        
    }
    
    
}

$lh_export_users_to_csv_instance = LH_Export_users_to_csv_plugin::get_instance();


}

?>