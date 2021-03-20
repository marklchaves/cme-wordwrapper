# cme WordWrapper

## caught my eye Custom Word Wrapper Plugin

Customise how your page title will word wrap. 

This WordPress plugin allows you to decide where a long page title will wrap (break) on smaller devices.

**Example**: We can insert a line break in ThisIsAReallyLongWord to display it like `ThisIsAReally<br>LongWord` instead. This means your long page titles will fit on a mobile device without being cutoff.

---

## Installation

1. Upload the **contents** of plugin zip file to the `/wp-content/plugins/cme-wordwrapper` directory, or install the plugin through the WordPress plugins page directly (wp-admin > Plugins > Add New > Upload Plugin).
1. Activate the plugin through the 'Plugins' page.

---

## Usage

After installing and activating the cme Custom Word Wrapper plugin, add your filter hook to your child theme's functions.php file or via a plugin like [Code Snippets](https://wordpress.org/plugins/code-snippets/).

In the filter hook, add the post/page **title** or **slug** to list (array) with the associated text for the word wrap (token).

```php
// Adding a page to the list using
// its slug or title.
if ( is_page( array(
    'mypagegoeshere', 
    'myotherpagegoeshere', 
    'This is My Page', 
    'Home Page'
    )) ) 
{
    // For the page(s) above add
    // a line break after this text
    // string.
    $str_token = 'ThisIsAReally';
}
```

Save your changes. Purge your cache and test your pages.

Feel free to download the [sample functions.php](https://github.com/marklchaves/cme-wordwrapper/blob/master/sample-functions.php) file to use as a template.

---

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/D1D7YARD)
