<?php
/**
 * Plugin Name: caught my eye WordWrapper
 * Plugin URI: https://github.com/marklchaves/will-work-for-ko-fi
 * Description: Create custom word wrapping for longer one-word headings and titles.
 * Author URI: https://www.caughtmyeye.cc/
 * Version: 0.2.1
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CME_WORDWRAPPER
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

define( 'CME_WORDWRAPPER_NAME', 'cme-wordwrapper' );
define( 'CME_WORDWRAPPER_VERSION', '0.2.1' );

/**
 * Enqueue script library and inline code.
 */
function cme_wordwrapper_enqueue_scripts() {
  
	// Add to footer section.
	wp_register_script(
		'cme_wordwrapper_script', 
		plugins_url('/'. CME_WORDWRAPPER_NAME . '/cme-wordwrapper.js', dirname(__FILE__)),
		array(), 
		CME_WORDWRAPPER_VERSION, 
		true
  );
  
  wp_enqueue_script('cme_wordwrapper_script');
  
  $str_token = '';
  $str_token = apply_filters( 'get_wordwrapper_token',  $str_token );

  $script  =  <<<EOT
// Do an IIFE to avoid namespace cluttering.
(function () {
  let strToken = $str_token;
  if (strToken === '') return;

  let sel = ".entry-title";
  let val = "";
  
  try {
    val = document.querySelector(sel).innerHTML;
  } catch (error) {
    console.warn(sel + ' not found. No word wrapping to do here.');
  }
  
  if ((val !== undefined) && (val !== "")) {
    console.log('Word wrapping enabled for the word "' + val + '".');
    console.log('Will wrap after string: $str_token');
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
