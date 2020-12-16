<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div id="primary">
    
    <!-- Item Title -->
    <h1><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

    <?php if ((get_theme_option('Item FileDisplay') == 1) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
    <?php endif; ?>

    <!-- Items metadata - echo all_element_texts removed -->
    
    <!-- Item FileDisplay -->
    <?php if ((get_theme_option('Item FileDisplay') == 0) && metadata('item', 'has files')): ?>
      <h3><?php echo __('Files'); ?></h3>
      <div id="item-images">
           <?php echo files_for_item(); ?>
      </div>
    <?php endif; ?>

   <!--<?php if(metadata('item','Collection Name')): ?>
      <div id="collection" class="element">
        <h3><?php echo __('Collection'); ?></h3>
        <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
      </div>
   <?php endif; ?>-->

     <div class="element story">
        <!-- <h3>Story</h3> -->
        <div class="element-text">
            <?php echo metadata('item', array('Item Type Metadata','Story')) ?>
        </div>
    </div>  

    <hr>

    <div class="element">
        <h3>Topic</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Subject')) ?></div>
    </div>

    <div class="element">
        <h3>Description</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Description')) ?></div>
    </div>

    <div class="element">
        <h3>Type</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Type')) ?></div>
        <h3>Identifier</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Identifier')) ?></div>
    </div>

    <!-- if item is a manuscript, show transcription -->
    <?php if(metadata('item', array('Item Type Metadata','Text'))): ?>
      <div class="element">
        <h3>Transcription</h3>
        <div class="element-text"><?php echo metadata('item', array('Item Type Metadata','Text')) ?></div>
      </div>
    <?php endif; ?>

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

    <div class="element">
        <h3>Collection</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Source')) ?></div>
    </div>

    <div class="element">
        <h3>Contributor</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Contributor')) ?></div>
    </div>

    <div class="element">
        <h3>Date</h3>
        <div class="element-text"><?php echo metadata('item', array('Dublin Core','Date')) ?></div>
    </div>

    <hr>

    <!-- map -->
    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>

</div> <!-- End of Primary. -->

 <?php echo foot(); ?>
