<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
    queue_css_file(array('iconfonts', 'skeleton','style', 'photoswipe', 'default-skin/default-skin','rhh-styles'));

    echo head_css();
    ?>
    <!-- Link to Baskerville Font -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@0;1&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- JavaScripts -->
    <?php queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)')); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('vendor/jquery-accessibleMegaMenu'); ?>
    <?php queue_js_file('berlin'); ?>
    <?php queue_js_file('globals'); ?>
    <?php echo head_js(); ?>

    <!-- Load js the way Erin did in curatescape to get real-time photoswipe -->
    <script>
        /*!
        loadJS: load a JS file asynchronously. 
        [c]2014 @scottjehl, Filament Group, Inc. (Based on http://goo.gl/REQGQ by Paul Irish). 
        Licensed MIT 
        */
        (function(w){var loadJS=function(src,cb,ordered){"use strict";var tmp;var ref=w.document.getElementsByTagName("script")[0];var script=w.document.createElement("script");if(typeof(cb)==='boolean'){tmp=ordered;ordered=cb;cb=tmp;}
        script.src=src;script.async=!ordered;ref.parentNode.insertBefore(script,ref);if(cb&&typeof(cb)==="function"){script.onload=cb;}
        return script;};if(typeof module!=="undefined"){module.exports=loadJS;}
        else{w.loadJS=loadJS;}}(typeof global!=="undefined"?global:this));
        
    </script>

    <script>
        // Async JS 
        loadJS('<?php echo src('photoswipe.min.js','javascripts');?>'); 
        loadJS('<?php echo src('photoswipe-ui-default.min.js','javascripts');?>'); 
        <?php if( 0 === strpos(current_url(), '/items/show') ):?>
            loadJS('<?php echo src('items-show2.js','javascripts');?>'); // items-show.js
        <?php endif;?>  
    </script>

</head>
 <?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
        <header role="banner">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title"><?php echo link_to_home_page(theme_logo()); ?>
                <h2 class="tagline">What Happened in Your Town?</h2>
            </div>

            <div id="search-container" role="search">
                <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                <?php echo search_form(array('show_advanced' => true)); ?>
                <?php else: ?>
                <?php echo search_form(); ?>
                <?php endif; ?>
            </div>
        </header>

         <div id="primary-nav" role="navigation">
             <?php
                  echo public_nav_main();
             ?>
         </div>

         <div id="mobile-nav" role="navigation" aria-label="<?php echo __('Mobile Navigation'); ?>">
             <?php
                  echo public_nav_main();
             ?>
         </div>

        <?php echo theme_header_image(); ?>

    <div id="content" role="main" tabindex="-1">

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
