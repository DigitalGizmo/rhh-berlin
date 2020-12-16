<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<?php
  // Probably a more direct way to do this, but..
  // Needed to retrieve current item after item is altered by Item Relation
  $current_item_id = metadata('item', 'id');
  $saved_current_record = get_record_by_id('item', $current_item_id);
?>
<div id="primary">
    
    <div class="item-story">
    
        <!-- Item Title -->
        <h1 class="item-title"><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

        <?php if (metadata('item', 'has files')): ?>
            <div class="item-file image-jpeg">
                <?php echo item_image('fullsize',array('class' => 'full'),0, $item); // 1st image only ?> 
            </div>           
        <?php endif; ?>

        <!-- Items metadata - echo all_element_texts removed -->
        
         <div class="element story">
            <!-- <h3>Story</h3> -->
            <div class="element-text">
                <?php echo metadata('item', array('Item Type Metadata','Story')) ?>
            </div>
        </div>

    </div><!-- end item-story -->

    <hr>

    <!--JJ added to make 2 column layout-->
    <div class="item-info">

        <!-- Curatorial Fields -->
        <div class="about-item">
            <h2>About This Item</h2>

            <div class="element">
                <h3>Date</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Date')) ?></div>
            </div>

            <div class="element">
                <h3>Description</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Description')) ?></div>
            </div>

            <div class="element">
                <h3>Type</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Type')) ?></div>
            </div>

            <div class="element">
                <h3>Identifier</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Identifier')) ?></div>
            </div>

            <div class="element">
                <h3>Topic</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Subject')) ?></div>
            </div>

            <div class="element">
                <h3>Collection</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Source')) ?></div>
            </div>

            <div class="element">
                <h3>Contributor</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Contributor')) ?></div>
            </div>

            <!-- The following prints a list of all tags associated with the item -->
            <?php if (metadata('item','has tags')): ?>
            <div id="item-tags" class="element">
                <h3><?php echo __('Tags'); ?></h3>
                <div class="element-text"><?php echo tag_string('item'); ?></div>
            </div>
            <?php endif;?>

            <!-- The following prints a citation for this item -->
            <div id="item-citation" class="element">
                <h3><?php echo __('Citation'); ?></h3>
                <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
            </div>
        </div><!-- end about-item -->

        <div id="item-relations-display-item-relations">
            <!-- adding fire plugin here per Erin -->
            <?php if( plugin_is_active('ItemRelations') ){ 
                echo get_specific_plugin_hook_output('ItemRelations', 'public_items_show', array('view' => $this, 'item' => $item));
            }  ?>
        </div>

    </div><!--end item-info-->

    <hr>

    <?php
      // We have to reset the record because it was altered by Item Relations
      set_current_record('item', $saved_current_record);
    ?>
    <!-- if item is a manuscript, show transcription -->
    <?php if(metadata('item', array('Item Type Metadata','Text'))): ?>
      <div class="element">
        <h2>Transcription</h2>
        <div class="element-text transcription"><?php echo metadata('item', array('Item Type Metadata','Text')) ?></div>
      </div>
      <hr>
    <?php endif; ?>

    <!-- adapted from Erin's Cleavand historical -->
    <?php rhh_item_images($item);?>  
    <!-- ?php queue_js_file('item-photos'); ? -->

    <!-- map -->
	<?php if( plugin_is_active('Geolocation') ){ 
	   echo get_specific_plugin_hook_output('Geolocation', 'public_items_show', array('view' => $this, 'item' => $item)); 
	}  ?>

    <!-- item navigation -->
    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>

</div> <!-- End of Primary -->

 <?php echo foot(); ?>
