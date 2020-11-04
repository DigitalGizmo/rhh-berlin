</div><!-- end content -->

<footer role="contentinfo">

    <div id="footer-content" class="center-div">
        <?php if($footerText = get_theme_option('Footer Text')): ?>
        <div id="custom-footer-text">
            <p><?php echo get_theme_option('Footer Text'); ?></p>
        </div>
        <?php endif; ?>
        
        
        <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
        <p><?php echo $copyright; ?></p>
        <?php endif; ?>
        
        <nav><?php echo public_nav_main()->setMaxDepth(0); ?></nav>     
        
        
        <p><?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?></p>

    </div><!-- end footer-content -->
	
	
	<!-- Erin: added footer logos -->
	<div id="footer-logos">
		<?php echo '<a href="https://revolution250.org/"><img src="'.WEB_ROOT.img("rev250.jpg").'"/></a>';?>
		<?php echo '<a href="https://masshumanities.org/"><img src="'.WEB_ROOT.img("masshumanities.png").'"/></a>';?>
		<?php echo '<a href="https://www.neh.gov/"><img src="'.WEB_ROOT.img("neh.jpeg").'"/></a>';?>
	</div>   

     <?php fire_plugin_hook('public_footer', array('view'=>$this)); ?>
     


</footer>

<script type="text/javascript">
    jQuery(document).ready(function(){
        Omeka.showAdvancedForm();
        Omeka.skipNav();
        Omeka.megaMenu();
        Berlin.dropDown();
    });
</script>

</body>

</html>