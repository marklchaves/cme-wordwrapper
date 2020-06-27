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
