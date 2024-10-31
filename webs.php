<?php 
session_start();
/*
Plugin Name: MyWebCounter
Plugin URI: http://www.mywebcounter.com/
Description: Plugin is counting sites visitor,  please see to it that the template your using is supporting wp_footer or wp_list_categories or wp_meta for this counter to work. Wp_Footer is a mandatory in every on every template. Thus if wp_footer is not supported by your template you can include it by editing the footer.php of your template in use.
Author: webcounter
Version: 1.1
Author URI: http://www.mywebcounter.com/
*/

function mwc_install()
{
    global $wpdb;
    $table = $wpdb->prefix."mwc_counter";
	$q="DROP table if exists $table";
	$q1=mysql_query($q);
    $structure = "CREATE TABLE
	 $table (
        id INT(100) NOT NULL AUTO_INCREMENT,
        mwc_disp INT(1) DEFAULT 0,
        mwc_align INT(1) DEFAULT 0,
        mwc_withzeros INT(1) DEFAULT 0,
		mwc_count VARCHAR(200) NOT NULL,
		mwc_displayat INT(1) DEFAULT 0,
		mwc_unique INT(1) DEFAULT 0,
		mwc_cat VARCHAR(200) NOT NULL,
		mwc_sub VARCHAR(200) NOT NULL,
		mwc_showlinks INT(1) DEFAULT 0,
	UNIQUE KEY id (id)
    );";
    $wpdb->query($structure);
 
    // Populate table
    $wpdb->query("INSERT INTO $table (mwc_count, mwc_cat, mwc_sub)
        VALUES('0', '2', 'AC1')");

}


add_action('activate_mywebcounter/webs.php', 'mwc_install');



function web()
{
    global $wpdb;
	$counts = 0;
	$mydomain = $_SERVER['HTTP_HOST'];
    $browser_name = $_SERVER['HTTP_USER_AGENT'];
    $bots = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."mwc_counter");
	

    foreach($bots as $bot)
    {
	
	if($bot->mwc_unique==0){
		$counts = $bot->mwc_count + 1;
		$wpdb->query("UPDATE ".$wpdb->prefix."mwc_counter SET mwc_count='$counts'");
		$_SESSION['iscounted']=1;
	}elseif($bot->mwc_unique==1 && isset($_SESSION['iscounted'])){
		$counts = $bot->mwc_count;
		$wpdb->query("UPDATE ".$wpdb->prefix."mwc_counter SET mwc_count='$counts'");
		$_SESSION['iscounted']=1;
	}else{
		$counts = $bot->mwc_count;
	}
	
		if($bot->mwc_disp==1 && $bot->mwc_showlinks==1){
			if($bot->mwc_align==0){$align="center";}
			if($bot->mwc_align==1){$align="left";}
			if($bot->mwc_align==2){$align="right";}
			echo "
			<div align='$align'>
				<script src='http://www.mywebcounter.com/counter/wp_jslist.php?count=".$counts."&folder=".$bot->mwc_sub."&withz=".$bot->mwc_withzeros."&isu=".$bot->mwc_unique."&mydomain=".$mydomain."'></script>
			</div>
			";
			include("http://www.mywebcounter.com/counter/wp_linkslist.php?count=".$counts."&folder=".$bot->mwc_sub."&withz=".$bot->mwc_withzeros."&isu=".$bot->mwc_unique."&mydomain=".$mydomain);
		}
    }
}


function webselect(){
    global $wpdb;
	$counts = 0;
	$mydomain = $_SERVER['HTTP_HOST'];
    $browser_name = $_SERVER['HTTP_USER_AGENT'];
    $bots = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."mwc_counter");
	

    foreach($bots as $bot)
    {
		if($bot->mwc_displayat==0){
			add_action('wp_footer', 'web');
		}else if($bot->mwc_displayat==1){
			add_action('wp_meta', 'web');
		}else if($bot->mwc_displayat==2){
			add_action('wp_list_categories', 'web');
		}
	}
}
 

add_action('wp_head', 'webselect');



function mwc_menu()
{
    global $wpdb;
    include 'webcounter_menu.php';
}
 
function mwc_admin_actions()
{
    add_options_page("Web Counter", "Web Counter", 1,
"Web-Counter", "mwc_menu");
}
 
add_action('admin_menu', 'mwc_admin_actions');
