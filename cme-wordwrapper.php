<?php
/**
 * Plugin Name: caught my eye WordWrapper
 * Plugin URI: https://github.com/marklchaves/will-work-for-ko-fi
 * Description: Create custom word wrapping for longer one-word headings and titles.
 * Author URI: https://www.caughtmyeye.cc/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CME_WORDWRAPPER
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue script library and inline code.
 */
function cme_wordwrapper_enqueue_scripts() {
  
	// Add to footer section.
	wp_register_script(
		'cme_wordwrapper_script', 
		plugins_url('/cme-wordwrapper.js', dirname(__FILE__)),
		array(), 
		'1.0.0', 
		true
  );
  
  wp_enqueue_script('cme_wordwrapper_script');
  
  $str_token = '';
	if( is_page( array( 'athenahealth', 'athenaclinicals', 'athenacollector', 'athenacommunicator' ) ) ) {
    $str_token = 'athena';
	}
	
  $script  =  <<<EOT
// Do an IIFE to avoid namespace cluttering.
(function () {
  let sel = ".entry-title";
  let val = "";
  
  try {
    val = document.querySelector(sel).innerHTML;
  } catch (error) {
    console.warn(sel + ' not found. No word wrapping to do here.');
  }
  
  if ((val !== undefined) && (val !== "")) {
    console.log('Word wrapping enabled for the word "' + val + '".');
    // Manage the word wrapping.
    let ww = new WordWrapper(sel, "$str_token");

    // Media query for small devices.
    const mql = window.matchMedia("(max-width: 600px)");

    // Event handler.
    function handleWidthChange(mql) {
      mql.matches ? ww.wrapText() : ww.unwrapText();
    }

    // Run the event handler at least once.
    handleWidthChange(mql);

    // Listen for width changes.
    mql.addListener(handleWidthChange);
  }
})();
EOT;
	
	wp_add_inline_script('cme_wordwrapper_script', $script, 'after');
	
}
add_action('wp_enqueue_scripts', 'cme_wordwrapper_enqueue_scripts');
