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
    add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
  }

  function adminAssets(){
    wp_enqueue_script('newblocktype', plugin_dir_url(__FILE__) . 'app.js', array('wp-blocks', 'wp-element'));
  }
}


$jsBlockExample = new JsBlockExample();
