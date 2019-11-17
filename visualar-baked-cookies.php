<?php
/*
Plugin Name: Visualar Baked Cookie Consent
Plugin URI: https://visualar.co.uk
Description: WORK IN PROGRESS! Clean and simple Cookie Consent popup at bottom of site using the very nice (and free) https://cookieconsent.osano.com
Author: Jonny Allbut
Version: 0.02
Author URI: https://jonnya.net
License: PRIVATE - Not for distribution thanks.
*/


/**
*
* Add scripts
* Note filter: visualar_cookie_css - path to CSS file (or false and build into your theme style.css)
* Note filter: visualar_cookie_js - path to JS file (or false and build into your theme style.css)
*
*/
add_action( 'wp_enqueue_scripts', 'vis_cookie_scripts' );
function vis_cookie_scripts() {

  /**
   * Define if we load the supporting JS and CSS files for this plugin.
   * Acceptable values are 'theme' (default) or 'plugin'
   * theme = loads nothing, expects you to include the plugin JS and CSS in your theme!
   * plugin = loads files from plugin
   *
   * Our normal structure is to have this defined in your theme to save extra files loading
   *
   */
  if ( !defined('VIS_BAKED_COOKIE') ) { define( 'VIS_BAKED_COOKIE', 'plugin' ); }

    // Define where the config file should be loaded from - see wider-post-type-constants.php for info
  if ( VIS_BAKED_COOKIE == 'plugin' ) {

      /* Load config from plugin - ONLY FOR DEBUGGING IF NEED TO DEACTIVATE THEME! */
    $path_css = apply_filters( 'visualar_cookie_css', plugins_url( 'inc/cookie-consent.css', __FILE__ ) );
    $path_js = apply_filters( 'visualar_cookie_js', plugins_url( 'inc/cookie-consent.min.js', __FILE__ ) );

    wp_enqueue_style( 'vis_cookie_css', $path_css );
    wp_enqueue_script( 'vis_cookie_js', $path_js );

  } else {

    // Silence is golden - your loading the JS and CSS from your theme (I hope!)

  }

}


/**
*
* Add in-line JS config
*
*/
add_action( 'wp_footer', 'sm_cookiep_js' );
function sm_cookiep_js() {
?>
<script>
window.cookieconsent.initialise({
"palette": {
"popup": {
"background": "#000",
"text": "#cccccc"
},
"button": {
"background": "#000",
"text": "#fff"
}
},
"content": {
"message": "This site uses cookies to improve your browsing experience and help us understand how to improve it. To change your preferences, see our Cookies &amp; Tracking Notice. Otherwise, closing the banner or clicking Accept all Cookies indicates you agree to the use of cookies on your device.",
"dismiss": "Accept all Cookies",
"href": "#"
}
});
</script>
<?php
}