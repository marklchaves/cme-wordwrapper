
// WordWrapper
function cme_add_wordwrapper_script_wp_footer() {
	if( is_page( array( 'AthenaLabs', 'AthenaStudios', 'AthenaDevelopment', 'AthenaResearch' ) ) ){

    ?>
        <script>
			"use strict";

/**
 * Class WordWrapper
 *
 * Attributes
 * 1. targetElt: The target DOM element.
 * 2. withoutBr: The first part of the word with no break.
 * 3. withBr: The first part of the word with a break.
 *
 * Methods
 * 1. wrapText()
 * 2. unwrapText()
 * 
 * To do: Make class a library so it can be reused.
 */
class WordWrapper {
  constructor(sel, strToken) {
    const br = "<br>";

    this.targetElt = document.querySelector(sel);
    this.withoutBr = strToken;
    this.withBr = strToken + br;
  }

  // Add a new line break.
  wrapText() {
    let origString = this.targetElt.innerHTML;
    let newString = origString.replace(this.withoutBr, this.withBr);
    this.targetElt.innerHTML = newString;
    // Result: Athena<br>Labs
  }

  // Remove the new line break.
  unwrapText() {
    let origString = this.targetElt.innerHTML;
    let newString = origString.replace(this.withBr, this.withoutBr);
    this.targetElt.innerHTML = newString;
    // Result: AthenaLabs
  }
}

// Do an IIFE to avoid cluttering.
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
    let ww = new WordWrapper(sel, "athena");

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

        </script>
    <?php
	}
}
add_action('wp_footer', 'cme_add_wordwrapper_script_wp_footer');