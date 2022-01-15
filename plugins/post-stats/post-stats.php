<?php


/*
Plugin Name: Post Statistics
Plugin URI: http:/stuff.com
Description: It gets da stats
Author: Me
Version: 1.0.0
Author URI: https://ma.tt/
Text Domain: psp_domain
Domain Path: /languages
*/

class PostStatisticsPlugin {

  function __construct(){
    add_action('admin_menu', array($this, 'adminMenu'));
    add_action('admin_init', array($this, 'settings'));
    add_action('the_content', array($this, 'ifWrap'));
  }

  function adminMenu(){
    add_options_page('Post Stats Settings', __('Post Stats', 'psp_domain'), 'manage_options', 'post-stat-settings-page', array($this, 'adminMenuHTML'));
  }

  function settings(){
    add_settings_section('psp_first_section', null, null, 'post-stat-settings-page');

    add_settings_field('psp_location', 'Display Location', array($this, 'locationHTML'), 'post-stat-settings-page', 'psp_first_section');
    register_setting('postStatsPlugin', 'psp_location', array('sanitize_callback' => array($this, 'sanatizeLocation'), 'default' => '0'));

    add_settings_field('psp_headline', 'Headline Text', array($this, 'headlineHTML'), 'post-stat-settings-page', 'psp_first_section');
    register_setting('postStatsPlugin', 'psp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

    add_settings_field('psp_wordcount', __('Word Count', 'psp_domain'), array($this, 'checkboxHTML'), 'post-stat-settings-page', 'psp_first_section', array('theName' => 'psp_wordcount'));
    register_setting('postStatsPlugin', 'psp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('psp_lettercount', 'Letter Count', array($this, 'checkboxHTML'), 'post-stat-settings-page', 'psp_first_section', array('theName' => 'psp_lettercount'));
    register_setting('postStatsPlugin', 'psp_lettercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

    add_settings_field('psp_readtime', 'Read Time', array($this, 'checkboxHTML'), 'post-stat-settings-page', 'psp_first_section', array('theName' => 'psp_readtime'));
    register_setting('postStatsPlugin', 'psp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
  }

  function ifWrap($content){
    if(( is_main_query() AND is_single() ) AND
      (
        get_option('psp_wordcount', '1') OR
        get_option('psp_lettercount', '1') OR
        get_option('psp_readtime', '1')
      )){
        return $this->createContentHTML($content);
      }

    return $content;
  }

  function sanatizeLocation($input){
      if($input != '0' AND $input != '1'){
          add_settings_error('psp_location', 'psp_location_error', "Error: invalid input");
          return get_option('psp_location');
      }
      return $input;
  }

  function locationHTML(){
    ?>
    <select name="psp_location">
      <option value="0" <?php selected(get_option('psp_location'), '0') ?> >Beginning Of Post</option>
      <option value="1" <?php selected(get_option('psp_location'), '1') ?> >End Of Post</option>
    </select>
    <?php
  }

  function headlineHTML(){
    ?>
      <input type="text" name="psp_headline" value="<?php echo esc_attr(get_option('psp_headline')); ?>">
    <?php
  }

  function checkboxHTML($args){
    ?>
      <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
    <?php
}


  function adminMenuHTML(){ ?>
    <div class="wrap">
      <h1>Post Statistics Plugin Settings</h1>
      <form action="options.php" method="POST">
        <?php
          settings_fields('postStatsPlugin');
          do_settings_sections('post-stat-settings-page');
          submit_button();
         ?>
      </form>
    </div>
  <?php }

  function createContentHTML($content){
    $html = '<h3>' . get_option('psp_headline', 'Post Statistics') . '</h3><p>';

    if(get_option('psp_wordcount', '1') OR get_option('psp_readtime', '1')){
        $wordcount = str_word_count(strip_tags($content));
    }

    if(get_option('psp_wordcount', '1')){
       $html .= 'This post has ' . $wordcount . ' words.<br>';
    }

    if(get_option('psp_lettercount', '1')){
       $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
    }

    if(get_option('psp_lettercount', '1')){
       $html .= 'This post will take ' . round($wordcount/225) . (round($wordcount/225) > 1 ? ' minutes to read' : ' minute to read');
    }

    $html .= '</p>';


    if(get_option('psp_location', '0') == '0'){
      return $html . $content;
    }
    return $content . $html;
  }

}

 $postStatisticsPlugin = new PostStatisticsPlugin();
