<?php


/*
Plugin Name: Cool Plugin
Plugin URI: http:/stuff.com
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Me
Version: 1.0.0
Author URI: http://ma.tt/
*/

add_filter('the_content', 'addToEndOfPost');

function addToEndOfPost($content){
  if(is_page() && is_main_query()){
    return $content . '<p>My name is Pooches</p>';
  }
}
