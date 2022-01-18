<?php


/*
Plugin Name: JS Block Example
Plugin URI: http:/stuff.com
Description: New Block for your Gutten!
Author: Me
Version: 1.0.0
Author URI: https:/g/
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class JsBlockExample {

  function __construct(){
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets(){
    wp_register_script('newblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    register_block_type('ourplugin/example-custom-block', array(
      'editor_script' => 'newblocktype',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes) {
    ob_start(); ?>
      <h3>Today my day is <?php echo esc_html($attributes['dayVarb']) ?> and my night is <?php echo esc_html($attributes['nightVarb']) ?>!?!?!?</h3>
    <?php return ob_get_clean();
  }
}


$jsBlockExample = new JsBlockExample();
